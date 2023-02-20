<?php

    require_once __DIR__.'../../vendor/autoload.php';
    use Dotenv\Dotenv;
    use Lib\Router;
    use Controllers\ApiponenteController;
    use Controllers\NorUsuarioController;
    use Controllers\UsuarioController;


    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
    
    //echo ResponseHttp::statusMessage(404,'La página de ponentes no existe');

    Router::add('GET','proyecto-cursos',function(){echo 'saludo';});

    Router::add('GET','auth',function(){require '../views/auth.php';});

    Router::add('GET','ponente',function(){
        (new ApiponenteController()) -> getAll();
    });

    Router::add('GET','ponente/:id',function(int $ponenteid){
         (new ApiponenteController()) -> getPonente($ponenteid);
    });

    //Ruta para crear ponente
    Router::add('POST','ponente/crear',function(){
        (new ApiponenteController())->crearPonente();
    });

    //Ruta para actualizar ponente
    Router::add('PUT','ponente/actualizar/:id',function(int $ponenteid){
        (new ApiponenteController())->actualizaPonente($ponenteid);
    });
    
    //Ruta para borrar ponente
    Router::add('DELETE','ponente/borrar/:id',function(int $ponenteid){
        (new ApiponenteController())->borrarPonente($ponenteid);
    });

    //Ruta para registrar usuario
    Router::add('POST','usuario/registro',function(){
        (new UsuarioController())->registrarUsuario();
    });

    //Ruta para logear usuario
    Router::add('POST','usuario/login',function(){
        (new NorUsuarioController())->login();
    });

    Router::add('GET','/',function(){
        (new NorUsuarioController())->login();
    });

    
    Router::dispatch();

?>