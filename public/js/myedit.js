$(document).ready(function() {
    $('#myForm').submit(function(e) {
        e.preventDefault(); // 기본 폼 제출 방지

        var formData = $(this).serialize(); // 폼 데이터 직렬화

        $.ajax({
            type: "POST",
            url: $(this).attr('action'), // 폼의 action 속성 값을 사용
            data: formData,
            success: function(response) {
                console.log(response);
                // 응답 처리
                if(response.success) {
                    alert('정보가 성공적으로 업데이트 되었습니다.');
                    // 페이지 리다이렉션 또는 UI 업데이트
                } else {
                    // 오류 처리
                    console.log('오류가 발생했습니다: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                // AJAX 요청 실패 처리
                console.log(xhr, status, error);
            }
        });
    });
});