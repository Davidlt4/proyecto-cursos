<?php


    namespace Controllers;

    use Models\Usuario;
    use Lib\ResponseHttp;
    use Lib\Pages;
    use Lib\Security;

    class UsuarioController{

        private Pages $pages;
        private Usuario $usuario;


        public function __construct()
        {
            ResponseHttp::setHeaders();
            $this -> usuario = new Usuario();
            $this -> pages = new Pages();
        }

        /*
        public function getPonente($id){
            $ponentes = $this -> ponente->findOne($id);
            $PonenteArr = [];
            if(!empty($ponentes)){
                $PonenteArr["message"] = json_decode(ResponseHttp::statusMessage(202,'OK'));
                $PonenteArr["Ponentes"] = [];
                foreach($ponentes as $fila){
                    $PonenteArr["Ponentes"][] = $fila;
                }
            }else{
                $PonenteArr["message"] = json_decode(ResponseHttp::statusMessage(400, 'No hay ponentes'));
                $PonenteArr["Ponentes"] = [];
            }
            if($PonenteArr==[]){
                $response = json_encode(ResponseHttp::statusMessage(400,'No hay ponentes'));
            }else{
                $response = json_encode($PonenteArr);
            }
            $this -> pages -> render('read',['response' => $response]);
        }*/


        public function registrarUsuario(){

            if($_SERVER['REQUEST_METHOD']=='POST'){

                $usuario=new Usuario();
                $usuario_datos=json_decode(file_get_contents("php://input"));
                //var_dump($usuario->validarDatos($usuario_datos));die;

                if(gettype($usuario->validarDatos($usuario_datos))=="boolean"){

                    $password_segura = Security::encriptaPassw($usuario_datos->password);

                    $usuario->setNombre($usuario_datos->nombre);
                    $usuario->setApellidos($usuario_datos->apellidos);
                    $usuario->setEmail($usuario_datos->email);
                    $usuario->setPassword($password_segura);
                    $usuario->setRol($usuario_datos->rol);
                    $usuario->setConfirmado($usuario_datos->confirmado);

                    if($usuario->registra()){
                        http_response_code(200);
                        $result=json_decode(ResponseHttp::statusMessage(200,"Usuario creado correctamente"));
                    }else{
                        http_response_code(404);
                        $result=json_decode(ResponseHttp::statusMessage(404,"No se ha podido crear el usuario"));
                    }

                }else{
                    http_response_code(404);
                    $result=json_decode(ResponseHttp::statusMessage(404,$usuario->validarDatos($usuario_datos)));
                }


            }else{

                $result=json_decode(ResponseHttp::statusMessage(404,"Error el método de recogida de datos debe de ser POST"));
            }

            $this->pages->render("read",['result'=> json_encode($result)]);

        }




    }