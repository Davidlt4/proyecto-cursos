<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../../src/estilos.css"> -->
</head>
<body>
    

<table border="1">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Imagen</th>
            <th>Tags</th>
            <th>Redes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ponentes as $ponente): ?>
            <tr>
                <td><?= $ponente->id ?></td>
                <td><?= $ponente->nombre ?></td>
                <td><?= $ponente->apellidos?></td>
                <td><img width="40px" height="40px" src="img/<?=$ponente->imagen?>"></td>
                <td><?= $ponente->tags?></td>
                <td><?= $ponente->redes?></td>
                <?php if(isset($_SESSION['usuario'])):?>
                    <td><a href="<?= $_ENV['BASE_URL']?>ponente/borrar/<?=$ponente->id?>">Borrar</a></td>
                    <td><a href="<?= $_ENV['BASE_URL']?>ponente/actualizar/<?= $ponente->id?>">Editar</a></td>
                <?php endif; ?>
            </tr>

        <?php endforeach ?>
    </tbody>
</table>
</body>
</html>

