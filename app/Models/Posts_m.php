<?php namespace App\Models;

use CodeIgniter\Model;

class Posts_m extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content', 'author', 'views', 'created_at'];
    protected $returnType = 'array';

    public function incrementViews($id)
    {
        $post = $this->find($id);
        if ($post) {
            $views = $post['views'] + 1;
            $this->update($id, ['views' => $views]);
        }
    }
}