<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="/my_project/public/assets/css/postdetail.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($post['title']); ?></title>
</head>
<body>
    <div class="post-container">
        <h1 class="post-title"><?= esc($post['title']); ?></h1>
        <div class="post-meta">
            <span>작성자: <?= esc($post['author']); ?></span> | 
            <span>작성일: <?= esc($post['created_at']); ?></span>
        </div>
        <div class="post-content">
            <?= $post['content']; ?> <!-- esc() 함수 사용하지 않음 -->
        </div>
        <div class="post-footer">
            <a href="/my_project/posts">목록으로 돌아가기</a>
        </div>
    </div>
</body>
</html>