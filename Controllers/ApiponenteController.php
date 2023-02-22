<?php


    //Api para Ponente
    namespace Controllers;

    use Models\Ponente;
    use Lib\ResponseHttp;
    use Lib\Pages;
    use Lib\Security;
    use Models\Usuario;

    class ApiponenteController{

        //Atributo privado ponente de clase Ponente
        private Ponente $ponente;

        //Constructor para ApiPonenteController, donde inicializamos ponente llamando al constructor de dicha clase
        //para así poder llamar a los métodos de dicha clase cuando los necesitemos 
        public function __construct()
        {
            $this -> ponente = new Ponente();
        }

        //Autentificación por token(funciona utilizando POSTMAN o THUNDER CLIENT):

        /*public function getAll(){

            if($_SERVER['REQUEST_METHOD']=='GET'){

                $tokenDatos=Security::validarToken();

                if($tokenDatos !== false && $this->usuario->buscaMail($tokenDatos[0])){

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
                        $result = json_encode(ResponseHttp::statusMessage(400,'No hay ponentes'));
                    }else{
                        $result = json_encode($PonenteArr);
                    }

                }else{
                    $result=json_decode(ResponseHttp::statusMessage(404,"No autentificado"));
                    $result=$result->message;
                }
            }else{
                $result=json_decode(ResponseHttp::statusMessage(404,"Error el método de recogida de datos debe de ser GET"));
            }

            $this -> pages ->render('read',['result' => $result]);
            
        }*/


        //Método que nos devuelve todos los ponentes
        public function getAll(){

            if($_SERVER['REQUEST_METHOD']=='GET'){ 

                //Llamamos al método de obtener todos los ponentes del modelo Ponente
                $ponentes = $this -> ponente->findAll();
                $PonenteArr = [];

                if(!empty($ponentes)){

                    //Si hay ponentes, los guardamos en un array
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
                    $result = json_encode(ResponseHttp::statusMessage(400,'No hay ponentes'));
                }else{
                    $result = json_encode($PonenteArr);
                }

                
            }else{
                $result=json_decode(ResponseHttp::statusMessage(404,"Error el método de recogida de datos debe de ser GET"));
            }

           return $result;
            
        }

        //Obtenemos un ponente a tráves de la id
        public function getPonente($ponenteid){

            $ponentes = $this -> ponente->findOne($ponenteid);
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
                $result = json_encode(ResponseHttp::statusMessage(400,'No hay ponentes'));
            }else{
                $result = json_encode($PonenteArr);
            }
            return $result;
        }


        //Crea un ponente a tráves de ponente_datos, dichos datos están dados en formato JSON
        //Ponente_datos serán los datos que recogemos de la vista ponente/crear
        public function crearPonente($ponente_datos){

            if($_SERVER['REQUEST_METHOD']=='POST'){

                $ponente=new Ponente();
                //Descodificamos los datos
                $datos_ponente=json_decode($ponente_datos);
                

                if(gettype($ponente->validarDatos($datos_ponente))=="boolean"){

                    //Establecemos las propiedades del ponente a través de los datos
                    $ponente->setNombre($datos_ponente->nombre);
                    $ponente->setApellidos($datos_ponente->apellidos);
                    $ponente->setImagen($datos_ponente->imagen);
                    $ponente->setTags($datos_ponente->tags);
                    $ponente->setRedes($datos_ponente->redes);

                    if($ponente->crear()){
                        http_response_code(200);
                        $result=json_decode(ResponseHttp::statusMessage(200,"Ponente creado correctamente"));
                    }else{
                        http_response_code(404);
                        $result=json_decode(ResponseHttp::statusMessage(404,"No se ha podido crear el ponente"));
                    }

                }else{
                    http_response_code(404);
                    $result=json_decode(ResponseHttp::statusMessage(404,$ponente->validarDatos($datos_ponente)));
                }


            }else{

                $result=json_decode(ResponseHttp::statusMessage(404,"Error el método de recogida de datos debe de ser POST"));
            }

            return $result;

        }

        //Actualizamos el ponente cuyo id es ponenteid y cambiamos los datos de dicho ponente
        //por los datos recogidos en la vista ponente/actualizar(ponente_datos) también dados en formato JSON

        public function actualizaPonente($ponenteid,$ponente_datos) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $datos_ponente = $this->ponente->findOne($ponenteid);

            if ($datos_ponente !== false) {

                $ponente = Ponente::fromArray($datos_ponente);
                $datos = json_decode($ponente_datos);

                if (gettype($ponente->validarDatos($datos))=="boolean"){
        
                    //Reescribimos los datos del ponente
                    $ponente->setNombre($datos->nombre);
                    $ponente->setApellidos($datos->apellidos);
                    $ponente->setImagen($datos->imagen);
                    $ponente->setTags($datos->tags);
                    $ponente->setRedes($datos->redes);

                    if ($ponente->actualiza($ponenteid)) {
                        http_response_code(200);
                        $result = json_decode(ResponseHttp::statusMessage(200, "Ponente actualizado"));
                    }
                    else {
                        http_response_code(404);
                        $result = json_decode(ResponseHttp::statusMessage(404, "No se ha podido actualizar el ponente"));
                    }
                }
                else {
                    http_response_code(400);
                    $result = json_decode(ResponseHttp::statusMessage(400,$ponente->validarDatos($datos)));
                }
            }
            else {
                http_response_code(404);
                $result = json_decode(ResponseHttp::statusMessage(404, "No ha encontrado el ponente"));
            }
        }

        return $result;
    }

    //Borramos un ponente a través de su id
    public function borrarPonente($ponenteid){

        if($_SERVER['REQUEST_METHOD']=='GET'){

            $ponente=new Ponente();
            if($ponente->borrar($ponenteid)){
                http_response_code(200);
                $result=json_decode(ResponseHttp::statusMessage(200,"Ponente borrado correctamente"));
            }else{

                http_response_code(404);
                $result=json_decode(ResponseHttp::statusMessage(404,"No se ha podido borrar el ponente"));
            }

        }

        header('Location:'.$_ENV['BASE_URL'].'ponentes');

    }



    }