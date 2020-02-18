<?php 

namespace App\Config\Session;

use App\Config\Session\Session;

class UserSession extends Session {
    
    public function checkAdmin() 
    {
        return $this->check('id_user') && $this->setStrict('role','ADMIN');    
    }
    public function checkEditor() 
    {
        return $this->check('id_user') && $this->setStrict('role','EDITOR');
    }
    public function checkMember() 
    {
        return $this->check('id_user') && $this->setStrict('role','MEMBER');
    }
    public function checkLogged($userId) 
    {
        return $this->check('id_user') && $this->setStrict('id_user',$userId);
    }
    public function redirection() 
    {
        if($this->checkAdmin()) {
            header('Location: ../public/index.php?page=dashboard');
        } else if($this->checkEditor()) {
            header("Location: ../public/index.php?page=editorDashboard");
        } else if($this->checkMember()) {
            header('Location:../public/index.php?page=profil&id_user='.$this->get('id_user'));
        } else {
            header("Location: ../public/index.php?page=pageNotFound");
        }
    }  
}
