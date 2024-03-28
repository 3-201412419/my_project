$(document).ready(function() {
    $('#signupForm').on('submit', function(event) {
        event.preventDefault(); // 폼 제출 방지

        var userId = $('#user_id').val();
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
        var name = $('#name').val();
        var captcha = $('#captcha').val();

        var errorMessage = "";

        // 클라이언트 측 유효성 검사
        if(userId.length === 0) {
            errorMessage = "아이디를 입력해주세요.";
        } else if(userId.length < 5 || userId.length > 12) {
            errorMessage = "아이디는 5자 이상, 12자 이하이어야 합니다.";
        } else if(password.length === 0) {
            errorMessage = "비밀번호를 입력해주세요.";
        } else if(password.length < 8) {
            errorMessage = "비밀번호는 8자 이상이어야 합니다.";
        } else if(password !== confirmPassword) {
            errorMessage = "비밀번호 확인 내용이 일치하지 않습니다.";
        } else if(name.trim() === "") {
            errorMessage = "이름을 입력해주세요.";
        } else if(captcha.trim() === "") {
            errorMessage = "자동등록방지 코드를 입력해주세요.";
        }

        if(errorMessage) {
            $('.form-errors').text(errorMessage).show();
            return false;
        }

        var formData = $(this).serialize(); // 폼 데이터 직렬화

        $.ajax({
            url: '/my_project/signup/register',
            type: 'POST',
            data: formData,
            success: function(response) {
                window.location.href = '/my_project/login'; // 성공 시 로그인 페이지로 리다이렉션
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessages = Object.values(errors).join('<br>');
                $('.form-errors').html(errorMessages).show();
            }
        });
    });
});