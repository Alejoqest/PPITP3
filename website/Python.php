<?php
    class Saludador{
        function saludar($nombre) {
            if (empty($nombre)) {
                echo "Hola, mundo. <br>";
            } else {
                echo "Hola, {$nombre}. <br>";
            }
        }
        function __construct()
        {
        }
    }
?>