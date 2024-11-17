<?php
require_once './app/model/user-model.php';
require_once './app/view/JsonView.php';
require_once './libs/jwt.php';
class UserApiControler{

    private $model;
    private $view;

    public function __construct(){
        $this->model = new UserModel();
        $this->view = new JsonView();
    }

    public function getToken(){
        $auth_header = explode(" ", $_SERVER["HTTP_AUTHORIZATION"]);
        if (count($auth_header) != 2 || $auth_header[0] != "Basic") 
            return $this->view->response("Erros datos incorrectos", 400);
        

        $user_pass = explode(":", base64_decode($auth_header[1]));
        $user = $this->model->getUser($user_pass[0]);

        if ($user == null || !password_verify( $user_pass[1], $user->contrasenia)) 
            return $this->view->response("Erros datos incorrectos", 400);
        
        $token = createJWT(array(
            'sub' => $user->id,
            'name' => $user->usuario,
            'role' => 'admin',
            'iat' => time(),
            'exp' => time() + 600,

        ));

        return $this->view->response($token);
    }
}