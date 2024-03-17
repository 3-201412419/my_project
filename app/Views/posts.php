<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="/my_project/public/assets/css/posts.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 검색 결과</title>
</head>
<body>
    <main>
        <div class="search-form">
            <form action="/my_project/posts" method="get">
                <input type="text" name="query" placeholder="검색어 입력..." value="<?= esc($query) ?>">
                <button type="submit">검색</button>
            </form>
        </div>
        <div class="latest-posts">
            <h3>검색 결과</h3>
            <?php if (!empty($posts)): ?>
            <ul>
                <?php foreach ($posts as $post): ?>
                <li>
                    <a href="/my_project/postdetail/<?= esc($post['id']); ?>">
                        <span><?= esc($post['title']); ?></span>
                        <span class="post-time"><?= esc(date('Y-m-d H:i', strtotime($post['created_at']))); ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
            <p>검색 결과가 없습니다.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>