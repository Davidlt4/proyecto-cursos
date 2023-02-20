<?php

    namespace Controllers;
    use Controllers\ApiponenteController;
    use Lib\Pages;

    class PonenteController{

        private ApiponenteController $api;
        private Pages $pages;

        public function __construct()
        {
            $this->api=new ApiponenteController();
            $this->pages=new Pages();
        }

        public function mostrar(){
            $ponentes=json_decode($this->api->getAll());
            $this->pages->render('ponente/mostrarPonentes',['ponentes'=>$ponentes->Ponentes]);
        }


    }


?>