<?php 
namespace App\Model\DAO;

use App\Model\DAO\Database;
use App\Model\Post;

class PostDAO extends Database 
{
    /**
     * create post object
     *
     * @param  string $data
     *
     * @return object
     */
    private function postObject($data)
    {
        $post = new Post();
        $post->setId_post($data['id_post']);
        $post->setTitle($data['title']);
        $post->setAuthor($data['pseudo']);
        isset($data['content']) ? $post->setContent($data['content']) : '';
        isset($data['short_content']) ? $post->setShort_Content($data['short_content']) : '';
        $post->setCreate_date($data['create_date']);
        $post->setModification_date($data['modification_date']);
        return $post;
    }
    /**
     * get all blog posts
     *
     * @return object
     */
    public function getPosts()
    {
        $req = $this->queryDB('SELECT posts.id_post,posts.title, posts.short_content, posts.create_date, posts.modification_date, users.pseudo FROM posts INNER JOIN users ON user_id = id_user ORDER BY posts.modification_date DESC');
        $posts= [];
        foreach ($req as $data) {
            $postId = $data['id_post'];
            $posts[$postId] = $this->postObject($data);
        }
        return $posts;
    }
    /**
     * get one blog posts
     *
     * @param  integer $postId
     *
     * @return object
     */
    public function getPost($postId)
    {
        $req = $this->prepareDB('SELECT posts.id_post,posts.title, posts.short_content, posts.content, posts.create_date, posts.modification_date, users.pseudo FROM posts INNER JOIN users ON user_id = id_user WHERE id_post = ?',[$postId]); 
        $post = $req->fetch();
        return $this->postObject($post); 
    }
    /**
     * add blog post in DB
     *
     * @param  array $method = $_POST
     *
     */
    public function addPost($method) 
    {
        $req = $this->prepareDB('INSERT INTO posts(title,content,short_content, user_id,create_date, modification_date) VALUES (?,?,?,?, NOW(), NOW())',[$method['title'],$method['content'],$method['short_content'],$_SESSION['id_user']]);  
    }
    /**
     * delete blog post in DB
     *
     * @param  integer $postId
     *
     */
    public function deletePost($postId) 
    {
        $req = $this->prepareDB('DELETE FROM posts WHERE id_post = ?', [$postId]);
    }
    /**
     * update modification to the blog post
     *
     * @param  array $method = $_POST
     * @param  integer $postId
     *
     */
    public function editPost($method,$postId) 
    {
        $req = $this->prepareDB('UPDATE posts SET title = :title,content = :content,short_content=:short_content, user_id=:user_id, modification_date = NOW() WHERE id_post=:id_post',
        ['title' =>$method['title'],'content'=>$method['content'],'short_content'=>$method['short_content'],'user_id'=>$_SESSION['id_user'], 'id_post' => $postId]);  
    } 
}
