<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos cursos</title>
    <link rel="stylesheet" href="../../src/estilos.css">
    <link rel="stylesheet" href="../../../src/estilos.css">
</head>
<body>
    <header>
    <h1>PROYECTOS CURSOS</h1>
        <nav>
            <a href="<?=$_ENV['BASE_URL']?>ponentes">Mostrar Ponentes &nbsp;&nbsp;</a>
            <?php if(isset($_SESSION['usuario'])):?>
                <a href="<?=$_ENV['BASE_URL']?>ponente/crear">Crear Ponente &nbsp;&nbsp;</a>
                <a href="<?=$_ENV['BASE_URL']?>usuario/logout">Cerrar sesion &nbsp;&nbsp;</a>
            <?php else : ?>
                <a href="<?=$_ENV['BASE_URL']?>usuario/registro">Registrate</a>
                <a href="<?=$_ENV['BASE_URL']?>usuario/login">Login</a>
            <?php endif; ?>
            
        </nav>
    </header>
</body>
</html>