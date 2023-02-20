<?php

    namespace Controllers;
    use Controllers\ApiponenteController;

    class PonenteController{

        private ApiponenteController $api;

        public function __construct()
        {
            $this->api=new ApiponenteController();
        }

        public function login(){

            if($_SERVER['REQUEST_METHOD']=='POST'){

            }
            
            
        }

        public function registro(){

        }


    }


?>