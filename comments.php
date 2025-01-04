<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "برای ارسال نظر باید وارد شوید.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO comments (user_id, content) VALUES (?, ?)");
    $stmt->execute([$user_id, $content]);
    echo "نظر با موفقیت ارسال شد.";
}
?>

<form method="POST">
    <label>نظر خود را بنویسید:</label>
    <textarea name="content" required></textarea><br>
    <button type="submit">ارسال نظر</button>
</form>
