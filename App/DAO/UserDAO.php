<?php 
namespace App\DAO;

use App\DAO\Database;
use App\Model\User;

class UserDAO extends Database {

    /**
     * create user object
     *
     * @param  string $data
     *
     * @return object
     */
    private function userObject($data)
    {
        $user = new User();
        $user->setId_user($data['id_user']);
        $user->setPseudo($data['pseudo']);
        $user->setEmail($data['email']);
        isset($data['password']) ? $user->setPassword($data['password']) : '';
        isset($data['create_date']) ? $user->setCreate_date($data['create_date']) : '';
        $user->setRole($data['entitled']);
        isset($data['profile_picture']) ? $user->setProfile_picture($data['profile_picture']) : '';
        return $user;
    }
    /**
     * get all users
     *
     * @return array
     */
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
    /**
     * delete a user in DB
     *
     * @param integer $userId
     *
     */
    public function deleteUser($userId) 
    {
        $req = $this->prepareDB('DELETE FROM users WHERE id_user = ?', [$userId]);
    }
    /**
     * insert a user in DB
     *
     * @param  mixed $method
     *
     */
    public function register($method) 
    {
        $req = $this->prepareDB('INSERT INTO users(pseudo, email, password, role_users_id,profile_picture, create_date) VALUES (?, ?, ?, 3, "default.png", NOW())',[$method['pseudo'],$method['email'],password_hash($method['password'],PASSWORD_BCRYPT)]);
    }
    /**
     * check unique pseudo in DB
     *
     * @param  mixed $method
     *
     * @return void
     */
    public function check_pseudoDB($method) 
    {
        $req= $this->prepareDB('SELECT COUNT(pseudo) FROM users WHERE pseudo = ?',[$method['pseudo']]);
        $unique = $req->fetchColumn();
        if($unique) {
            return 'Ce pseudo est déjà utilisé.';
        }
    }
    /**
     * check unique email in DB
     *
     * @param  mixed $method
     *
     * @return void
     */
    public function check_emailDB($method) 
    {
        $req= $this->prepareDB('SELECT COUNT(email) FROM users WHERE email = ?',[$method['email']]);
        $unique = $req->fetchColumn();
        if($unique) {
            return 'Cette adresse email est déjà utilisée.';
        }
    }
    /**
     * login : check pseudo and valid password in DB
     *
     * @param  mixed $method
     *
     * @return array
     */
    public function login($method) 
    {
        $req = $this->prepareDB('SELECT users.id_user, users.password, users.pseudo, role_users.entitled FROM users INNER JOIN role_users ON id_role_user = role_users_id WHERE pseudo = ?',[$method['pseudo']]);
        $user = $req->fetch();
        $validPassword = password_verify($method['password'], $user['password']);
        return ['user' => $user, 'validPassword' => $validPassword];
    }
    /**
     * get one user
     *
     * @param integer $userId
     *
     * @return object
     */
    public function getUser($userId)
    {
        $req = $this->prepareDB('SELECT users.id_user, users.pseudo, users.email,users.profile_picture,role_users.entitled FROM users INNER JOIN role_users ON role_users_id = id_role_user WHERE id_user = ?',[$userId]); 
        $user = $req->fetch();
        return $this->userObject($user); 
    }
    /**
     * update user profile modification in DB
     *
     * @param  mixed $method
     * @param  integer $userId
     * @param  string $extensionUpload
     *
     */
    public function editUser($method, $userId, $extensionUpload) 
    {  
        $req = $this->prepareDB('UPDATE users SET pseudo = :pseudo, profile_picture = :profile_picture WHERE id_user = :id_user',
        ['pseudo' =>$method['pseudo'], 'profile_picture'=>$_SESSION['id_user']. ".". $extensionUpload,'id_user' => $userId]);
    }
    /**
     * update password modification
     *
     * @param  mixed $method
     * @param  integer $userId
     *
     */
    public function editPassword($method,$userId) 
    {
        $req = $this->prepareDB('UPDATE users SET password = :password WHERE id_user = :id_user',['password'=>password_hash($method['password'],PASSWORD_BCRYPT), 'id_user' => $userId]);  
    } 
}
