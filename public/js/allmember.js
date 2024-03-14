function generateMembers(num) {
    
    const members = [];
    for(let i = 1; i <= num; i++) {
        members.push({
            name: `회원 ${i}`,
            phone: `010-${Math.floor(Math.random() * 10000)}-${Math.floor(Math.random() * 10000)}`,
            job: `직업 ${i}`,
            experience: `${i}년`,
            photoUrl: 'https://via.placeholder.com/150'
        });
    }
    return members;
}

const members = generateMembers(200); // 200명의 회원 데이터 생성


function displayMembers(members) {
    const membersList = document.getElementById('membersList');
    members.forEach(member => {
        const memberHTML = `
            <div class="col-md-6 mb-3">
                <div class="member-card d-flex">
                    <div class="member-photo mr-3">
                        <img src="${member.photoUrl}" alt="Member Photo" class="img-fluid">
                    </div>
                    <div class="member-info">
                        <h5>${member.name}</h5>
                        <p>휴대폰: ${member.phone}</p>
                        <p>직장명: ${member.job}</p>
                        <p>경력사항: ${member.experience}</p>
                    </div>
                </div>
            </div>
        `;
        membersList.innerHTML += memberHTML;
    });
}

displayMembers(members);

$(document).ready(function(){
    // 이벤트 위임을 사용하여 동적으로 생성된 요소에 대한 이벤트 처리
    $('#membersList').on('click', '.member-card.d-flex', function(){
        location.href = '/my_project/memberdetail';
    });
});

