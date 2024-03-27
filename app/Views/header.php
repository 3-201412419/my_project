<?php $session = session();?>
<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="<?= csrf_hash(); ?>">
    <title>My Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/my_project/public/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/my_project/public/assets/css/menu.css">
    <link rel="stylesheet" type="text/css" href="/my_project/public/assets/css/slider.css">
    <link rel="stylesheet" type="text/css" href="/my_project/public/assets/css/footer.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="menu">
        <ul>
            <li>
                <a href="/my_project/homepage">중소기업 회원 수첩</a>
            </li>
        </ul>
        <div class="hamburger-menu">
            <i class="fas fa-bars" style="color: white;"></i>
        </div>
        <!-- 팝업 메뉴 -->
        <div class="popup-menu" style="display: none;">
            <div class="popup-content">
                <button class="close-btn">&times;</button>
                <?php if ($isLoggedIn): ?>
                    <img src="https://via.placeholder.com/150" alt="User Photo" class="user-photo">
                    <p>안녕하세요, <?= esc($userName); ?>님</p>
                    <p><?= esc($session->get('user_name')); ?></p>
                    <p>기타 정보...</p>
                    <button onclick="location.href='/my_project/mypage'">마이페이지</button>
                    <button onclick="logout()">로그아웃</button>
                <?php else: ?>
                    <button onclick="location.href='/my_project/login'">로그인</button>
                    <button onclick="location.href='/my_project/signup'">회원가입</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

<script>
$(document).ready(function () {
    $('.hamburger-menu').click(function (event) {
        event.stopPropagation();
        $('.popup-menu').fadeToggle(300);
    });

    $('.close-btn').click(function () {
        $('.popup-menu').fadeOut(300);
    });

    $(document).click(function (event) {
        if (!$('.popup-menu').is(event.target) && !$('.popup-menu').has(event.target).length) {
            $('.popup-menu').fadeOut(300);
        }
    });

    $('.popup-menu').click(function (event) {
        event.stopPropagation();
    });

    $(document).keyup(function (e) {
        if (e.key === "Escape") {
            $('.popup-menu').fadeOut(300);
        }
    });
});

function logout() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch('/my_project/logout', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken
        },
    }).then(response => {
        if (response.ok) {
            window.location.href = '/my_project/login';
        }
    }).catch(error => {
        console.error('Logout failed', error);
    });
}
</script>
</body>
</html>