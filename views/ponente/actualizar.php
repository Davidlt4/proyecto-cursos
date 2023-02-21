<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
</head>
<body>
    <fieldset>

        <legend><h2>Actualizar Datos</h2></legend>
        <form action="<?= $_ENV['BASE_URL'] ?>ponente/actualizar/<?=$ponente->id?>" method="POST">

            <label>Nombre: </label>
            <input type="text" value="<?=$ponente->nombre?>" name="data[nombre]"><br><br>

            <label>Apellidos: </label>
            <input type="text" value="<?=$ponente->apellidos?>" name="data[apellidos]"><br><br>

            <label>Imagen: </label>
            <input type="text" value="<?=$ponente->imagen?>" name="data[imagen]"><br><br>

            <label>Tags: </label>
            <input type="text" value="<?=$ponente->tags?>" name="data[tags]"><br><br>

            <label>Redes: </label>
            <input type="text" value="<?=$ponente->redes?>" name="data[redes]"><br><br>

            <input type="submit">


        </form>
    </fieldset>

    <span class="mensaje"><?php if(isset($mensaje)){
        echo $mensaje;
    }?></span>
    
</body>
</html>