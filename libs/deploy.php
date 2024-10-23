<?php
require_once 'config.php';
class Deploy{

    private $db;
    public function __construct(){
        $this->db = new PDO('mysql:host='.MYSQL_HOST , MYSQL_USER , MYSQL_PASS);
        $this->_createDatabase();
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER , MYSQL_PASS);
        $this->_deploy();
    }

    private function _createDatabase() {
      $query = $this->db->query("SHOW DATABASES LIKE '".MYSQL_DB."'");
      $exists = $query->fetch();

      if (!$exists) {
          $this->db->exec("CREATE DATABASE IF NOT EXISTS `".MYSQL_DB."` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
      }
  }




     private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql = file_get_contents('./db/concesionario_marcosyluca.sql');
            $this->db->query($sql);
        }
    }
}