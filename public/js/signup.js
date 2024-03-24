$(document).ready(function() {
    $('form').submit(function(event) {
        var user_id = $('#user_id').val();
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
        var name = $('#name').val();
        var captcha = $('#captcha').val();

        var errorMessage = "";

        if(user_id.length === 0) {
            errorMessage = "아이디를 입력해주세요.";
        } else if(user_id.length < 5 || user_id.length > 12) {
            errorMessage = "아이디는 5자 이상, 12자 이하이어야 합니다.";
        } else if(password.length === 0) {
            errorMessage = "비밀번호를 입력해주세요.";
        } else if(password.length < 8) {
            errorMessage = "비밀번호는 8자 이상이어야 합니다.";
        } else if(password !== confirmPassword) {
            errorMessage = "비밀번호가 일치하지 않습니다.";
        } else if(name.trim() === "") {
            errorMessage = "이름을 입력해주세요.";
        } else if(captcha.trim() === "") {
            errorMessage = "자동등록방지 코드를 입력해주세요.";
        }

        if(errorMessage) {
            event.preventDefault(); // 폼 제출 방지
            alert(errorMessage);
        }
        // 유효성 검사에 통과하면, 폼은 정상적으로 제출됩니다.
    });
});