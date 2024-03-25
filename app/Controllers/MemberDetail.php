<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MemberDetailModel_m; // Use the correct model name

class MemberDetail extends BaseController // Extend BaseController to use its properties
{
    public function index($id = null)
    {
        // Check if the user is logged in
        if (!$this->data['isLoggedIn']) {
            // Redirect to the login page if not logged in
            return redirect()->to('/login');
        }

        $model = new MemberDetailModel_m();
    
        $data = [];
        if ($id !== null) {
            // Fetch member information from the database
            $data['member'] = $model->find($id);
        }

        // Pass the data to the views
        echo view('header', $this->data);
        echo view('memberdetail', $data);
        echo view('footer', $this->data);
    }

    public function saveMemo()
    {
        // Ensure the user is logged in before allowing memo saving
        if (!$this->data['isLoggedIn']) {
            // Return an error response if the user is not logged in
            return $this->response->setJSON(['status' => 'error', 'message' => '로그인 필요']);
        }

        $memberId = $this->request->getVar('member_id'); // Member ID
        $memoContent = $this->request->getVar('memo'); // Memo content

        $model = new MemberDetailModel_m();
        
        if ($model->saveMemo($memberId, $memoContent)) {
            // Handle success
            return $this->response->setJSON(['status' => 'success', 'message' => '메모 저장 성공']);
        } else {
            // Handle failure
            return $this->response->setJSON(['status' => 'error', 'message' => '메모 저장 실패']);
        }
    }
}