$(document).ready(function() {
    $('#loginForm').submit(function(event) {
        event.preventDefault(); // 폼 기본 제출 방지

        var userId = $('#user_id').val();
        var password = $('#password').val();

        // 로그인 데이터 검증
        if (userId === '' || password === '') {
            $('.alert-danger').text('아이디와 비밀번호를 모두 입력해주세요.').show();
            return false;
        }

        // AJAX를 사용한 로그인 요청
        $.ajax({
            url: '/my_project/login/authenticate', // 실제 로그인 처리 URL
            type: 'POST',
            dataType: 'json', // 서버로부터 받을 데이터의 형식
            data: {
                user_id: userId,
                password: password
            },
            success: function(response) {
                if(response.status === 'success') {
                    // 로그인 성공 시 리다이렉션
                    window.location.href = response.redirect;
                } else {
                    // 로그인 실패 시 오류 메시지 표시
                    $('.alert-danger').text(response.message).show();
                }
            },
            error: function(xhr, status, error) {
                // AJAX 요청 실패 시 오류 메시지 표시
                $('.alert-danger').text('로그인 처리 중 문제가 발생했습니다.').show();
            }
        });
    });
});