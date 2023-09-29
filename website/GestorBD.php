<?php
    class GestorBD {
        private $conn;
        function __construct(String $db_server, String $db_username, String $db_password, String $db_name){
            try {
                $this->conn = mysqli_connect($db_server, $db_username,$db_password,$db_name);
            }
            catch (mysqli_sql_exception)
            {
                die("<br>Algunos de los elementos no son correctos: " . mysqli_connect_error());
            }
            
            echo "Connectado correctamente."; 
        }
        function __destruct() {
            mysqli_close($this->conn);
        }
        function Escribir(String $tabla, Array $valores) {
            switch (count($valores)) {
                case 1:
                    $sql =  "INSERT INTO {$tabla}
                    VALUES ({$valores[0]});";
                    break;
                case 2:
                    $sql =  "INSERT INTO {$tabla}
                    VALUES ({$valores[0]}, {$valores[1]});";
                    break;
                case 3:
                    $sql =  "INSERT INTO {$tabla}
                    VALUES ({$valores[0]}, {$valores[1]}, {$valores[2]});";
                    break;
                case 4:
                    $sql =  "INSERT INTO {$tabla}
                    VALUES ({$valores[0]}, {$valores[1]}, {$valores[2]}, {$valores[3]});";
                    break;
                case 5:
                    $sql =  "INSERT INTO {$tabla}
                    VALUES ({$valores[0]}, {$valores[1]}, {$valores[2]}, {$valores[3]}, {$valores[4]});";
                    break;
                case 6:
                    $sql =  "INSERT INTO {$tabla}
                    VALUES ({$valores[0]}, {$valores[1]}, {$valores[2]}, {$valores[3]}, {$valores[4]}, {$valores[5]});";
                    break;
                case 7:
                    $sql =  "INSERT INTO {$tabla}
                    VALUES ({$valores[0]}, {$valores[1]}, {$valores[2]}, {$valores[3]}, {$valores[4]}, {$valores[5]}, {$valores[6]});";
                    break;
            }
            try{
                mysqli_query($this->conn, $sql);
                echo ("<br> Los datos fueron ingresados correctamente a la tabla {$tabla}.");
            }
            catch (mysqli_sql_exception) {
                die("<br> Algun dato no es correcto: " . mysqli_error($this->conn));
            }
        }
        function Leer(String $tabla, Array $criterio) {
            if (empty($criterio)) {
                $sql = "SELECT * FROM {$tabla}";
                $result = mysqli_query($this->conn, $sql);
            }else {
                switch (count($criterio)) {
                    case 1:
                        $sql = "SELECT * FROM {$tabla} WHERE ({$criterio[0]})";
                        break;
                    case 2:
                        $sql = "SELECT * FROM {$tabla} WHERE ({$criterio[0]}  {$criterio[1]})";
                    case 3:
                        $sql = "SELECT * FROM {$tabla} WHERE ({$criterio[0]}  {$criterio[1]}  {$criterio[2]})";
                        break;
                    case 4:
                        $sql = "SELECT * FROM {$tabla} WHERE ({$criterio[0]}  {$criterio[1]}  {$criterio[2]}  {$criterio[3]})";
                        break;
                    case 5:
                        $sql = "SELECT * FROM {$tabla} WHERE ({$criterio[0]}  {$criterio[1]}  {$criterio[2]}  {$criterio[3]}  {$criterio[4]})";
                        break;
                    case 5:
                        $sql = "SELECT * FROM {$tabla} WHERE ({$criterio[0]}  {$criterio[1]}  {$criterio[2]}  {$criterio[3]}  {$criterio[4]} {$criterio[5]})";
                        break;
                }
            }
            try {
                $result = mysqli_query($this->conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        foreach($row as $key=>$valor) {
                            echo "<br> {$key} = ". $valor. " |";
                        }
                    }
                } else {
                    echo "<br> 0 resultados.";
                }
            }
            catch (mysqli_sql_exception) {
                die("<br> Algun dato no es correcto: " . mysqli_error($this->conn).".");
            }
        }
        //Funcion de borrar
        function Borrar(String $tabla, Array $criterio) {
            if (empty($criterio)) {
                $sql = "DELETE FROM {$tabla}";
            } else {
                switch (count($criterio)) {
                    case 1:
                        $sql = "DELETE FROM {$tabla} WHERE ({$criterio[0]});";
                        break;
                    case 2:
                        $sql = "DELETE FROM {$tabla} WHERE ({$criterio[0]}  {$criterio[1]});";
                        break;
                    case 3:
                        $sql = "DELETE FROM {$tabla} WHERE ({$criterio[0]}  {$criterio[1]}  {$criterio[2]});";
                        break;
                    case 4:
                        $sql = "DELETE FROM {$tabla} WHERE ({$criterio[0]}  {$criterio[1]}  {$criterio[2]}  {$criterio[3]});";
                        break;
                    case 5:
                        $sql = "DELETE FROM {$tabla} WHERE ({$criterio[0]}  {$criterio[1]}  {$criterio[2]}  {$criterio[3]}  {$criterio[4]});";
                        break;
                    case 6:
                        $sql = "DELETE FROM {$tabla} WHERE ({$criterio[0]}  {$criterio[1]}  {$criterio[2]}  {$criterio[3]}  {$criterio[4]}  {$criterio[5]});";
                        break;
                }
            }
            try{ 
                mysqli_query($this->conn,$sql);
                echo "<br> Se eliminaron los datos correctamente de la tabla {$tabla}.";
            }
            catch (mysqli_sql_exception) {
                die ("<br> No se pudo hacer porque: ".mysqli_error($this->conn).".");
            }
           
        }
        function Editar(String $tabla, Array $valores, Array $criterio) {
            if (empty($valores)) {
                die ("No hay valores.");
            } else {
                switch (count($valores)) {
                    case 1:
                        $sql= "UPDATE {$tabla}
                        SET {$valores[0]}";
                        break;
                    case 2:
                        $sql= "UPDATE {$tabla}
                        SET {$valores[0]}, {$valores[1]}";
                        break;
                    case 3:
                        $sql= "UPDATE {$tabla}
                        SET {$valores[0]}, {$valores[1]},{$valores[2]}";
                        break;
                    case 4:
                        $sql= "UPDATE {$tabla}
                        SET {$valores[0]}, {$valores[1]}, {$valores[2]}, {$valores[3]}";
                        break;
                    case 5:
                        $sql= "UPDATE {$tabla}
                        SET {$valores[0]}, {$valores[1]}, {$valores[2]}, {$valores[3]}, {$valores[4]}";
                        break;
                    case 6:
                        $sql= "UPDATE {$tabla}
                        SET {$valores[0]}, {$valores[1]}, {$valores[2]}, {$valores[3]}, {$valores[4]}, {$valores[5]}";
                        break;
                    case 7:
                        $sql= "UPDATE {$tabla}
                        SET {$valores[0]}, {$valores[1]}, {$valores[2]}, {$valores[3]}, {$valores[4]}, {$valores[5]}, {$valores[6]}";
                        break;
                    }
            }
            switch (count($criterio)) {
                case 1:
                    $sql = $sql . " WHERE ({$criterio[0]});";
                    break;
                case 2:
                    $sql = $sql . " WHERE ({$criterio[0]} {$criterio[1]});";
                    break;
                case 3:
                    $sql = $sql . " WHERE ({$criterio[0]} {$criterio[1]} {$criterio[2]});";
                    break;
                case 4:
                    $sql = $sql . " WHERE ({$criterio[0]} {$criterio[1]} {$criterio[2]} {$criterio[3]});";
                    break;
                case 5:
                    $sql = $sql . " WHERE ({$criterio[0]} {$criterio[1]} {$criterio[2]} {$criterio[3]} {$criterio[4]});";
                    break;
                case 5:
                    $sql = $sql . " WHERE ({$criterio[0]} {$criterio[1]} {$criterio[2]} {$criterio[3]} {$criterio[4]} {$criterio[5]});";
                    break;
            }
            try {
                mysqli_query($this->conn,$sql);
                echo ("<br> Se realizaron los cambios en la tabla {$tabla}.");
            }
            catch (mysqli_sql_exception){
                die ("<br> No se pudo hacer debido: ". mysqli_error($this->conn).".");
            }
        }
    }
?>