<?php


    namespace Controllers;

    use Models\Usuario;
    use Lib\ResponseHttp;
    use Lib\Pages;
    use Lib\Security;
    use Firebase\JWT\JWT;

    class UsuarioController{

        private Pages $pages;
        private Usuario $usuario;


        public function __construct()
        {
            ResponseHttp::setHeaders();
            $this -> usuario = new Usuario();
            $this -> pages = new Pages();
        }

        public function registrarUsuario(){

            if($_SERVER['REQUEST_METHOD']=='POST'){

                $usuario=new Usuario();
                $usuario_datos=json_decode(file_get_contents("php://input"));
        
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

        public function login(){

            if($_SERVER['REQUEST_METHOD']=='POST'){

                $usuario=new Usuario();
                $usuario_datos=json_decode(file_get_contents("php://input"));
        
                if(gettype($usuario->validarDatosLogin($usuario_datos))=="boolean"){

                    if(gettype($usuario->login($usuario_datos))=="boolean"){

                        $usuario->setEmail($usuario_datos->email);
                        $this->crearToken($usuario,$usuario_datos->email);
                        http_response_code(200);
                        $result=json_decode(ResponseHttp::statusMessage(200,"Usuario logeado correctamente",$usuario->getToken()));

                    }else{
                        http_response_code(404);
                        $result=json_decode(ResponseHttp::statusMessage(404,$usuario->login($usuario_datos)));
                    }

                }else{
                    http_response_code(404);
                    $result=json_decode(ResponseHttp::statusMessage(404,$usuario->validarDatosLogin($usuario_datos)));
                }


            }else{

                $result=json_decode(ResponseHttp::statusMessage(404,"Error el método de recogida de datos debe de ser POST"));
            }

            $this->pages->render("read",['result'=> json_encode($result)]);

        }

        public function crearToken($usuario,$email){

            $clave=Security::clavesecreta();
            $token=Security::crearToken($clave,[$email]);
            $token_seguro=JWT::encode($token,$clave,'HS256');
            $usuario->setToken($token_seguro);
            $usuario->guardaToken($token["exp"]);

            return $token_seguro;

        }




    }