<?php 
namespace App\Model;

class Comment 
{

    private $id_comment;
    private $author;
    private $profile_picture;
    private $content;
    private $create_date;
    private $post_id;

    public function __get($get)
    {
        $method = 'get'.ucfirst($get);
        $this->$get = $this->$method();
        return $this->$get;
    }
    public function getId_comment() 
    {
        return $this->id_comment;
    }
    public function setId_comment($id_comment) 
    {
        $this->id_comment = $id_comment;
    }
    public function getPost_id() 
    {
        return $this->post_id;
    }
    public function setPost_id($post_id) 
    {
        $this->post_id = $post_id;
    }
    public function getAuthor() 
    {
        return $this->author;
    }
    public function setAuthor($author) 
    {
        $this->author = $author;
    }
    public function getProfile_picture() 
    {
        return $this->profile_picture;
    }
    public function setProfile_picture($profile_picture) 
    {
        $this->profile_picture = $profile_picture;
    }
    public function getContent() 
    {
        return $this->content;
    }
    public function setContent($content) 
    {
        $this->content = $content;
    }
    public function getCreate_date() 
    {
        return $this->create_date;
    }
    public function setCreate_date($create_date) 
    {
        $this->create_date = $create_date;
    }
}
