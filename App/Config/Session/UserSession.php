<?php 

namespace App\Config\Session;

use App\Config\Session\Session;

class UserSession extends Session {
    
    public function admin() {
        return $this->check('id_user') && $this->set('role','ADMIN');
    }
    public function editor() {
        return $this->check('id_user') && $this->set('role','EDITOR');
    }
    public function logged($userId) {
        return $this->check('id_user') && $this->get('id_user') === $userId;
    }
    public function redirection() {
        if($this->admin()) {
            header('Location: ../public/index.php?page=dashboard');
        } else if($this->editor()) {
            header("Location: ../public/index.php?page=editorDashboard");
        } else {
            header("Location: ../public/index.php?page=pageNotFound");
        }  
    }

}