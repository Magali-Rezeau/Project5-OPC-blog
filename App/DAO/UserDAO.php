<?php 
namespace App\DAO;

use App\DAO\Database;
use App\Model\User;

class UserDAO extends Database {

    private function userObject($data)
    {
        $user = new User();
        $user->setId_user($data['id_user']);
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setCreate_date($data['create_date']);
        $user->setRole($data['entitled']);
        return $user;
    }
    public function getUsers()
    { 
        $req = $this->queryDB('SELECT users.id_user, users.username, users.password, users.email, users.create_date, role_users.entitled FROM users INNER JOIN role_users ON role_users_id = id_role_user ORDER BY users.create_date DESC');
        $users= [];
        foreach ($req as $data) {
            $userId = $data['id_user'];
            $users[$userId] = $this->userObject($data);
        }
        return $users;
    }
    public function deleteUser($userId) {
        $req = $this->prepareDB('DELETE FROM users WHERE id_user = ?', [$userId]);
    }
    public function register($method) {
        $req = $this->prepareDB('INSERT INTO users(username, email, password, role_users_id, create_date) VALUES (?, ?, ?, 3, NOW())',[$method['username'],$method['email'],sha1($method['password'])]);
    }
    public function pseudo_user($method) {
        $req= $this->prepareDB('SELECT COUNT(username) FROM users WHERE username = ?',[$method['username']]);
        $isUnique = $req->fetchColumn();
        if($isUnique) {
            return 'Déja utilisé';
        }
    }
}
