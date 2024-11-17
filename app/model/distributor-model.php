<?php
require_once './libs/config.php';
require_once './libs/deploy.php';

class DistributorModel{

    private $db;

    public function __construct(){
        $deploy = new Deploy();
        $this->db= new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);

    }

    // public function getDistributors(){
    //     $query = $this->db->prepare('SELECT * FROM `distribuidor`'); 
    //     $query->execute();
    //     $distributors = $query->fetchAll(PDO::FETCH_OBJ);
    //     return $distributors;
    // }

    public function getDistributorByID($id){
        $query = $this->db->prepare('SELECT * FROM `distribuidor` WHERE id = ?'); 
        $query->execute([$id]);
        $distributors = $query->fetch(PDO::FETCH_OBJ);
        return $distributors;
    }


    // public function setDistributor($nombre, $telefono, $empresa, $img){
    //     $query=$this->db->prepare('INSERT INTO `distribuidor`(`nombre`, `telefono`, `empresa`, `img`) VALUES (?,?,?,?)');
    //     $query->execute([$nombre, $telefono, $empresa, $img]);
    // }

    // public function updateDistributor($nombre, $telefono, $empresa, $img, $id){	
    //     $query=$this->db->prepare('UPDATE `distribuidor` SET nombre = ?, telefono = ?, empresa = ?, img = ? WHERE id = ?');
    //     $query->execute([$nombre, $telefono, $empresa, $img, $id]);
    // }

    // public function deleteDistributor($id){
    //     $query = $this->db->prepare('DELETE FROM `distribuidor` WHERE id = ?'); 
    //     $query->execute([$id]);
    // }

}