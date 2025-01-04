<?php
session_start();
include 'config.php';

// اگر فرم ارسال شده است
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // جستجو در دیتابیس برای ایمیل
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // ذخیره اطلاعات کاربر در session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];  // یا $user['username'] بسته به فیلد شما
        $_SESSION['role_id'] = $user['role_id']; // نقش کاربر

        echo "ورود با موفقیت انجام شد. به داشبورد خوش آمدید!";
        // اینجا می‌توانید کاربر را به داشبورد هدایت کنید
        // header("Location: dashboard.php");
    } else {
        echo "ایمیل یا رمز عبور اشتباه است.";
    }
}
?>

<form method="POST">
    ایمیل: <input type="email" name="email" required><br>
    رمز عبور: <input type="password" name="password" required><br>
    <button type="submit">ورود</button>
</form>
