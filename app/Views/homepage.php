<!DOCTYPE html>
<html lang="en">
    <head>
        <link
            rel="stylesheet"
            type="text/css"
            href="/my_project/public/assets/css/home.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
        <div class="membership-directory">
            <img src="/my_project/public/img/human.png" width="40" height="40">
            <h2>회원수첩</h2>
        </div>
        <div class="latest-posts">
            <h3>최신글</h3>
            <ul>
                <?php foreach($latestPosts as $post): ?>
                <li>
                    <a href="/my_project/postdetail/<?= $post['id']; ?>">
                        <span><?= $post['title']; ?></span>
                        <span class="post-time"><?= $post['created_at']; ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </body>
</html>

<script src="/my_project/public/js/homepage.js"></script>