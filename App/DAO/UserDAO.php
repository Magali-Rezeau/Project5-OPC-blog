<?php 
namespace App\DAO;

use App\DAO\Database;
use App\Model\User;

class UserDAO extends Database {

    private function userObject($data)
    {
        $user = new User();
        $user->setId_user($data['id_user']);
        $user->setPseudo($data['pseudo']);
        $user->setEmail($data['email']);
        isset($data['password']) ? $user->setPassword($data['password']) : '';
        isset($data['create_date']) ? $user->setCreate_date($data['create_date']) : '';
        $user->setRole($data['entitled']);
        return $user;
    }
    public function getUsers()
    { 
        $req = $this->queryDB('SELECT users.id_user, users.pseudo, users.password, users.email, users.create_date, role_users.entitled FROM users INNER JOIN role_users ON role_users_id = id_role_user ORDER BY users.create_date DESC');
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
        $req = $this->prepareDB('INSERT INTO users(pseudo, email, password, role_users_id, create_date) VALUES (?, ?, ?, 3, NOW())',[$method['pseudo'],$method['email'],password_hash($method['password'],PASSWORD_BCRYPT)]);
    }
    public function check_pseudoDB($method) {
        $req= $this->prepareDB('SELECT COUNT(pseudo) FROM users WHERE pseudo = ?',[$method['pseudo']]);
        $unique = $req->fetchColumn();
        if($unique) {
            return 'Ce pseudo est déjà utilisé.';
        }
    }
    public function check_emailDB($method) {
        $req= $this->prepareDB('SELECT COUNT(email) FROM users WHERE email = ?',[$method['email']]);
        $unique = $req->fetchColumn();
        if($unique) {
            return 'Cette adresse email est déjà utilisée.';
        }
    }
    public function login($method) {
        $req= $this->prepareDB('SELECT users.id_user, users.password, users.pseudo FROM users WHERE pseudo = ?',[$method['pseudo']]);
        $user = $req->fetch();
        $validPassword = password_verify($method['password'], $user['password']);
        return ['user' => $user, 'validPassword' => $validPassword];
    }
    public function getUser($userId)
    {
        $req = $this->prepareDB('SELECT users.id_user, users.pseudo, users.email,role_users.entitled FROM users INNER JOIN role_users ON role_users_id = id_role_user WHERE id_user = ?',[$userId]); 
        $user = $req->fetch();
        return $this->userObject($user); 
    }
}
