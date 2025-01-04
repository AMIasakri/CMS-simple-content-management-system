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

// حذف نظر از دیتابیس
$stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
$stmt->execute([$comment_id]);

echo "نظر با موفقیت حذف شد.";
