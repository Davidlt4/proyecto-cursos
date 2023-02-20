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
                $datos=$_POST['data'];
                $this->api->login($datos);
            }

            $this->pages->render("usuario/login");
            
        }

        public function registro(){

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $datos=$_POST['data'];
                $this->api->registrarUsuario($datos);
            }

            $this->pages->render("usuario/registro");
        }


    }


?>