document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('saveMemo').addEventListener('click', function() {
        var memberId = document.getElementById('memberDetail').getAttribute('data-member-id');
        var memoContent = document.getElementById('memberMemo').value;
        
        fetch('/my_project/MemberDetail/saveMemo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                member_id: memberId,
                memo: memoContent
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                document.getElementById('memberMemo').value = '';
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});