<?php

    namespace Controllers;
    use Controllers\UsuarioController;
    use Lib\Pages;

    class NorUsuarioController{

        private UsuarioController $api;
        private Pages $pages;

        public function __construct()
        {
            $this->api=new UsuarioController();
            $this->pages=new Pages();
        }

        public function login():void{

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $datos=json_encode($_POST['data']);
                $result=$this->api->login($datos);
                if($result->message=="Usuario logeado correctamente"){
                    $_SESSION['usuario']=true;
                }
                $this->pages->render("usuario/login",['mensaje'=>$result->message]); 
                
            }

            $this->pages->render("usuario/login");
            
        }

        public function logout(){
            
            unset($_SESSION['usuario']);
            session_destroy();
       
            $this->pages->render("usuario/login");

        }

        public function registro(){

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $datos=json_encode($_POST['data']);
                $result=$this->api->registrarUsuario($datos);
                $this->pages->render("usuario/registro",["mensaje"=>$result->message]);
            }

            $this->pages->render("usuario/registro");
        }


    }


?>