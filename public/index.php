<link rel="stylesheet" href="../src/estilos.css">
<?php

    require_once __DIR__.'../../vendor/autoload.php';
    use Dotenv\Dotenv;
    use Lib\Router;
    use Controllers\ApiponenteController;
    use Controllers\NorUsuarioController;
    use Controllers\PonenteController;


    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
    
    //echo ResponseHttp::statusMessage(404,'La página de ponentes no existe');

    Router::add('GET','proyecto-cursos',function(){echo 'saludo';});

    Router::add('GET','auth',function(){require '../views/auth.php';});

    /*Router::add('GET','ponente',function(){
        (new ApiponenteController()) -> getAll();
    });*/

    Router::add('GET','ponente/:id',function(int $ponenteid){
         (new ApiponenteController()) -> getPonente($ponenteid);
    });

    //Ruta para crear ponente
    Router::add('POST','ponente/crear',function(){
        (new PonenteController())->crearPonente();
    });

    Router::add('GET','ponente/crear',function(){
        (new PonenteController())->crearPonente();
    });

    //Ruta para actualizar ponente
    Router::add('PUT','ponente/actualizar/:id',function(int $ponenteid){
        (new ApiponenteController())->actualizaPonente($ponenteid);
    });
    
    //Ruta para borrar ponente
    Router::add('GET','ponente/borrar/:id',function(int $ponenteid){
        (new ApiponenteController())->borrarPonente($ponenteid);
    });

    //Ruta para registrar usuario
    Router::add('POST','usuario/registro',function(){
        (new NorUsuarioController())->registro();
    });

    Router::add('GET','usuario/registro',function(){
        (new NorUsuarioController())->registro();
    });

    //Ruta para logear usuario
    Router::add('POST','usuario/login',function(){
        (new NorUsuarioController())->login();
    });

    Router::add('GET','/',function(){
        (new NorUsuarioController())->login();
    });

    Router::add('GET','ponentes',function(){
        (new PonenteController())->mostrar();
    });

    
    Router::dispatch();

?>