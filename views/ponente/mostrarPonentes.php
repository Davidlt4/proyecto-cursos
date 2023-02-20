<style>

    table {
    width: 100%;
    border: 1px solid #000;
    }
    table, tbody,th, td {
    width: 25%;
    text-align: left;
    vertical-align: top;
    border: 1px solid #000;
    border-collapse: collapse;
    }

</style>

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
                <td><?= $ponente->imagen?></td>
                <td><?= $ponente->tags?></td>
                <td><?= $ponente->redes?></td>
                <td><a href="<?= $_ENV['BASE_URL']?>ponente/borrar/<?=$ponente->id?>">Borrar</a></td>
                <td><a href="<?= $_ENV['BASE_URL']?>ponente/actualizar/<?= $ponente->id?>">Editar</a></td>
            </tr>

        <?php endforeach ?>
    </tbody>
</table>

