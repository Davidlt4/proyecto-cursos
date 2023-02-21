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

        public function crearPonente(){

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $datos=json_encode($_POST['data']);
                $result=$this->api->crearPonente($datos);
                $this->pages->render("ponente/crear",['mensaje'=>$result->message]);
            }

            $this->pages->render("ponente/crear");
        }

        public function actualizaPonente($ponenteid){

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $datos=json_encode($_POST['data']);
                $this->api->actualizaPonente($ponenteid,$datos);
            }else{
                $ponente=$this->api->getPonente($ponenteid);
                $ponente=json_decode($ponente);
                $this->pages->render("ponente/actualizar",['ponente'=>$ponente->Ponentes[0]]);
            }

            
        }


    }


?>