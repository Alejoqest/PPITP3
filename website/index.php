<?php
    session_start();
    setcookie("Act_4_cookie1", "Cookie", time() + (86400 * 7), "/");
    setcookie("Act_4_cookie_session", true, time() + (86400 * 7), "/");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <a href="Option.php">Opciones</a>
    <a href="Logout.php">Salir</a>
    <?php
    if (isset($_SESSION["username"])){
        echo "<fieldset>
        Hola {$_SESSION["username"]}. ¿Como estas?
        </fieldset>";
    }

    ?>
    <form action="index.php" method="get">
        <fieldset>    
            <legend>Punto 1</legend>
            <?php
            if (empty($_SESSION["ocultar-titulos"])) {
                echo"<p>
                    Elija 1 inciso para programarlo en 1 archivo PHP que reciba parámetros por método GET y devuelva el resultado en texto plano, JSON o XML
                    <br>
                    a. Recibir arreglo de números y devolver 3 variables: media, mediana, moda.
                </p>";
            }
            ?>
            <label for="num1">Numero 1:</label>
            <input type="number" name="numbers[]" id="num1" required> <br>
            <label for="num2">Numero 2:</label>
            <input type="number" name="numbers[]" id="num2" required> <br>
            <label for="num3">Numero 3:</label>
            <input type="number" name="numbers[]" id="num3" required> <br>
            <?php
            if(isset($_COOKIE["numget"])) {
                for($i=4; $i <= $_COOKIE["numget"]; $i++) {
                    echo "<label for='num{$i}'>Numero {$i}:</label>
                    <input type='number' name='numbers[]' id='num{$i}'> <br>";
                }
            }
            ?>
            <button type="submit" name="calcular">Calcular</button>
            <?php 
                if (isset($_GET["calcular"])) {
                echo "<hr>";
                $numbers= $_GET["numbers"]; 
                for ($i = 0; $i < count($numbers); $i++) {
                    $numbers[$i] = intval($numbers[$i]);
                }
                var_dump($numbers);
                echo ("<br>Valores = <br>");
                foreach ($numbers as $number) {
                echo ("{$number}. <br>");
                }
                
                $media = 0;
                for ($i = 0; $i < count($numbers); $i++) {
                    $media = $media + $numbers["$i"];
                    if ($i == count($numbers)-1) {
                        $media = $media / $i;
                    }
                }
                echo("Media = {$media}. <br>");
                
                if (count($numbers)%2==0){
                    $mediana = array_sum(array_slice($numbers, (count($numbers)/2)-1, 2))/2;
                } else {
                    $mediana = array_slice($numbers, count($numbers)/2, 1)[0];
                }
                echo ("Mediana = {$mediana}. <br>");

                $moda = array_count_values($numbers);
                arsort($moda);
                $moda = key($moda);
 
                echo("Moda = {$moda}. <br>");
                $cantidad = count($numbers);
                $text = "Cantidad de numeros ingresados: {$cantidad}.\nMedia = {$media}.\nMediana = {$mediana}.\nModa= {$moda}.";
                $file = fopen("Delevolucion.txt","w") or die("No se puede escribir un texto");
                fwrite($file,$text); 
            }
            ?>
        </fieldset>
    </form>
    <fieldset>
        <legend>Punto 2</legend>
        <?php
        if (empty($_SESSION["ocultar-titulos"])) {
            echo"<p>
                Elija 1 diagrama de clases y prográmelo en tantos archivos PHP como clases haya. Si quiere probar el funcionamiento, hágalo en un archivo index.php que importe la(s) clase(s)
            </p>";
        }
        ?>
        <?php
        include 'Figura.php';
        echo "Se va crear un objeto de la clase circulo y otro de la clase triangulo. Ambos se van usar sus funciones. <br>";
        include 'Circulo.php';
        echo "Se creo un objeto de la clase circulo. <br>";
        $b = new Circulo(6);
        echo "El perimetro del circulo es: {$b->Perimetro()}. <br>Y la area del circulo es: {$b->Area()}. <br>";
        include 'Triangulo.php';
        echo "Se creo un objeto de la clase triangulo. <br>";
        $c = new Triangulo(5,6,7);
        echo "El semiperimetro del triangulo es: {$c->Semiperimetro()}. <br>El perimetro del triangulo es: {$c->Perimetro()}.".
        "<br>Y la area del triangulo es: {$c->Area()}.";
        ?>
    </fieldset>
    <fieldset>
        <legend>Punto 3</legend>
        <?php
        if (empty($_SESSION["ocultar-titulos"])) {
            echo"<p>
                Elija 1 de las siguientes clases programadas en otros lenguajes de programación y traduzca a PHP , incluyendo la documentación. De haber salida por consola, puede adaptarla a formato HTML, texto plano o lo que encuentre oportuno.
            </p>";
        }
        ?>
        <?php
        echo "Se va crear un objeto de la clase saludador y se va usar sus funciones. <br>";
        include 'Python.php';
        $s = new Saludador();
        $s->saludar("");
        $s->saludar("Fulano");
        ?>
    </fieldset>
    <form action="index.php" method="post">
        <fieldset>
            <legend>Punto 4</legend>
            <?php
            if (empty($_SESSION["ocultar-titulos"])) {
                echo"<p>
                    Programe 1 ejemplo minúsculo de máximo 3 páginas PHP que use \$_COOKIE y \$_SESSION. Se espera apertura y cierre de sesión.
                </p>";
            }
            ?>
            <label for="user_name">Nombre de usuario:</label><input type="text" name="inputusername" id="user_name"> <br>
            <button type="submit" name="login" href="index.php">Acceder</button>
            <?php
                if(isset($_POST["login"])){
                    if (isset($_POST["inputusername"])) {
                        $_SESSION["username"] = $_POST["inputusername"];
                    }
                }
            ?>
        </fieldset>
    </form>
    <?php

    include 'GestorBD.php';
    $db=  new GestorBD("localhost","root","","pp1tp");
    ?>
    </body>
</html>