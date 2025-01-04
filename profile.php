<?php
session_start();
include 'config.php';

// چک کردن اینکه کاربر وارد شده است
if (!isset($_SESSION['user_id'])) {
    echo "شما باید وارد سیستم شوید.";
    exit;
}

// گرفتن اطلاعات کاربر از دیتابیس
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    echo "کاربر یافت نشد.";
    exit;
}
?>

<h2>پروفایل کاربر</h2>
<p>نام کاربری: <?php echo htmlspecialchars($user['username']); ?></p>
<p>ایمیل: <?php echo htmlspecialchars($user['email']); ?></p>
<p>نقش: <?php echo ($user['role_id'] == 1) ? "مدیر" : "کاربر"; ?></p>
