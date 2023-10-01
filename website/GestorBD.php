<?php

use function PHPSTORM_META\sql_injection_subst;

    class GestorBD {
        private $conn;
        function __construct(String $db_server, String $db_username, String $db_password, String $db_name){
            try {
                $this->conn = mysqli_connect($db_server, $db_username,$db_password,$db_name);
            }
            catch (mysqli_sql_exception)
            {
                die("Algunos de los elementos no son correctos: " . mysqli_connect_error().".<br>");
            }
            
            echo "Connectado correctamente. <br>"; 
        }
        function __destruct() {
            mysqli_close($this->conn);
        }
        //Funcion de Escribir INSERT
        function Escribir(String $tabla, Array $valores) {
            if (empty($valores)) {
                die("No hay valores que se pueden ingresar.<br>");
            } else {
                $sql = "INSERT INTO {$tabla}
                VALUES (";
                for ($i = 0; $i < count($valores); $i++) {
                    if ($i < count($valores)-1)
                        $sql = $sql . "{$valores[$i]}, ";
                    if ($i == count($valores)-1)
                        $sql = $sql . "{$valores[$i]});";
                }
            }
            try{
                mysqli_query($this->conn, $sql);
                echo ("Los datos fueron ingresados correctamente a la tabla {$tabla}.<br>");
            }
            catch (mysqli_sql_exception) {
                die("Algun dato no es correcto: #" . mysqli_errno($this->conn). " - " .mysqli_error($this->conn).".<br>");
            }
            
        }
        //Funcion de Leer SELECT
        function Leer(String $tabla, Array $criterio) {
            if (empty($criterio)) {
                $sql = "SELECT * FROM {$tabla}";
            } else {
                $sql = "SELECT * FROM {$tabla} WHERE (";
                for ($i = 0; $i < count($criterio); $i++) {
                    if ($i < count($criterio)-1)
                        $sql = $sql . "{$criterio[$i]} ";
                    if ($i == count($criterio)-1)
                        $sql = $sql . "{$criterio[$i]});";
                }
            }
            try {
                $result = mysqli_query($this->conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        foreach($row as $key=>$valor) {
                            echo " {$key} = ". $valor. " |<br>";
                        }
                    }
                } else {
                    echo "Segun los parametros, no hay ningun resultado.<br>";
                }
            }
            catch (mysqli_sql_exception) {
                die("<br> Se encontro el siguiente error: #" . mysqli_errno($this->conn). " - " .mysqli_error($this->conn).".");
            }
            
        }
        //Funcion de borrar DELETE
        function Borrar(String $tabla, Array $criterio) {
            if (empty($criterio)){
                $sql = "DELETE FROM {$tabla}";
            } else {
                $sql = "DELETE FROM {$tabla} WHERE (";
                for ($i = 0; $i < count($criterio); $i++) {
                    if ($i < count($criterio)-1)
                        $sql = $sql . "{$criterio[$i]} ";
                    if ($i == count($criterio)-1)
                        $sql = $sql . "{$criterio[$i]});";
                }
            }
            try{ 
                mysqli_query($this->conn,$sql);
                echo "Se eliminaron los datos correctamente de la tabla {$tabla}.<br>";
            }
            catch (mysqli_sql_exception) {
                die ("No se pudo hacer por el siguiente error: #" . mysqli_errno($this->conn). " - " .mysqli_error($this->conn).".<br>");
            }
           
        }
        function Editar(String $tabla, Array $valores, Array $criterio) {
            if (empty($valores)) {
                die ("No hay valores para poder realizar la edicion. <br>");
            } else {
                $sql = "UPDATE {$tabla}
                SET ";
                for ($i = 0; $i < count($valores); $i++) {
                    if ($i < count($valores)-1)
                        $sql = $sql . "{$valores[$i]}, ";
                    if ($i == count($valores)-1)
                        $sql = $sql . "{$valores[$i]}";
                }
                if (empty($criterio)) {
                    $sql = $sql . ";";
                } else {
                    $sql = $sql . " WHERE (";
                    for ($u = 0; $u < count($criterio); $u++) {
                        if ($u < count($criterio)-1)
                            $sql = $sql . "{$criterio[$u]} ";
                        if ($u == count($criterio)-1) {
                            $sql = $sql . "{$criterio[$u]});";
                        }
                    }
                }
            }
            try {
                mysqli_query($this->conn,$sql);
                echo ("Se realizaron los cambios en la tabla {$tabla}.<br>");
            }
            catch (mysqli_sql_exception){
                die ("No se pudo hacer debido al siguiente error: #" . mysqli_errno($this->conn). " - " .mysqli_error($this->conn).".<br>");
            }
            
        }
    }
?>