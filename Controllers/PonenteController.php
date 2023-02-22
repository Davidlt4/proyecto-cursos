<?php

    //Controlador de Ponente
    namespace Controllers;
    use Controllers\ApiponenteController;
    use Lib\Pages;

    class PonenteController{

        //Declaramos la api de Ponentes
        private ApiponenteController $api;
        private Pages $pages;

        public function __construct()
        {
            //Inicializamos la api de Ponentes
            $this->api=new ApiponenteController();
            $this->pages=new Pages();
        }

        //Mostramos los ponentes a tráves de la api
        public function mostrar(){
            //Descodificamos los ponentes dados en JSON
            $ponentes=json_decode($this->api->getAll());
            //Los mostramos a tráves de la vista
            $this->pages->render('ponente/mostrarPonentes',['ponentes'=>$ponentes->Ponentes]);
        }

        //Función para crear Ponente 
        public function crearPonente(){

            //Si la petición se realiza por POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //Recogemos los datos y los codificamos para pasarlos a la api
                $data=$_POST['data'];
                $foto=$_FILES['imagen'];
                $nombre=$foto['name'];
                $tipo=$foto['type'];

                if(($tipo=="image/jpg" || $tipo=="image/jpeg" || $tipo=="image/jpg" || $tipo=="image/png")){

                    if(!is_dir('img')){
                        mkdir('img',0777);
                    }
    
                    move_uploaded_file($foto['tmp_name'],'img/'.$nombre);
    
                }

                $datos=json_encode($data);
                //Enviamos los datos a la api para crear el ponente
                $result=$this->api->crearPonente($datos,$nombre);
                $this->pages->render("ponente/crear",['mensaje'=>$result->message]);
            }

            //Si la petición se realiza por GET
            $this->pages->render("ponente/crear");
        }

        //Actualizamos el ponente cuyo id es ponenteid,dicho parámetro lo obtenemos de la URL
        public function actualizaPonente($ponenteid){

            //Si la petición se realiza por POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //Recogemos los datos y los codificamos para pasarlos a la api
                $datos=json_encode($_POST['data']);

                $foto=$_FILES['imagen'];
                $nombre=$foto['name'];
                $tipo=$foto['type'];

                if(($tipo=="image/jpg" || $tipo=="image/jpeg" || $tipo=="image/jpg" || $tipo=="image/png")){

                    if(!is_dir('img')){
                        mkdir('img',0777);
                    }
    
                    move_uploaded_file($foto['tmp_name'],'img/'.$nombre);
    
                }

                //Actualizamos los datos del ponente con los nuevos datos recogidos desde la vista
                $result=$this->api->actualizaPonente($ponenteid,$datos,$nombre);
                //Buscamos el ponente y mostramos los datos para poder modificarlo a tráves de estos
                $ponente=$this->api->getPonente($ponenteid);
                $ponente=json_decode($ponente);
                $this->pages->render("ponente/actualizar",['ponente'=>$ponente->Ponentes[0],'mensaje'=>$result->message]);
            }else{
                //Si la petición se realiza por GET
                $ponente=$this->api->getPonente($ponenteid);
                $ponente=json_decode($ponente);
                $this->pages->render("ponente/actualizar",['ponente'=>$ponente->Ponentes[0]]);
            }

            
        }


    }


?>