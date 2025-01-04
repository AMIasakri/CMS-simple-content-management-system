<?php
// اتصال به دیتابیس
include 'config.php';

// دریافت شناسه پست از پارامتر URL
$post_id = $_GET['id'];

// بررسی اینکه آیا پست وجود دارد
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    echo "پست یافت نشد.";
    exit;
}

// بررسی ارسال فرم و بروزرسانی پست
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // بروزرسانی پست در دیتابیس
    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $post_id]);

    echo "پست با موفقیت ویرایش شد.";
}

// نمایش فرم ویرایش پست
?>

<h2>ویرایش پست</h2>

<form method="POST">
    <label>عنوان:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br>

    <label>محتوا:</label>
    <textarea name="content" rows="4" required><?php echo htmlspecialchars($post['content']); ?></textarea><br>

    <button type="submit">ویرایش پست</button>
</form>
