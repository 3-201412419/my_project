<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/my_project/public/assets/css/mycomments.css">
    <title>내가 남긴 댓글 목록</title>
</head>
<body>
    <div class="container">
        <h1>내가 남긴 댓글 목록</h1>
        <?php if (!empty($comments) && is_array($comments)): ?>
            <ul class="comments-list">
                <?php foreach ($comments as $comment): ?>
                    <li class="comment-item">
                        <div class="comment-content"><?= esc($comment['content']); ?></div>
                        <div class="comment-info">
                            <span>게시글 ID: <?= esc($comment['post_id']); ?></span> | 
                            <span>작성일: <?= esc($comment['created_at']); ?></span>
                        </div>
                        <a href="/my_project/posts/view/<?= esc($comment['post_id'], 'url'); ?>" class="view-post">게시글 보기</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>남긴 댓글이 없습니다.</p>
        <?php endif; ?>
    </div>
</body>
</html>