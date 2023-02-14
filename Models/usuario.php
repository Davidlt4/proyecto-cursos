<?php

    namespace Models;

    use Exception;
    use PDO;
    use PDOException;
    use Lib\BaseDatos;


    class Usuario extends BaseDatos{

        private string $id;
        private string $nombre;
        private string $apellidos;
        private string $email;
        private string $password;
        private string $rol;
        private string $confirmado;
        private string $token;
        private string $token_exp;


        public function __construct()
        {
            parent::__construct();
        }


        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
            return $this;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
            return $this;
        }

        public function getApellidos() {
            return $this->apellidos;
        }

        public function setApellidos($apellidos) {
            $this->apellidos = $apellidos;
            return $this;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
            return $this;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            $this->password = $password;
            return $this;
        }

        public function getRol() {
            return $this->rol;
        }

        public function setRol($rol) {
            $this->rol = $rol;
            return $this;
        }

        public function getConfirmado() {
            return $this->confirmado;
        }

        public function setConfirmado($confirmado) {
            $this->confirmado = $confirmado;
            return $this;
        }

        public function getToken() {
            return $this->token;
        }

        public function setToken($token) {
            $this->token = $token;
            return $this;
        }

        public function getToken_exp() {
            return $this->token_exp;
        }

        public function setToken_exp($token_exp) {
            $this->token_exp = $token_exp;
            return $this;
        }


        public static function fromArray(array $data): Usuario {
            return new Usuario (
                $data['id'],
                $data['nombre'],
                $data['apellidos'],
                $data['email'],
                $data['password'],
                $data['rol'],
                $data['confirmado']
            );
        }

        //para comprobar si el correo del usuario ya existe
        public function existe($email):bool{
            

            $sql = ("SELECT email FROM usuarios WHERE email = :email");
            $consulta = $this -> prepara($sql);
            $consulta -> bindParam(':email',$email);

            try{
                $consulta->execute();
                if($consulta->rowCount()==1){
                    $result = true;
                }else{
                    $result=false;
                }
            }catch(PDOException $err){
                return false;
            }

            return $result;

        }

        //validación de datos
        public function validaCampos($usuario_datos):bool|string{

            if(!preg_match("/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/",$usuario_datos->email)){
                return "Correo no válido";
            }
            if(!preg_match("/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]{3,16}$/",$usuario_datos->nombre)){
                return "Solo pueden introducirse letras y espacios para el nombre";
            }
            if(!preg_match("/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]{3,16}$/",$usuario_datos->apellidos)){
                return "Solo pueden introducirse letras y espacios para los apellidos";
            }
            if(!preg_match("/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,14}$/",$usuario_datos->password)){
                return "La contrasena debe medir entre 6 y 14 caracteres, al menos tener un numero, al menos una minuscula y al menos una mayuscula";
            }
            if(!($usuario_datos->rol=="user" || $usuario_datos->rol=="admin")){
                return "El rol solo puede ser User o Admin";
            }
            return true;
        }

        //Función  para comprobar si todos los datos son validos
        public function validarDatos($usuario_datos):bool|string{

            if(!empty($usuario_datos->nombre) && !empty($usuario_datos->apellidos) && !empty($usuario_datos->email) && !empty($usuario_datos->password) && !empty($usuario_datos->rol && !empty($usuario_datos->confirmado))){

                $valida_campo=$this->validaCampos($usuario_datos);
                $existe=$this->existe($usuario_datos->email);

                if($existe){
                    return "Este correo ya existe";
                }
                if(gettype($valida_campo)!="boolean"){
                    return $valida_campo;
                }
            }else{
                return false;
            }

            return true;

        }

        public function registra(){

            $statement = $this->prepara("INSERT INTO usuarios (nombre, apellidos, email, password, rol,confirmado) values (:nombre, :apellidos, :email,:password,:rol,:confirmado)");

            $statement->bindParam(':nombre',$this->nombre, PDO::PARAM_STR);
            $statement->bindParam(':apellidos',$this->apellidos, PDO::PARAM_STR);
            $statement->bindParam(':email',$this->email, PDO::PARAM_STR);
            $statement->bindParam(':password',$this->password, PDO::PARAM_STR);
            $statement->bindParam(':rol',$this->rol, PDO::PARAM_STR);
            $statement->bindParam(':confirmado',$this->confirmado, PDO::PARAM_STR);

            try{
                $statement->execute();
                $result = true;
            }catch(PDOException $err){
                $result = false;
            }
            return $result;
        
        }

    /*
    public function login($datos):bool{

       
    }*/


}
?>