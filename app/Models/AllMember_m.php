<?

namespace App\Models;
use CodeIgniter\Model;

class AllMember_m extends Model {
    protected $table = 'member_notebook';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'phone', 'company_name', 'company_address', 'industry', 'company_description', 'personal_memo', 'join_date', 'category_id'];
    protected $returnType = 'array';

    // 모든 회원 데이터를 가져오는 메서드
    public function getAllMembers() {
        return $this->findAll();
    }

    public function searchMembers($searchTerm) {
        return $this->like('name', $searchTerm)->findAll(); // 'name' 필드를 기준으로 검색
    }
}

?>