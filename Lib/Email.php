<?php

    //Librería para enviar un correo
    namespace Lib;
    use PHPMailer\PHPMailer\PHPMailer;

    class Email{

        /*private string $email;
        private string $token;*/

        /*public function __construct($email,$token){

            $this->email=$email;
            $this->token=$token;

        }*/

        public function __construct()
        {
            
        }

        //Función para enviar un email de confirmación al correo pasado como parámetro en el registro
        public function enviarConfirmacion($email){

            $mail=new PHPMailer();
            $mail->isSMTP();
            $mail->Host='sandbox.smtp.mailtrap.io';

            $mail->SMTPAuth=true;
            $mail->Port=2525;
            $mail->Username = '0a7f39ce019980';
            $mail->Password = '96f56b7af7ac7d';

            $mail->setFrom('proyectos-cursos@gmail.com','Proyecto-cursos');
            $mail->addAddress("$email");

            $mail->isHTML(TRUE);
            $mail->CharSet="UTF-8";
            $mail->Subject="Correo de confirmación";

            //Definimos el contenido del correo, con un enlace hacía el login
            $contenido="<html>";
            $contenido.="<p><Has>Hola has creado tu cuenta en Proyecto-cursos, solo debes confirmarla presionando el siguiente enlace</p>";
            $contenido.="<p>Presiona aquí: <a href=".$_ENV['BASE_URL']."usuario/login>Confirmar Cuenta</a></p>";
            $contenido.="</html>";

            $mail->Body=$contenido;
            $mail->send();


        }
    }



?>