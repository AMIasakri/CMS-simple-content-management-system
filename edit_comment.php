<?php
// اتصال به دیتابیس
include 'config.php';

// دریافت شناسه نظر از پارامتر URL
$comment_id = $_GET['id'];

// بررسی اینکه آیا نظر وجود دارد
$stmt = $pdo->prepare("SELECT * FROM comments WHERE id = ?");
$stmt->execute([$comment_id]);
$comment = $stmt->fetch();

if (!$comment) {
    echo "نظر یافت نشد.";
    exit;
}

// بررسی ارسال فرم و بروزرسانی نظر
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];

    // بروزرسانی نظر در دیتابیس
    $stmt = $pdo->prepare("UPDATE comments SET content = ? WHERE id = ?");
    $stmt->execute([$content, $comment_id]);

    echo "نظر با موفقیت ویرایش شد.";
}

// نمایش فرم ویرایش نظر
?>

<h2>ویرایش نظر</h2>

<form method="POST">
    <textarea name="content" rows="4" required><?php echo htmlspecialchars($comment['content']); ?></textarea><br>
    <button type="submit">ویرایش نظر</button>
</form>
