<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/my_project/public/assets/css/myposts.css">
    <title>내 게시글 목록</title>
</head>
<body>
    <div class="container">
        <h1 class="page-title">내 게시글 목록</h1>
        <?php if (!empty($posts) && is_array($posts)): ?>
            <div class="post-list">
                <?php foreach ($posts as $post): ?>
                    <div class="post-item">
                    <a href="/my_project/postdetail/<?= esc($post['id'], 'url'); ?>" class="post-title">
                        <?= esc($post['title']); ?>
                    </a>
                        <div class="post-content">
                            <?= esc(substr(strip_tags($post['content']), 0, 100)); // HTML 태그 제거 및 내용 100자 제한 ?>
                            <?php if (strlen(strip_tags($post['content'])) > 100): ?>
                                ...
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-posts">게시글이 없습니다.</p>
        <?php endif; ?>
    </div>
</body>
</html>