<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/my_project/public/assets/css/mypage.css">
    <title>마이페이지</title>
</head>
<body>
    <div class="container my-5">
        <h2>마이페이지</h2>
        <div class="user-info">
            <p><strong>이름:</strong> <?= esc($userData['name']) ?></p>
            <p><strong>아이디:</strong> <?= esc($userData['user_id']) ?></p>
            <!-- 기타 사용자 정보 표시 -->
            <a href="/my_project/mypage/edit" class="btn btn-primary">내 정보 상세보기</a>
        </div>
        <div class="user-actions">
            <h3>내 활동</h3>
            <ul>
                <li><a href="/my_project/mypage/posts">내가 작성한 글 보기</a></li>
                <li><a href="/my_project/mypage/comments">내가 작성한 댓글 보기</a></li>
                <!-- 기타 사용자 활동 관련 링크 -->
            </ul>
        </div>
    </div>
</body>
</html>