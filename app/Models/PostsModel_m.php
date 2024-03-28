<?php namespace App\Models;

use CodeIgniter\Model;

class PostsModel_m extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content', 'author', 'views', 'created_at'];
    protected $returnType = 'array';

    public function getPostsByUserId($userId)
    {
        return $this->where('author', $userId)->findAll();
    }
}