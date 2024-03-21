<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="/my_project/public/assets/css/home.css">
        <title>회원 상세보기</title>
    </head>
    <body>

        <div class="container my-5">
            <div id="memberDetail" data-member-id="<?= $member['id']; ?>"></div>
            <div class="row">
                <div class="col-12 mb-3">
                    <button onclick="history.back()" class="btn btn-secondary">이전</button>
                </div>
                <!-- 이미지 디자인 변경: 'rounded-circle' 클래스 제거 -->
                <div class="col-12 mb-3">
                    <img src="https://via.placeholder.com/150" alt="Member Photo" class="img-fluid">
                </div>
                <!-- 메모 입력 필드와 저장 버튼 추가 -->
                <div class="col-12 mb-4">
                    <h4>나만의 회원 메모 작성</h4>
                    <textarea
                        id="memberMemo"
                        class="form-control mb-2"
                        rows="3"
                        placeholder="메모를 여기에 작성하세요..."><?= esc($member['personal_memo'] ?? ''); ?></textarea>
                    <button id="saveMemo" class="btn btn-primary">저장</button>
                </div>
                <div class="col-12">
                    <h2>회원 정보</h2>
                    <p>
                        <strong>소속:</strong>
                        <?= esc($member['industry']); ?></p>
                    <p>
                        <strong>이름:</strong>
                        <?= esc($member['name']) ?></p>
                    <p>
                        <strong>휴대폰:</strong>
                        <?= esc($member['phone']) ?></p>
                    <p>
                        <strong>기업명:</strong>
                        <?= esc($member['company_name']) ?></p>
                    <p>
                        <strong>이메일:</strong>
                        <?= esc($member['email']) ?></p>
                    <p>
                        <strong>기업주소:</strong>
                        <?= esc($member['company_address']) ?></p>
                    <p>
                        <strong>업종:</strong>
                        <?= esc($member['industry']) ?></p>
                    <p>
                        <strong>기업소개:</strong>
                        <?= esc($member['company_description']) ?></p>
                    <p>
                        <strong>나만의 회원 메모:</strong>
                        <?= esc($member['personal_memo']) ?></p>
                </div>
            </div>
        </div>

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="/my_project/public/js/memberdetail.js"></script>
    </body>
</html>