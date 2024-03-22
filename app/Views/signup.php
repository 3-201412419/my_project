<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/my_project/public/assets/css/signup.css">
    <title>회원가입</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h2>회원가입</h2>
                    </div>
                    <div class="card-body">
                        <!-- 오류 메시지 출력 -->
                        <?php if(session()->getFlashdata('errors')):?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('errors') ?></div>
                        <?php endif;?>
                        <form action="/signup/register" method="post">
                            <div class="form-group">
                                <label for="username">아이디:</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">비밀번호:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">비밀번호 확인:</label>
                                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="name">이름:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="captcha">자동등록방지 코드:</label>
                                <img src="<?= esc($captchaImageUrl) ?>" alt="CAPTCHA"> <!-- CAPTCHA 이미지 표시 -->
                                <input type="text" name="captcha" id="captcha" class="form-control" placeholder="위의 문자를 입력하세요" required>
                            </div>
                            <!-- 자동등록방지 코드 입력 필드 및 이미지 추가 예정 -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">회원가입</button>
                                <!-- 회원가입 버튼과 로그인 페이지로의 링크 버튼을 분리하여 구성 -->
                                <a href="/login" class="btn btn-secondary">로그인 페이지</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>