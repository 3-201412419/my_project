<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/my_project/public/assets/css/custom.css"> <!-- 추가된 CSS 파일 -->
    <title>전체 회원 목록</title>
</head>
<body>

<div class="container mt-5">
  
    <div class="row">
        <?php foreach ($members as $member): ?>
            <div class="col-12 col-md-6 col-lg-4 mb-3"> <!-- 수정된 부분 -->
                <div class="card member-card"> <!-- 클래스 추가 -->
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="회원 사진">
                    <div class="card-body member-info"> <!-- 클래스 추가 -->
                        <h5 class="card-title"><?= esc($member['name']); ?></h5>
                        <p class="card-text">
                            <strong>이메일:</strong> <?= esc($member['email']); ?><br>
                            <strong>휴대폰:</strong> <?= esc($member['phone']); ?><br>
                            <strong>기업명:</strong> <?= esc($member['company_name']); ?><br>
                            <strong>업종:</strong> <?= esc($member['industry']); ?><br>
                        </p>
                        <a href="/my_project/memberdetail/<?= esc($member['id']); ?>" class="btn btn-primary">상세보기</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>