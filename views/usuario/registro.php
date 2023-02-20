<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <form action="<?=$_ENV['BASE_URL']?>usuario/registro" method="POST">

        <label>Nombre: </label>
        <input type="text" name="data[nombre]"><br><br>

        <label>Apellidos: </label>
        <input type="text" name="data[apellidos]"><br><br>

        <label>Email: </label>
        <input type="email" name="data[email]"><br><br>

        <label>Contraseña: </label>
        <input type="password" name="data[password]">

        <input type="submit">




    </form>
</body>
</html>