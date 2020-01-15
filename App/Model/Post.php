<?php 
namespace App\Model;

class Post {
    private $id_post;
    private $title;
    private $author;
    private $content;
    private $short_content;
    private $create_date;
    private $modification_date;
    private $url;
    public function __get($get)
    {
        $method = 'get'.ucfirst($get);
        $this->$get = $this->$method();
        return $this->$get;
    }
    public function getUrl() {
        return '../public/index.php?page=single&id_post='. 
        $this->id_post; 
    }
    public function setUrl($url) {
        $this->url = $url;
    }
    public function getId_post() {
        return $this->id_post;
    }
    public function setId_post($id_post) {
        $this->id_post = $id_post;
    }
    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function setAuthor($author) {
        $this->author = $author;
    }
    public function getContent() {
        return $this->content;
    }
    public function setContent($content) {
        $this->content = $content;
    }
    public function getShort_content() {
        return $this->short_content;
    }
    public function setShort_content($short_content) {
        $this->short_content = $short_content;
    }
    public function getCreate_date() {
        return $this->create_date;
    }
    public function setCreate_date($create_date) {
        $this->create_date = $create_date;
    }
    public function getModification_date() {
        return $this->modification_date;
    }
    public function setModification_date($modification_date) {
        $this->modification_date = $modification_date;
    }
}
