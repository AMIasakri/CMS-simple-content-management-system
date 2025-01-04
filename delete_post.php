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

// حذف پست از دیتابیس
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$post_id]);

echo "پست با موفقیت حذف شد.";
