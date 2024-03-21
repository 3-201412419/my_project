<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"> <!-- FontAwesome 아이콘을 위한 링크 -->
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            left: 0; /* 왼쪽 정렬을 위해 추가 */
            width: 100%;
            background-color: #f8f9fa;
            text-align: center;
            font-size: 14px;
            padding: 10px 0;
            display: flex; /* Flexbox를 사용하여 내용을 가로로 배치 */
            justify-content: center; /* 중앙 정렬 */
        }

        .footer a {
            color: grey !important;
            margin: 0 10px;
            display: inline-block; /* 링크가 가로로 나열되도록 설정 */
            text-decoration: none;
        }

        .footer i {
            display: inline-block; /* 아이콘과 텍스트가 같은 줄에 나타나도록 설정 */
            margin-right: 5px; /* 아이콘과 텍스트 사이 간격 설정 */
        }
    </style>
</head>
<body>
    <div class="footer">
        <a href="mypage.php"><i class="fas fa-user"></i> 마이페이지</a>
        <a href="/my_project/posts"><i class="fas fa-clock"></i> 게시판</a>
        <a href="/my_project/allmember"><i class="fas fa-book"></i> 회원수첩</a>
        <a href="javascript:location.reload();"><i class="fas fa-sync-alt"></i> 새로고침</a>
    </div>
</body>
</html>