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
    if (isset($_SESSION["username"])){
        echo "<fieldset>
        Hola {$_SESSION["username"]}. ¿Como estas?
        </fieldset>";
    }

    ?>
    <form action="Option.php" method="post">
        <fieldset>
            <legend>Opciones de los puntos</legend>
            <label for="num_get">Cantidad de numeros en el punto 1:</label>
            <input type="number" name="numget" id="num_get" min="3" max="50">
            <legend>
                Opciones de sesion
            </legend>
            <label for="showassig">Ocultar el texto en los puntos:</label>
            <input type="checkbox" name="ocultar-text" id="showassig" value="true"> <br>
            <button type="submit" name="actualizar">Actualizar</button>
        </fieldset>
    </form>
</body>
</html>
<?php

if (isset($_POST["actualizar"])) {
    echo "<fieldset> <legend>Cambios realizados</legend>";
    if (isset($_POST["numget"]) && $_POST["numget"]>3) {
        setcookie("numget","{$_POST['numget']}", time() + (86400 * 7), "/");
        echo "La cantidad de numeros que se van a mostrar en el punto 1 son: ". $_POST['numget'].". <br>";
    } 
    if (isset($_POST["ocultar-text"])) {
        $_SESSION["ocultar-titulos"] = $_POST["ocultar-text"];
        echo "Ocultar el texto: ". $_SESSION["ocultar-titulos"];
    } else {
        $_SESSION["ocultar-titulos"] = "";
        echo $_SESSION["ocultar-titulos"];
    }
}
?>