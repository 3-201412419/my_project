<?php namespace App\Models;

use CodeIgniter\Model;

class Posts_m extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content', 'author', 'views', 'created_at'];
    protected $returnType = 'array';

    public function searchPosts($query = null)
    {
        if (!empty($query)) {
            return $this
                ->like('title', $query)
                ->orLike('content', $query)
                ->findAll();
        } else {
            return $this->findAll();
        }
    }

    public function incrementViews($id)
    {
        $this->set('views', 'views+1', false)
             ->where('id', $id)
             ->update();
    }
}