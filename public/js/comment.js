$(document).ready(function() {
    $('#commentForm').submit(function(event) {
        event.preventDefault(); // 폼 기본 제출 방지

        var formData = {
            'post_id': $('input[name=post_id]').val(),
            'content': $('textarea[name=content]').val(),
        };

        $.ajax({
            url: '/my_project/posts/comment', // 댓글을 저장하는 서버의 URL
            type: 'POST',
            data: formData,
            success: function(response) {
                if(response.status === 'success') {
                    location.reload(); // 성공 시 페이지 새로고침 혹은 댓글 목록 갱신
                } else {
                    alert(response.message); // 실패 시 오류 메시지 표시
                }
            },
            error: function() {
                alert('댓글 저장에 실패했습니다.');
            }
        });
    });
});