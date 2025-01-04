<?php
session_start();
include 'config.php';

// چک کردن اینکه کاربر وارد شده است
if (!isset($_SESSION['user_id'])) {
    echo "شما باید وارد سیستم شوید.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // اگر پسورد جدید وارد شده باشد، آن را هش کرده و بروزرسانی می‌کنیم
    if ($password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$username, $email, $hashed_password, $_SESSION['user_id']]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $_SESSION['user_id']]);
    }

    echo "اطلاعات با موفقیت بروزرسانی شد.";
}

// گرفتن اطلاعات فعلی کاربر
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<h2>ویرایش پروفایل</h2>
<form method="POST">
    <label>نام کاربری:</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>

    <label>ایمیل:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

    <label>پسورد جدید:</label>
    <input type="password" name="password"><br>

    <button type="submit">بروزرسانی</button>
</form>
