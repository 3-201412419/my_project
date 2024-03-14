<!DOCTYPE html>
<html>
    <head>
        <title>My page</title>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link
            rel="stylesheet"
            type="text/css"
            href="/my_project/public/assets/css/style.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="/my_project/public/assets/css/menu.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="/my_project/public/assets/css/slider.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="/my_project/public/assets/css/footer.css">

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
                    <!-- 닫기 버튼 추가 -->
                    <img src="https://via.placeholder.com/150" alt="User Photo" class="user-photo">
                    <p>사용자 이름</p>
                    <p>기타 정보...</p>
                    <button onclick="location.href='/my_page'">마이페이지</button>
                    <button onclick="logout()">로그아웃</button>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</script>