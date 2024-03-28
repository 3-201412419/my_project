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
            <!-- <a href="/my_project/posts">목록으로 돌아가기</a> -->
        </div>
        <!-- 댓글 목록 표시 영역 -->
        <div class="comments-section">
            <h3>댓글</h3>
            <?php if(empty($comments)): ?>
                <p>댓글이 없습니다. 첫 댓글을 남겨보세요!</p>
            <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <p><?= esc($comment['content']); ?></p>
                        <div class="comment-meta">
                            <span>작성자: <?= esc($comment['author']); ?></span> |
                            <span>작성일: <?= esc($comment['created_at']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
                <div class="comment-form">
                    <h3>댓글 작성</h3>
                    <form id="commentForm">
                        <input type="hidden" name="post_id" value="<?= esc($post['id']); ?>">
                        <textarea name="content" placeholder="댓글을 작성하세요..." required></textarea>
                        <button type="submit">댓글 작성</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="login-request">
                    <p>댓글을 작성하려면 <a href="/my_project/login">로그인</a>이 필요합니다.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="/my_project/public/js/comment.js"></script>
</body>
</html>