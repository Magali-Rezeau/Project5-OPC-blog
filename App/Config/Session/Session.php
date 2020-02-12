<?php 

namespace App\Config\Session;
class Session {

    public function set($key,$value) {
        return $_SESSION[$key] = $value;   
    }
    public function check($key) {
        return isset($_SESSION[$key]);
    }
    public function get($key) {
        return $_SESSION[$key];
    }
    public function show($key)
    {
        if($this->check($key))
        {
            $value = $this->get($key);
            $this->delete($key);
            return $value;
        }
    }
    public function delete($key)
    {
        unset($_SESSION[$key]);
    }
    public function destroy() {
        $_SESSION = [];
        session_destroy();
        header('Location:../public/index.php?page=home');
    }
}
