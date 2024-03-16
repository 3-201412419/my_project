<?

namespace App\Models;
use CodeIgniter\Model;

class AllMember_m extends Model {
    protected $table = 'member_notebook'; // 사용할 데이터베이스 테이블 명
    protected $primaryKey = 'id';  // 기본 키 설정 (예시)
    protected $returnType = 'array'; // 반환되는 데이터 타입 설정
    // 기타 필요한 설정...
}


?>