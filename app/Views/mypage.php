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
            <!-- 추가 정보 표시 예정 -->
            <a href="/my_project/mypage/edit" class="btn btn-primary">내 정보 상세보기</a>
        </div>
        <div class="user-actions">
            <h3>내 활동</h3>
            <ul>
                <li><a href="/my_project/mypage/myposts">내가 작성한 글 보기</a></li>
                <li><a href="/my_project/mypage/mycomments">내가 작성한 댓글 보기</a></li>
                <!-- 기타 사용자 활동 관련 링크 -->
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // 필요한 JavaScript 코드 추가 예정
    </script>
</body>
</html>