<?php

    //Modelo Ponente
    namespace Models;

    use Exception;
    use PDO;
    use PDOException;
    use Lib\BaseDatos;


    class Ponente{

            //Atributos de Ponentes
            private string $id;
            private string $nombre;
            private string $apellidos;
            private string $imagen;
            private string $tags;
            private string $redes;

            private BaseDatos $conexion;

            public function __construct()
            {
                //Iniciamos la conexion a la base de datos
                $this -> conexion = new BaseDatos();
            }

            /**
             * Get the value of id
             */ 
            public function getId()
            {
                        return $this->id;
            }

            /**
             * Set the value of id
             *
             * @return  self
             */ 
            public function setId($id)
            {
                        $this->id = $id;

                        return $this;
            }

            /**
             * Get the value of nombre
             */ 
            public function getNombre()
            {
                        return $this->nombre;
            }

            /**
             * Set the value of nombre
             *
             * @return  self
             */ 
            public function setNombre($nombre)
            {
                        $this->nombre = $nombre;

                        return $this;
            }

            /**
             * Get the value of apellidos
             */ 
            public function getApellidos()
            {
                        return $this->apellidos;
            }

            /**
             * Set the value of apellidos
             *
             * @return  self
             */ 
            public function setApellidos($apellidos)
            {
                        $this->apellidos = $apellidos;

                        return $this;
            }

            /**
             * Get the value of imagen
             */ 
            public function getImagen()
            {
                        return $this->imagen;
            }

            /**
             * Set the value of imagen
             *
             * @return  self
             */ 
            public function setImagen($imagen)
            {
                        $this->imagen = $imagen;

                        return $this;
            }

            /**
             * Get the value of tags
             */ 
            public function getTags()
            {
                        return $this->tags;
            }

            /**
             * Set the value of tags
             *
             * @return  self
             */ 
            public function setTags($tags)
            {
                        $this->tags = $tags;

                        return $this;
            }

            /**
             * Get the value of redes
             */ 
            public function getRedes()
            {
                        return $this->redes;
            }

            /**
             * Set the value of redes
             *
             * @return  self
             */ 
            public function setRedes($redes)
            {
                        $this->redes = $redes;

                        return $this;
            }

            //Sacamos todos los ponentes de la base de datos
            public function findAll(){
                $statement = "SELECT * FROM ponentes;";

                try{
                    $statement = $this -> conexion -> consulta($statement);
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            //Sacamos el ponente a tráves de la id
            public function findOne($id){
                $statement = "SELECT * FROM ponentes WHERE id=$id;";

                try{
                    $statement = $this -> conexion -> consulta($statement);
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            //Función auxiliar par validar los Campos pasados como parámetros
            public function validarCampos($datos_ponente):string|bool{

                //Para validar nombre y apellidos
                $nombreval = "/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/";

                //Para validar los tags
                $tagval = "/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/";

                //Válidar la imagen
                $imgval = "/^.*\.(jpg|png|jpeg)$/";

                if(!preg_match($nombreval, $datos_ponente -> nombre)){
                    return "El nombre solo puede contener letras y espacios";
                }
        
                if(!preg_match($nombreval, $datos_ponente -> apellidos)){
                    return "El apellido solo puede contener letras y espacios";
                }

                if(!preg_match($imgval, $datos_ponente -> imagen)){
                    return "La imagen debe tener alguno de los siguientes formatos: nombreimagen.jpg/png/jpeg";
                }

                if(!preg_match($tagval,$datos_ponente -> tags)){
                    return "Los tags solo pueden contener letras";
                }

                return true;
                
            }

            //Validamos que todos los campos estén completos y sean correctos, si lo son devolvemos true, si no devolvemos un mensaje
            //Indicando donde está el fallo

            public function validarDatos($datos_ponente):bool|string{

                if(!empty($datos_ponente->nombre) && !empty($datos_ponente->apellidos) && !empty($datos_ponente->imagen) && !empty($datos_ponente->tags) && !empty($datos_ponente->redes)){
                    $result=$this->validarCampos($datos_ponente);
        
                    if(gettype($result)=="boolean"){
                        return true;
                    }else{
                        return $result;
                    }
                    
                }else{
                    return "Rellena todos los campos";
                }

            }

            //Función para añadir un ponente a la base de datos
            public function crear(){

                $statement = $this -> conexion->prepara("INSERT INTO ponentes(nombre,apellidos,imagen,tags,redes) VALUES (:nombre,:apellidos,:imagen,:tags,:redes)");

                $statement->bindParam(":nombre",$this->nombre,PDO::PARAM_STR);
                $statement->bindParam(":apellidos",$this->apellidos,PDO::PARAM_STR);
                $statement->bindParam(":imagen",$this->imagen,PDO::PARAM_STR);
                $statement->bindParam(":tags",$this->tags,PDO::PARAM_STR);
                $statement->bindParam(":redes",$this->redes,PDO::PARAM_STR);


                try{
                    $statement = $statement->execute();
                    return true;
                }catch(\PDOException $e){
                    return false;
                }
            }

            //Función para actualizar el ponente con los datos pasados como parámetro
            public function actualiza($ponenteid):bool{
            
                $statement = $this -> conexion->prepara("UPDATE ponentes SET nombre=:nombre,apellidos=:apellidos,imagen=:imagen,tags=:tags,redes=:redes WHERE id=:id");


                $statement->bindParam(":nombre",$this->nombre,PDO::PARAM_STR);
                $statement->bindParam(":apellidos",$this->apellidos,PDO::PARAM_STR);
                $statement->bindParam(":imagen",$this->imagen,PDO::PARAM_STR);
                $statement->bindParam(":tags",$this->tags,PDO::PARAM_STR);
                $statement->bindParam(":redes",$this->redes,PDO::PARAM_STR);
                $statement->bindParam(":id",$ponenteid,PDO::PARAM_INT);


                try{
                    $statement = $statement->execute();
                    return true;
                }catch(\PDOException $e){
                    return false;
                }
                

            }


            //Borramos ponente de la base de datos a tráves de la id
            public function borrar($id){
                $statement = $this -> conexion->prepara("DELETE FROM ponentes WHERE id = :id");
                $statement->bindParam(":id",$id);

                try{
                    $statement = $statement->execute();
                    return true;
                }catch(\PDOException $e){
                    return false;
                }
            }

            //Transformamos un array en un objeto Ponente
            public static function fromArray($datos){

                $ponente=new Ponente();

                $ponente->setId($datos[0]['id']);
                $ponente->setNombre($datos[0]['nombre']);
                $ponente->setApellidos($datos[0]['apellidos']);
                $ponente->setImagen($datos[0]['imagen']);
                $ponente->setTags($datos[0]['tags']);
                $ponente->setRedes($datos[0]['redes']);

                return $ponente;

            }

        }