<?php

    //Api para Usuario
    namespace Controllers;

    use Models\Usuario;
    use Lib\ResponseHttp;
    use Lib\Email;
    use Lib\Security;
    use Firebase\JWT\JWT;

    class UsuarioController{

        //Iniciamos la librería de email para poder enviar el correo cuando te registras
        private Email $host_email;

        public function __construct()
        {
            $this -> host_email = new Email();
        }


        //Función para registrar a un usuario a través de los datos usuario_datos dados en formato JSON
        public function registrarUsuario($usuario_datos){


            if($_SERVER['REQUEST_METHOD']=='POST'){

                $usuario=new Usuario();
                //Descodificamos los datos
                $usuario_datos=json_decode($usuario_datos);
                
                //Validamos los datos
                if(gettype($usuario->validarDatos($usuario_datos))=="boolean"){

                    //Ciframos la contraseña
                    $password_segura = Security::encriptaPassw($usuario_datos->password);

                    //Asignamos los datos al usuario
                    $usuario->setNombre($usuario_datos->nombre);
                    $usuario->setApellidos($usuario_datos->apellidos);
                    $usuario->setEmail($usuario_datos->email);
                    $usuario->setPassword($password_segura);
                    $usuario->setRol("alumno");
                    $usuario->setConfirmado("no");

                    if($usuario->registra()){
                        //Si el registro se ha realizado con éxito, enviamos un correo de confirmación
                        $this->host_email->enviarConfirmacion($usuario->getEmail());
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

            return $result;

        }

        //Función para realizar el login de un usuario
        public function login($usuario_datos){

            if($_SERVER['REQUEST_METHOD']=='POST'){

                $usuario=new Usuario();
                //Descodificamos los datos
                $usuario_datos=json_decode($usuario_datos);
                
                //Validamos los datos
                if(gettype($usuario->validarDatosLogin($usuario_datos))=="boolean"){
                    //Si la validación es correcto logeamos
                    if(gettype($usuario->login($usuario_datos))=="boolean"){
                        //Creamos el token
                        $usuario->setEmail($usuario_datos->email);
                        $this->crearToken($usuario,$usuario_datos->email);
                        http_response_code(200);
                        $result=json_decode(ResponseHttp::statusMessage(200,"Usuario logeado correctamente"));

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

            return $result;

        }

        //Función para crear token a través del email y usuario
        public function crearToken($usuario,$email){

            $clave=Security::clavesecreta();
            $token=Security::crearToken($clave,[$email]);
            $token_seguro=JWT::encode($token,$clave,'HS256');
            $usuario->setToken($token_seguro);
            $usuario->guardaToken($token["exp"]);

            return $token_seguro;

        }



    }