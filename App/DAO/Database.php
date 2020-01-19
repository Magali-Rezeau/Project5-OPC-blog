<?php 
namespace App\DAO;

use \PDO;
use \Exception;

abstract class Database 
{   
    const HOST = 'localhost';
    const DB_NAME = 'project5-blog';
    const CHARSET = 'utf8';
    const DB_HOST = 'mysql:host='.self::HOST.';dbname='.self::DB_NAME.';charset='.self::CHARSET;
    const DB_USER = 'root';
    const DB_PASS = 'root';
    private $pdo;
    private function checkPDO()
    {
        if($this->pdo === null) {
            return $this->getPDO();
        }
        return $this->pdo;
    }
    private function getPDO() {
        try{
            $this->pdo = new PDO(self::DB_HOST, self::DB_USER, self::DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }
        catch(Exception $errorPdo)
        {
            die ('Erreur de connection :'.$errorPdo->getMessage());
        }
    }
    protected function queryDB($statement) {
        $req = $this->checkPDO()->query($statement);
        return $req;
    }
    protected function prepareDB($statement, $attributes) {
        $req = $this->checkPDO()->prepare($statement);
        $req->execute($attributes);
        return $req;
    }
}
