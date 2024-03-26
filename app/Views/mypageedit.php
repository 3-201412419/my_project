<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/my_project/public/assets/css/mypageedit.css">
    <title>내 정보 </title>
    <!-- 필요한 스타일시트 추가 -->
</head>
<body>
<div class="container">
    <h1>내 정보 </h1>
    <form action="/my_project/mypage/updatememberinfo" method="post">
        <div class="form-group">
            <label for="name">이름</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= esc($userData['name'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="email">이메일</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= esc($userData['email'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="phone">전화번호</label>
            <input type="text" id="phone" name="phone" class="form-control" value="<?= esc($userData['phone'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="company_name">회사 이름</label>
            <input type="text" id="company_name" name="company_name" class="form-control" value="<?= esc($userData['company_name'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="company_address">회사 주소</label>
            <input type="text" id="company_address" name="company_address" class="form-control" value="<?= esc($userData['company_address'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="industry">산업 분야</label>
            <input type="text" id="industry" name="industry" class="form-control" value="<?= esc($userData['industry'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="company_description">회사 설명</label>
            <textarea id="company_description" name="company_description" class="form-control"><?= esc($userData['company_description'] ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label for="personal_memo">개인 메모</label>
            <textarea id="personal_memo" name="personal_memo" class="form-control"><?= esc($userData['personal_memo'] ?? '') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">저장하기</button>
    </form>
</div>
</body>
</html>