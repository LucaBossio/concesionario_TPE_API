<?php
require_once './libs/jwt.php';
class JWTAuthMiddleware {
    public function run($req, $res){

        $auth_header = explode(" ", $_SERVER['HTTP_AUTHORIZATION']);
        if (count($auth_header) != 2) 
            return;

        if ($auth_header[0] != 'Bearer') 
            return;

        $jwt = $auth_header[1];
        $res->user = validateJWT($jwt); 
    }
}