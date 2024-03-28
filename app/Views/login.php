<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/my_project/public/assets/css/login.css">
    <title>로그인</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card login-card">
                    <div class="card-header text-center">
                        <h2>로그인</h2>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger" style="display:none;"></div> <!-- 오류 메시지를 위한 공간 -->
                        <form id="loginForm" action="/my_project/login/authenticate" method="post"> <!-- 폼 id 추가 -->
                            <div class="form-group">
                                <label for="user_id">아이디:</label>
                                <input type="text" name="user_id" id="user_id" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">비밀번호:</label>
                                <input type="password" name="password" id="password" required class="form-control">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">로그인</button>
                                <a href="/my_project/signup" class="btn btn-secondary">회원가입</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/my_project/public/js/login.js"></script> <!-- login.js 스크립트 포함 -->
</body>
</html>