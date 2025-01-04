<?php
// اتصال به دیتابیس
include 'config.php';

// دریافت شناسه پست از پارامتر URL
$post_id = $_GET['id'];

// دریافت اطلاعات پست از دیتابیس
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

// دریافت نظرات مرتبط با پست
$stmt_comments = $pdo->prepare("SELECT comments.content, comments.created_at, users.name AS commenter
                                FROM comments
                                JOIN users ON comments.user_id = users.id
                                WHERE post_id = ?");
$stmt_comments->execute([$post_id]);
$comments = $stmt_comments->fetchAll();
?>

<h1><?php echo htmlspecialchars($post['title']); ?></h1>
<p><strong>نویسنده:</strong> <?php echo htmlspecialchars($post['author_id']); ?></p>
<p><strong>تاریخ ایجاد:</strong> <?php echo htmlspecialchars($post['created_at']); ?></p>
<p><strong>محتوا:</strong> <?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

<h2>نظرات</h2>
<?php if (count($comments) > 0): ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li>
                <strong><?php echo htmlspecialchars($comment['commenter']); ?>:</strong>
                <p><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                <small><?php echo htmlspecialchars($comment['created_at']); ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>هنوز هیچ نظری ثبت نشده است.</p>
<?php endif; ?>
