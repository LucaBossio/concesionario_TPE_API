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
        $conditions = $this->_filtering($filterParams);
        $pagaination = $this->_pagination($filterParams);

        if (!empty($conditions[1])) {
            $sql .= $conditions[0];
        }
        if ( !empty($pagaination)) {
            $sql .= $pagaination[0];
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

        $query->execute($conditions[1]);

        $cars = $query->fetchAll(PDO::FETCH_OBJ);

        return $cars;
    }

    
    public function totalVehicles($filterParams){
        $sql = 'SELECT COUNT(*) as total FROM vehiculos'; 
        $conditions = $this->_filtering($filterParams);

        if (!empty($conditions[0])) {
            $sql .= $conditions[0];
        }
    
        $queryCount = $this->db->prepare($sql);
        $queryCount->execute($conditions[1]);
        $total = $queryCount->fetch(PDO::FETCH_OBJ)->total;
        return $total;
    }


    private function _filtering($filterParams){
        $sql=' WHERE ';

        $filterOptions = [
         "marca" => "=",
         "modelo" => "=", 
         "año_min" => ">=", 
         "año_max" => "<=",
         "puertas_min" => ">=",
         "puertas_max" => "<=", 
         "hp_min" => ">=", 
         "hp_max" => "<=",
         "precio_min" => ">=", 
         "precio_max" => "<=",
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

        if (strlen($sql) == 7) {
           return ["",[]];
        }

        return [$sql, $valueParams];
    }

    private function _pagination($filterParams){

        if (!isset($filterParams->limit) && !isset($filterParams->cantPage)) {
            return [];
        }

        $limit =  $filterParams->limit;
        $page = ( $filterParams->page > 0) ?  $filterParams->page : 1 ;
        $offset = $limit * ($page - 1);
    
        $sql = " LIMIT $limit OFFSET $offset ";

        return [$sql];
    }


    public function getCarByID($id){
        $query = $this->db->prepare('SELECT * FROM vehiculos WHERE id = ?');
        $query->execute([$id]);

        $car = $query->fetch(PDO::FETCH_OBJ);
        return $car;
    }
    
    
    public function addCar($info){

        $query = $this->db->prepare('INSERT INTO vehiculos( marca, modelo, año, puertas, hp, precio, id_distribuidor, categoria, img) VALUES (?,?,?,?,?,?,?,?,?)');
        $query->execute($info);

        $id = $this->db->lastInsertId();
    
        return $id;

    }
    public function updateCar($info){
        $query = $this->db->prepare("UPDATE vehiculos SET marca = ?, modelo = ?, precio = ?, año = ?, puertas = ?, hp = ?, id_distribuidor = ?, categoria = ?, img = ? WHERE id = ?");
        $query->execute($info);
    }



}