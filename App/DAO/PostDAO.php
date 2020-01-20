<?php 
namespace App\DAO;

use App\DAO\Database;
use App\Model\Post;

class PostDAO extends Database {

    private function postObject($data)
    {
        $post = new Post();
        $post->setId_post($data['id_post']);
        $post->setTitle($data['title']);
        $post->setAuthor($data['username']);
        isset($data['content']) ? $post->setContent($data['content']) : '';
        isset($data['short_content']) ? $post->setShort_Content($data['short_content']) : '';
        $post->setCreate_date($data['create_date']);
        $post->setModification_date($data['modification_date']);
        return $post;
    }
    public function getPosts()
    {
       
        $req = $this->queryDB('SELECT posts.id_post,posts.title, posts.short_content, posts.create_date, posts.modification_date, users.username FROM posts INNER JOIN users ON user_id = id_user ORDER BY posts.modification_date DESC');
        $posts= [];
        foreach ($req as $data) {
            $postId = $data['id_post'];
            $posts[$postId] = $this->postObject($data);
        }
        return $posts;
    }
    public function getPost($postId)
    {
        $req = $this->prepareDB('SELECT posts.id_post,posts.title, posts.short_content, posts.content, posts.create_date, posts.modification_date, users.username FROM posts INNER JOIN users ON user_id = id_user WHERE id_post = ?',[$postId]); 
        $post = $req->fetch();
        return $this->postObject($post); 
    }
}
