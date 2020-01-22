<?php 
namespace App\Model;

class User {
    private $id_user;
    private $pseudo;
    private $email;
    private $password;
    private $create_date;
    private $role;
    
    public function __get($get)
    {
        $method = 'get'.ucfirst($get);
        $this->$get = $this->$method();
        return $this->$get;
    }
    public function getId_user() {
        return $this->id_user;
    }
    public function setId_user($id_user) {
        $this->id_user = $id_user;
    }
    public function getPseudo() {
        return $this->pseudo;
    }
    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getCreate_date() {
        return $this->create_date;
    }
    public function setCreate_date($create_date) {
        $this->create_date = $create_date;
    }
    public function getRole() {
        return $this->role;
    }
    public function setRole($role) {
        $this->role = $role;
    }
}
