<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // گرفتن اطلاعات فرم
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // هش کردن پسورد
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $role_id = 2; // فرض می‌کنیم کاربر به صورت پیش‌فرض نقش "کاربر" دارد

    // بررسی ایمیل تکراری
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        echo "این ایمیل قبلاً ثبت‌نام شده است.";
    } else {
        // ذخیره اطلاعات در دیتابیس
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashed_password, $role_id]);

        echo "ثبت‌نام با موفقیت انجام شد.";
    }
}
?>

<form method="POST">
    نام: <input type="text" name="name" required><br>
    ایمیل: <input type="email" name="email" required><br>
    رمز عبور: <input type="password" name="password" required><br>
    <button type="submit">ثبت‌نام</button>
</form>
