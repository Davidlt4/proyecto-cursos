<link rel="stylesheet" href="../src/estilos.css">
<?php

    //Iniciamos las sesiones
    session_start();
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

    //Ruta para ver un ponente

    Router::add('GET','ponente/:id',function(int $ponenteid){
         (new ApiponenteController()) -> getPonente($ponenteid);
    });

    //Ruta para crear ponente a tráves de POST
    Router::add('POST','ponente/crear',function(){
        (new PonenteController())->crearPonente();
    });

    //Ruta para cargar la vista crear ponente
    Router::add('GET','ponente/crear',function(){
        if(isset($_SESSION['usuario'])){
            (new PonenteController())->crearPonente();
        }else{
            header('Location:'.$_ENV['BASE_URL'].'usuario/login');
        }
    });

    //Ruta para actualizar ponente
    Router::add('POST','ponente/actualizar/:id',function(int $ponenteid){
        (new PonenteController())->actualizaPonente($ponenteid);   
    });

    //Ruta para cargar la vista actualizar ponente
    Router::add('GET','ponente/actualizar/:id',function(int $ponenteid){

        if(isset($_SESSION['usuario'])){
            (new PonenteController())->actualizaPonente($ponenteid);
        }else{
            header('Location:'.$_ENV['BASE_URL'].'usuario/login');
        }

    });
    
    //Ruta para borrar ponente
    Router::add('GET','ponente/borrar/:id',function(int $ponenteid){

        if(isset($_SESSION['usuario'])){
            (new ApiponenteController())->borrarPonente($ponenteid);
        }else{
            header('Location:'.$_ENV['BASE_URL'].'usuario/login');
        }

    });

    //Ruta para registrar usuario a tráves de POST
    Router::add('POST','usuario/registro',function(){
        (new NorUsuarioController())->registro();
    });

    //Ruta para cargar la vista de usuario registro
    Router::add('GET','usuario/registro',function(){
        (new NorUsuarioController())->registro();
    });

    //Ruta para logear a un usuario
    Router::add('POST','usuario/login',function(){
        (new NorUsuarioController())->login();
    });

    //Ruta para cargar la vista usuario login
    Router::add('GET','usuario/login',function(){
        (new NorUsuarioController())->login();
    });

    //Ruta para cerrar sesión del usuario
    Router::add('GET','usuario/logout',function(){
        (new NorUsuarioController())->logout();
    });

    //Ruta raíz donde se muestran los ponentes
    Router::add('GET','/',function(){
        (new PonenteController())->mostrar();
    });

    //Ruta para mostrar los ponentes
    Router::add('GET','ponentes',function(){
        (new PonenteController())->mostrar();
    });

    
    Router::dispatch();

?>