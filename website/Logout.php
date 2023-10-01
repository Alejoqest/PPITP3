<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout page</title>
</head>
<body>
    <a href="index.php">Index</a>
    <a href="Option.php">Opciones</a>
    <?php
    if (isset($_SESSION["username"])){
        echo "<fieldset>
        Hola {$_SESSION["username"]}. ¿Como estas?
        </fieldset>";
    }

    ?>
    <form action="Logout.php" method="post">
        <fieldset>
            <legend>
                Sesion
            </legend>
            <label for="logout-btn">Salir de la sesion y eliminar datos de esta: </label>
            <button type="submit" id="logout-btn" name="logout">Salir</button>
        </fieldset>
    </form>
</body>
</html>
<?php

if (isset($_POST["logout"])) {
    session_destroy();
    session_unset();
}

?>