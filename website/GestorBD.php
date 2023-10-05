<?php
    class GestorBD {
        private $conn;
        function __construct(String $db_server, String $db_username, String $db_password, String $db_name){
            try {
                $this->conn = mysqli_connect($db_server, $db_username,$db_password,$db_name);
                echo "<fieldset> <legend> Punto 6</legend> Se ha connectado correctamente a la base de datos ".$db_name.".</fieldset> <br>"; 
            }
            catch (mysqli_sql_exception)
            {
                echo("<fieldset> <legend> Punto 6</legend> Se ha encontrado el siguiente error: #" . mysqli_connect_errno()." ");
                switch (mysqli_connect_errno()) {
                    case 1045:
                        die ("acceso denegado para el usuario '". $db_username ."'@'".$db_server."'(La contraseña ingresada
                        fue '". $db_password ."' ).</fieldset> ");
                        break;
                    case 1049:
                        die ("la base de datos '". $db_name . "' no existe o no fue encontrada. <br> </fieldset> ");
                    break;
                    case 2002:
                        die("El host '". $db_server."' es desconocido. <br> Error especifico: ". mysqli_connect_error().". </fieldset> ");
                    default:
                        die ("No se puedo conectar a la base de datos. <br> Error especifico: ". mysqli_connect_error(). ".</fieldset>  <br>");
                }
            }
            
        }
        function __destruct() {
            mysqli_close($this->conn);
        }
        //Funcion de Escribir INSERT
        function Escribir(String $tabla, Array $valores) {
            if (empty($valores)) {
                die("INSERT = No hay valores que se pueden ingresar.<br>");
            } else {
                $sql = "INSERT INTO {$tabla}
                VALUES (";
                for ($i = 0; $i < count($valores); $i++) {
                    if (is_string($valores[$i]))
                            $sql .= "'{$valores[$i]}'";
                        else 
                        $sql = $sql . "{$valores[$i]}";
                    if ($i < count($valores)-1) $sql.= ", ";
                    if ($i == count($valores)-1) $sql .= ");";
                }
            }
            try{
                mysqli_query($this->conn,$sql);
                echo ("<fieldset> <legend>Punto 7</legend>INSERT = Los datos fueron ingresados correctamente a la tabla {$tabla}.</fieldset><br>");
            }
            catch (mysqli_sql_exception) {
                die ($this->error_gestor(mysqli_errno($this->conn), mysqli_error($this->conn), "INSERT", $tabla, $sql));
            }
        }
        //Funcion de Leer SELECT
        function Leer(String $tabla, Array $criterio): array {
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
                if (mysqli_num_rows($result) > 0)
                    echo "<fieldset> <legend>Punto 8</legend> SELECT = Se obtuvo los datos correctamente para que sean leidos. </fieldset> <br>";
                else
                    echo "<fieldset> <legend>Punto 8</legend> SELECT = Segun los parametros, no hay ningun resultado.</fieldset> <br>";
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return $rows;
                /*codigo para print
                $select = $db->Leer($table, array());
                foreach ($select as $row => $array) {
                    echo "<hr > Fila Nº". $row + 1 ."<br>";
                    foreach ($array as $key => $value) {
                        echo ("{$key} = $value <br>");
                    }
                }
                */
            }
            catch (mysqli_sql_exception) {
                die ($this->error_gestor(mysqli_errno($this->conn), mysqli_error($this->conn), "SELECT", $tabla, $sql));
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
                echo "<fieldset> <legend>Punto 9</legend>DELETE = Se eliminaron los datos correctamente de la tabla {$tabla}.</fieldset><br>";
            }
            catch (mysqli_sql_exception) {
                die ($this->error_gestor(mysqli_errno($this->conn), mysqli_error($this->conn), "DELETE", $tabla, $sql));
            }
        }
        function Editar(String $tabla, Array $valores, Array $criterio) {
            if (empty($valores)) {
                die ("<fieldset> <legend>Punto 10</legend> UPDATE = No hay valores para poder realizar la edicion.</fieldset> <br>");
            } else {
                $sql = "UPDATE {$tabla}
                SET ";
                $iterador= 0;
                foreach ($valores as $key=>$valor) {
                    $iterador++; 
                    $sql .= "{$key} = ";
                    if (is_string($valor)) 
                        $sql .= "'{$valor}'";
                    else 
                    $sql = $sql . "{$valor}";
                    if ($iterador < count($valores)) {
                        $sql .= ", ";
                    }else if ($iterador == count($valores)) {
                        $sql .= " ";
                    }
                    
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
                echo ("<fieldset> <legend>Punto 10</legend> UPDATE = Se realizaron los cambios en la tabla {$tabla}.</fieldset><br> ");
            }
            catch (mysqli_sql_exception){
                die ($this->error_gestor(mysqli_errno($this->conn), mysqli_error($this->conn), "UPDATE", $tabla , $sql));
            }          
        }
        function error_gestor(int $error_num, String $error_message, String $type, String $tabla, String $sql):String {
            $error_sql = "<fieldset> <legend>Operacion SQL</legend> <h1>ERROR</h1> <hr> consulta SQL: <br>". $sql."<hr> MySQL ha dicho: <br>"
            .$type . " = Algun dato no es correcto: #". $error_num ;
            switch ($error_num) {
                case 1048:
                    $error_sql .= " - algunos de los valores introducidos no debe ser NULL. <br>";
                    break;
                case 1062:
                    $error_sql .= " - entrada duplicada de una llave. <br>";
                    break; 
                case 1064:
                    $error_sql .= " - error de sintax de SQL. Revise el manual que corresponda al servidor de MariaDB actual. <br>";
                    break;
                case 1146:
                    $error_sql .= " - la tabla '". $tabla. "' no existe. <br>";
                    break;
                case 4025:
                    $error_sql .= " - se ignoro las diferentes constraints/restricciones. <br>";
                    break;
                }
            $error_sql .= "El error especifico: " . $error_message . ".</fieldset> <br>";
            return $error_sql;
        }
    }
?>