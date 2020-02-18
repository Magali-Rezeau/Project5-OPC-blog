<?php
namespace App\Config;

class Request {

    public function getGet($key = null)
    {
        $_GET = array_map('htmlspecialchars',$_GET);
        if($key) {
            return isset($_GET[$key]) ? $_GET[$key] : null;
         }
         return isset($_GET) ? $_GET : null;
    }
    public function getPost($key=null)
    {   
        $_POST = array_map('htmlspecialchars',$_POST);
        if($key) {
           return isset($_POST[$key])?$_POST[$key]:null;
        }
        return isset($_POST) ? $_POST : null;
    }
}
