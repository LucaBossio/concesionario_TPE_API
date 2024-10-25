<?php
require_once './libs/config.php';
require_once './libs/deploy.php';

class CarsModel{
    protected $db;

    public function __construct()
    {
        $deploy = new Deploy();
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);

    }

    public function getCars($orderBy = false, $order = 0, $filterParams){
        $sql = 'SELECT * FROM vehiculos';
        $where = $this->whereMaker($filterParams);
        if (strlen($where[0])>7) {
            $sql .= $where[0];
        }else{
            $where[1]=[];
        }


        if($orderBy){
            switch ($orderBy) {
                case 'price':
                    $sql .= ' ORDER BY precio';
                break;
                case 'year':
                    $sql .= ' ORDER BY año';
                break;
                case 'brand':
                    $sql .= ' ORDER BY marca';
                break;
            }
        
            switch ($order) {
                case '0':
                    $sql .= ' DESC';
                break;
                case '1':
                    $sql .= ' ASC';
                break;
        }
        }
        $query = $this->db->prepare($sql);
        $query->execute($where[1]);

        $cars = $query->fetchAll(PDO::FETCH_OBJ);
        return $cars;
    }


    public function whereMaker($filterParams){
        $sql=' WHERE ';


        $filterOptions = [
         "marca" => "=",
         "modelo" => "=", 
         "año_min" => ">", 
         "año_max" => "<",
         "puertas_min" => ">",
         "puertas_max" => "<", 
         "hp_min" => ">", 
         "hp_max" => "<",
         "precio_min" => ">", 
         "precio_max" => "<",
         "categoria" => "=",
         "id_distribuidor"=>"="
        ];

        $valueParams=[];

        foreach ($filterOptions as $field => $operator) {
            if (isset($filterParams->$field)) {
                $column = str_replace(['_min', '_max'], '', $field);
              
                $sql .= " $column $operator ? AND";
                $valueParams[] = $filterParams->$field;
            }
        }
        $sql = rtrim($sql, "AND");
        return [$sql, $valueParams];
    }
    /*public function getCarsByDistributor($field, $distributor_id){
        $query = $this->db->prepare("SELECT * FROM vehiculos WHERE $field = ?");
        $query->execute([$distributor_id]);
        $cars = $query->fetchAll(PDO::FETCH_OBJ);
        return $cars;
    }*/

    public function getCarByID($id){
        $query = $this->db->prepare('SELECT * FROM vehiculos WHERE id = ?');
        $query->execute([$id]);

        $car = $query->fetch(PDO::FETCH_OBJ);
        return $car;
    }
    
    
    public function addCar($marca,$modelo,$categoria,$anio,$puertas,$hp,$precio,$imagen,$idDis){

        $query = $this->db->prepare('INSERT INTO vehiculos( marca, modelo, año, puertas, hp, precio, id_distribuidor, categoria, img) VALUES (?,?,?,?,?,?,?,?,?)');
        $query->execute([$marca,$modelo,$anio,$puertas,$hp,$precio, $idDis ,$categoria,$imagen]);

        $id = $this->db->lastInsertId();
    
        return $id;

    }
/*
    public function deleteCar($id){
        $query = $this->db->prepare('DELETE FROM vehiculos WHERE id = ?');
        $query->execute([$id]);


    }

    */
    public function updateCar($marca,$modelo,$categoria,$anio,$puertas,$hp,$precio,$id,$idDis,$imagen){
        $query = $this->db->prepare("UPDATE vehiculos SET marca = ?, modelo = ?, precio = ?, año = ?, puertas = ?, hp = ?, id_distribuidor = ?, categoria = ?, img = ? WHERE id = ?");
        $query->execute([$marca,$modelo,$precio,$anio,$puertas,$hp,$idDis,$categoria,$imagen,$id]);
    }


}