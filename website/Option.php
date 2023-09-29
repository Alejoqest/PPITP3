<?php

session_start();

setcookie("numget","", time() + (86400 * 7), "/");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>options</title>
</head>
<body>
    <a href="index.php">Index</a>
    <a href="Logout.php">Salir</a>
    <?php
    if (!empty($_SESSION["username"])){
        echo "<fieldset>
        Hola {$_SESSION["username"]}
        </fieldset>";
    }

    ?>
    <form action="Option.php" method="post">
        <fieldset>
            <legend>Opciones del punto 1</legend>
            <label for="numget">Cantidad de numeros:</label>
            <input type="number" name="numget" id="num_get" min="3" max="50">
            <button type="submit" name="op1num">Actualizar</button>
        </fieldset>
    </form>
</body>
</html>
<?php
if (isset($_POST["op1num"])) {
    setcookie("numget","{$_POST['numget']}", time() + (86400 * 7), "/");
}

?>