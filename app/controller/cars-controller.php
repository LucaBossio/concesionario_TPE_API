<?php

require_once './app/model/cars-model.php';
require_once './app/view/JsonView.php';
require_once './app/model/distributor-model.php';

class CarsController{

    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new CarsModel();
        $this->view = new JsonView();
    }

    public function getAll($req,$res){

        $orderBy = false;
        if(isset($req->query->orderBy)){
            $orderBy = $req->query->orderBy;
        }

        $order = 0;
        if(isset($req->query->order)){
            $order = $req->query->order;
        }

        $cars = $this->model->getCars($orderBy, $order, $req->query);

        if(!$cars){
            $this->view->response("No existen vehiculos", 404);
            return false;
        }

        return $this->view->response($cars);
    }

    public function get($req,$res){
        $id = $req->params->id;
        $car = $this->model->getCarByID($id);

        if(!$car){
            $this->view->response("No existe el vehiculo", 404);
            return;
        }

        return $this->view->response($car);
    }
    /*
    public function showCarsDistributor($distributor_id,$distributors){
        $cars = $this->model->getCarsByDistributor('id_distribuidor', $distributor_id);

        if(!$cars){
            $this->view->showError("No existen vehiculos");
            return;
        }
        $this->view->showCars($cars,$distributors);
    }
    public function showCarForm($id = -1){
        if($id == -1){
            $destiny = 'add';
            $car = null;
        }
        else{
            $car = $this->model->getCarByID($id);
            $destiny = BASE_URL.'vehicles/update/'.$car->id;
        }
        $controllerDis = new DistributorModel();
        $distributors = $controllerDis->getDistributors();
        $this->view->showCarForm($car,$destiny,$distributors);
    }

*/
    public function addCar($req,$res){
        
        if(!isset($req->body->brand) || !isset($req->body->model) || !isset($req->body->categoria) || !isset($req->body->year) || !isset($req->body->doors) || !isset($req->body->power) || !isset($req->body->carPrice) || !isset($req->body->img)|| !isset($req->body->idDistributor) ){
            $this->view->response('Falta completar campos', 400);
            return;
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

        $id = $this->model->addCar($marca,$modelo,$categoria,$anio,$puertas,$hp,$precio,$imagen,$idDis);
        
        if(!$id){
           return $this->view->response('Error al insertar vehiculo', 500);
        }

        $car = $this->model->getCarByID($id);
        return $this->view->response($car, 201);
    }


    /*
    public function deleteCar($id){
        $car = $this->model->getCarByID($id);

        if(!$car){
            $this->view->showError('No existe el vehiculo con id $id');
        }
        $this->model->deleteCar($id);
        header('Location:' . BASE_URL . 'vehicles/list');
    }
        */
    public function update($req,$res){
        $id = $req->params->id;

        $car = $this->model->getCarByID($id);

        if(!$car){
            $this->view->response("No existe el vehiculo", 404);
            return;
        }

        
        if(empty($req->body->marca) || empty($req->body->modelo) || empty($req->body->categoria) || empty($req->body->año) || empty($req->body->puertas) || empty($req->body->hp) || empty($req->body->img)|| empty($req->body->precio) || empty($req->body->id_distribuidor)){
            $this->view->response('Falta completar campos',400);
            return;
        }

        $marca = $req->body->marca;
        $modelo = $req->body->modelo;
        $categoria = $req->body->categoria;
        $anio = $req->body->año;
        $puertas = $req->body->puertas;
        $hp = $req->body->hp;
        $precio = $req->body->precio;	
        $idDis = $req->body->id_distribuidor;
        $imagen = $req->body->img;

        $this->model->updateCar($marca,$modelo,$categoria,$anio,$puertas,$hp,$precio,$id,$idDis,$imagen);
        
        $car = $this->model->getCarByID($id);
        return $this->view->response($car,200);
    }
    /*
    public function showError($error){
        $this->view->showError($error);
    }

    public function showHome(){
        $this->view->showHome();
    }*/
}