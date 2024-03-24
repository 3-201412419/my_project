<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/my_project/public/assets/css/login.css"> <!-- 변경된 스타일시트 경로 -->
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
                        <?php if(session()->getFlashdata('msg')):?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                        <?php endif;?>
                        <form action="/my_project/login/authenticate" method="post">
                            <div class="form-group">
                                <label for="username">아이디:</label>
                                <input type="text" name="username" id="username" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">비밀번호:</label>
                                <input type="password" name="password" id="password" required class="form-control">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">로그인</button>
                                <a href="/my_project/signup" class="btn btn-secondary">회원가입</a> <!-- 회원가입 버튼 추가 -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>