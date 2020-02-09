<?php
namespace App\Config;

class Request {

    private $get;
    private $post;
    private $session;

    public function getGet($key = null)
    {
        if($key) {
            return isset($_GET[$key])?$_GET[$key]:null;
         }
         return isset($_GET)?$_GET:null;
       
    }
    public function getPost($key=null)
    {
        if($key) {
           return isset($_POST[$key])?$_POST[$key]:null;
        }
        return isset($_POST)?$_POST:null;
    }
    
}