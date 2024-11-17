<?php

require_once './app/model/cars-model.php';
require_once './app/view/JsonView.php';
require_once './app/model/distributor-model.php';

class CarsController{

    private $modelcars;
    private $modelDis;
    private $view;

    public function __construct()
    {
        $this->modelCar = new CarsModel();
        $this->view = new JsonView();
        $this->modelDis = new DistributorModel();
    }

    public function getAll($req,$res){

        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;
        

        $order = 0;
        if(isset($req->query->order))
            $order = $req->query->order;

        if(!$this->checkRightParmas($req->query))
            return $this->view->response("Parametros no adecuados", 400); 

        if(isset($req->query->limit))
            $limit = $req->query->limit;
            $page = $req->query->page;
            if ((($limit <= 0) || $page <1 ) || (($limit * ($page-1)) >= $this->modelCar->totalVehicles($req->query) )) {
                return $this->view->response("", 204);
            
        }
        


        $cars = $this->modelCar->getCars($orderBy, $order, $req->query);

        if(!$cars)
            return $this->view->response("No existen vehiculos", 404);
            
      

        return $this->view->response($cars);
    }


    public function checkRightParmas($paramas){
        $fields = [  
            "año_min" , 
            "año_max" ,
            "puertas_min" ,
            "puertas_max" , 
            "hp_min" ,
            "hp_max" ,
            "precio_min" , 
            "precio_max" ,
            "id_distribuidor",
            "limit",
            "page"
           ];

           foreach ($fields as $param => $value) {

                if (!isset($paramas->$value) ) {
                    continue;
                }
                $val = $paramas->$value;

                if ((!is_numeric($val) || ( $val < 0))) {
                    return false; 
                }
           }

           return true;

    }

    public function get($req,$res){
        $id = $req->params->id;
        $car = $this->modelCar->getCarByID($id);

        if(!$car)
            return $this->view->response("No existe el vehiculo", 404);
        

        return $this->view->response($car);
    }


    public function addCar($req,$res){

        if(!$res->user) 
            return $this->view->response("No autorizado", 401);
        

        $info = $this->validateInfo($req);

        if ($info == null) 
            return $this->view->response('Datos incompatibles o faltantes', 400);
    

        $id = $this->modelCar->addCar($info);
        
        if(!$id)
           return $this->view->response('Error al insertar vehiculo', 500);
        

        $car = $this->modelCar->getCarByID($id);
        return $this->view->response($car, 201);
    }



    public function update($req,$res){
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }

        $id = $req->params->id;

        $car = $this->modelCar->getCarByID($id);

        if(!$car){
            $this->view->response("No existe el vehiculo", 404);
            return;
        }

        $info = $this->validateInfo($req);
        if ($info == null) return $this->view->response('Datos incompatibles o faltantes', 400);

        $this->modelCar->updateCar($info);
        
        $car = $this->modelCar->getCarByID($id);
        return $this->view->response($car,200);
    }



    public function existeDist($disID){
        return $this->modelDis->getDistributorByID($disID);
    }


    public function validateInfo($req){
         
        if(!isset($req->body->brand) || !isset($req->body->model) || !isset($req->body->category) || !isset($req->body->year) || !isset($req->body->doors) || !isset($req->body->power) || !isset($req->body->carPrice) || !isset($req->body->img)|| !isset($req->body->idDistributor) ){
            return null;
        } 

        if ($this->existeDist($req->body->idDistributor) == null) {
            return null;
        }

        $marca = $req->body->brand;
        $modelo = $req->body->model;
        $categoria =$req->body->categoria;
        $anio = $req->body->year;
        $puertas = $req->body->doors;
        $hp = $req->body->power;
        $precio = $req->body->carPrice;
        $idDis = $req->body->idDistributor;
        $imagen = $req->body->img;

        return ([$marca, $modelo, $categoria, $anio,$puertas, $hp,$precio,  $idDis, $imagen]);
    }


}

