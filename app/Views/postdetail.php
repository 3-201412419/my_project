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
            <?= $post['content']; ?>
        </div>
        <div class="post-footer">
            <a href="/my_project/posts">목록으로 돌아가기</a>
        </div>

        <!-- 로그인 상태 확인 -->
        <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
            <!-- 로그인한 사용자가 작성자가 아닌 경우 댓글 작성 폼 표시 -->
            <?php if ($post['author'] != session()->get('username')): ?>
                <div class="comment-form">
                    <form action="/my_project/comments/save" method="post">
                        <input type="hidden" name="post_id" value="<?= esc($post['id']); ?>">
                        <textarea name="content" placeholder="댓글을 작성하세요..." required></textarea>
                        <button type="submit">댓글 작성</button>
                    </form>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <!-- 로그인하지 않은 사용자에게 로그인 요청 메시지 표시 -->
            <div class="login-request">
                <p>댓글을 작성하려면 <a href="/my_project/login">로그인</a>이 필요합니다.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>