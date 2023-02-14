<?php


    namespace Controllers;
    use Models\Usuario;
    use Lib\ResponseHttp;
    use Lib\Pages;

    class ApiponenteController{

        private Pages $pages;
        private Usuario $usuario;


        public function __construct()
        {
            ResponseHttp::setHeaders();
            $this -> usuario = new Usuario();
            $this -> pages = new Pages();
        }


        public function login(){
            
        }

        public function registro(){

        }


        /*public function getAll(){
            $ponentes = $this -> ponente->findAll();
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
            
        }

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
    }