<?php

    //Controlador para Usuario
    namespace Controllers;
    use Controllers\UsuarioController;
    use Lib\Pages;

    class NorUsuarioController{

        //Nos declaramos una api de Usuario
        private UsuarioController $api;
        private Pages $pages;


        public function __construct()
        {
            //Inicializamos la api
            $this->api=new UsuarioController();
            $this->pages=new Pages();
        }

        //Función para realizar login a través de la api
        //Y para cargar la vista usuario/login
        public function login():void{

            //Si la petición se realiza por POST
            if($_SERVER['REQUEST_METHOD']=='POST'){

                //Recogemos los datos y los enviamos en formato json a la api
                $datos=json_encode($_POST['data']);
                $result=$this->api->login($datos);
                //Si el login se ha realizado con éxito iniciamos una sesión
                //Para si permitir acceso a los sitios a los que no se podían acceder antes
                if($result->message=="Usuario logeado correctamente"){
                    $_SESSION['usuario']=true;
                }

                //Si la petición se realiza por GET
                //Cargamos la vista mostrando un mensaje para informar al usuario del estado de la petición
                $this->pages->render("usuario/login",['mensaje'=>$result->message]); 
                
            }

            $this->pages->render("usuario/login");
            
        }

        //Función para destruir la sesión creada en login
        public function logout(){

            unset($_SESSION['usuario']);
            session_destroy();
       
            $this->pages->render("usuario/login");

        }

        //Función para registrar a un usuario
        public function registro(){

            //Si la petición se realiza por POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //Recogemos los datos y le damos formato JSON
                $datos=json_encode($_POST['data']);
                //Se lo enviamos a la api para registrar al usuario
                $result=$this->api->registrarUsuario($datos);
                //Cargamos la vista mostrando un mensaje para informar al usuario del estado de la petición
                $this->pages->render("usuario/registro",["mensaje"=>$result->message]);
            }

            //Si la petición se realiza por GET
            $this->pages->render("usuario/registro");
        }


    }


?>