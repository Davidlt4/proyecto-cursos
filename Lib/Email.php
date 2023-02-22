<?php

    namespace Lib;
    use PHPMailer\PHPMailer\PHPMailer;

    class Email{

        private string $email;
        private string $token;

        public function __construct($email,$token){

            $this->email=$email;
            $this->token=$token;

        }

        public function enviarConfirmacion(){

            $mail=new PHPMailer();
            $mail->isSMTP();
            $mail->Host='sandbox.smtp.mailtrap.io';

            $mail->SMTPAuth=true;
            $mail->Port=2525;
            $mail->Username = '0a7f39ce019980';
            $mail->Password = '96f56b7af7ac7d';

            $mail->setFrom('proyectos-cursos@gmail.com','Proyecto-cursos');
            $mail->addAddress($this->email);
            $mail->addAddress("lopez21tap@gmail.com");

            $mail->isHTML(TRUE);
            $mail->CharSet="UTF-8";

            $contenido="<html>";
            $contenido.="<p><strong>Hola ".$this->email."</strong> Has creado tu cuenta en Proyecto-cursos, solo debes confirmarla presionando el siguiente enlace</p>";
            $contenido.="<p>Presiona aquí: <a href='http://localhost/proyecto-cursos/public/usuario/login'>Confirmar Cuenta</a></p>";
            $contenido.="</html>";

            $mail->Body=$contenido;
            $mail->send();


        }
    }



?>