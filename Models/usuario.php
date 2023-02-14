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
        public function existe(array $usuario):bool{
            
            $sql = ("SELECT email FROM usuarios WHERE email = :email");
            $consulta = $this -> prepara($sql);
            $consulta -> bindParam(':email',$usuario['email']);

            try{
                $consulta->execute();
                if($consulta->rowCount()==1){
                    $result = true;
                }else{
                    $result=false;
                }
            }catch(PDOException $err){
                $result = false;
            }
            return $result;

        }

        //Función  para comprobar si todos los datos son validos
        public function validarDatos($datos_usuario):bool{

            if(!empty($datos_usuario->nombre) && !empty($datos_usuario->apellidos) && !empty($datos_usuario->email) && !empty($datos_usuario->password) && !empty($datos_usuario->rol && !empty($datos_usuario->confirmado))){
                return true;
            }else{
                return false;
            }

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