<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <fieldset>
        <legend><h2>Login</h2></legend>
        <form method="POST" action="">

            <label>Email: </label>
            <input type="email" name="data[email]"><br><br>

            <label>Contraseña: </label>
            <input type="password" name="data[password]"><br><br>

            <input type="submit">

        </form>
    </fieldset>

    <span class="mensaje"><?php if(isset($mensaje)){
        echo $mensaje;
    }?></span>

</body>
</html>