<?php
// اتصال به دیتابیس
include 'config.php';

// بررسی ارسال فرم
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = 1; // فرض می‌کنیم کاربر با ID 1 وارد شده است. در واقع باید این مقدار را از جلسه کاربر دریافت کنی.

    // ذخیره پست در دیتابیس
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, author_id) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $author_id]);

    echo "پست با موفقیت ایجاد شد.";
}
?>

<h2>ایجاد پست جدید</h2>

<form method="POST">
    <label>عنوان:</label>
    <input type="text" name="title" required><br>

    <label>محتوا:</label>
    <textarea name="content" rows="4" required></textarea><br>

    <button type="submit">ایجاد پست</button>
</form>
