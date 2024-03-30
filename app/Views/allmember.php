<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="/my_project/public/assets/css/allmember.css">
        <!-- 추가된 CSS 파일 -->
        <title>전체 회원 목록</title>
    </head>
    <body>
        <div class="search-container my-4">
            <form action="/my_project/allmember" method="get" class="search-form">
                <input
                    type="text"
                    class="form-control"
                    placeholder="회원 이름 검색"
                    name="search"
                    required="required">
                <button class="btn btn-outline-secondary" type="submit">검색</button>
            </form>
        </div>
        <?php
$totalMembers = count($members);
$adInterval = rand(2, 5); // 2에서 5 사이의 랜덤한 간격으로 광고 배너 표시
?>

        <div class="container mt-5">
            <div class="row">
                <?php foreach ($members as $index => $member): ?>
                <?php if ($index > 0 && $index % $adInterval === 0 && $index < $totalMembers - 1): ?>
                <div class="col-12 mb-3">
                    <!-- 광고 배너 -->
                    <div class="ad-banner">
                        <img src="광고 이미지 URL" alt="광고 배너">
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-12 col-md-6 mb-3">
                    <a href="/my_project/memberdetail/<?= esc($member['id']); ?>">
                        <div class="card member-card">
                            <div class="card-horizontal">
                                <img src="https://via.placeholder.com/150" class="card-img-left" alt="회원 사진">
                                <div class="card-body member-info">
                                    <h5 class="card-title"><?= esc($member['name']); ?></h5>
                                    <p class="card-text">
                                        <strong>이메일:</strong>
                                        <?= esc($member['email']); ?><br>
                                        <strong>휴대폰:</strong>
                                        <?= esc($member['phone']); ?><br>
                                        <strong>기업명:</strong>
                                        <?= esc($member['company_name']); ?><br>
                                        <strong>업종:</strong>
                                        <?= esc($member['industry']); ?><br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>