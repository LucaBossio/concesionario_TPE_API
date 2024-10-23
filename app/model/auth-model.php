<?php
require_once './libs/config.php';
require_once './libs/deploy.php';

class AuthModel{
    private $db;

    public function __construct(){
        $deploy = new Deploy();
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }

    public function getUser($username){
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario = ?');
        $query->execute([$username]);

        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }
}