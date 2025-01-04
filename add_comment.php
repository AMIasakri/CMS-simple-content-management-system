<?php
session_start();
include 'config.php';

// بررسی اینکه کاربر وارد شده است
if (!isset($_SESSION['user_id'])) {
    echo "شما باید وارد سیستم شوید.";
    exit;
}

// دریافت شناسه پست از پارامتر URL
$post_id = $_GET['id'];

// بررسی ارسال فرم
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id']; // گرفتن شناسه کاربر از جلسه
    $content = $_POST['content'];

    // ذخیره نظر در دیتابیس
    $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->execute([$post_id, $user_id, $content]);

    // بازگشت به صفحه پست
    header("Location: view_post.php?id=$post_id");
    exit;
}
?>

<h2>ارسال نظر</h2>

<form method="POST">
    <label>نظر:</label>
    <textarea name="content" rows="4" required></textarea><br>
    <button type="submit">ارسال نظر</button>
</form>
