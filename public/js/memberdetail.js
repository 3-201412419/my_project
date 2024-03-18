document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('saveMemo').addEventListener('click', function () {
        var memoContent = document.getElementById('memberMemo').value;
        // AJAX를 사용하여 서버에 메모 내용을 전송하는 코드 작성
        fetch('/my_project/MemberDetail/saveMemo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                // CSRF 토큰이 필요하다면 여기에 추가
            },
            body: 'memo=' + encodeURIComponent(memoContent) + '&member_id=' + encodeURIComponent(memberId)
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                alert(data.message);
                // 성공 처리 로직 (예: 입력 필드 초기화)
                document.getElementById('memberMemo').value = '';
            } else {
                // 실패 처리 로직
                alert('메모 저장 실패');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});