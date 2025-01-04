<?php
// اتصال به دیتابیس
include 'config.php';

// گرفتن تمام پست‌ها از دیتابیس
$stmt = $pdo->prepare("SELECT posts.id, posts.title, posts.created_at, users.name AS author
                       FROM posts
                       JOIN users ON posts.author_id = users.id");
$stmt->execute();
$posts = $stmt->fetchAll();
?>

<h1>لیست پست‌ها</h1>

<table>
    <thead>
        <tr>
            <th>عنوان</th>
            <th>نویسنده</th>
            <th>تاریخ</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post): ?>
            <tr>
                <td><?php echo htmlspecialchars($post['title']); ?></td>
                <td><?php echo htmlspecialchars($post['author']); ?></td>
                <td><?php echo htmlspecialchars($post['created_at']); ?></td>
                <td>
                    <a href="view_post.php?id=<?php echo $post['id']; ?>">مشاهده</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
