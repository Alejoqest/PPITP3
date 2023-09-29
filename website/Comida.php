<?php 
    class Comida {
        private String $nombre;
        private String $descripcion;
        private float $precio;
        private array $nutriente = array("Nutriente"=>"float");

        function __construct(private String $n, private String $d, private float $p, private Nutriente $Nu)
        {
            $this->nombre = $n;
            $this->descripcion = $d;
            $this->precio = $p;
            $this->nutriente = [];
        }

        function calcularCalorias() {
            $Calorias= null;
            $iteraciones= null;
            foreach($this->nutriente as $nunombre => $nucalorias) {
                $Calorias= $Calorias + $nucalorias;
                $iteraciones++;
            }
            return $Calorias/$iteraciones;
        }
    }

    class Nutriente{
        private String $nombre;
        private float $caloriasPorGramo;
        private $tipo = ['min','vit','ch','prot','grasa'];


        function __construct(String $nombre, float $caloriasPorGramo)
        {
            $this->nombre = $nombre;
            $this->caloriasPorGramo = $caloriasPorGramo;
        }

        function set_nombre ($nombre) {
            $this->nombre = $nombre;
        }

        function get_nombre ()
        {
            return $this->nombre;
        }

        function set_caloriasPorGramo($caloriasPorGramo) {
            $this->caloriasPorGramo = $caloriasPorGramo;
        }

        function get_caloriasPorGramo() {
            return $this->caloriasPorGramo;
        }

        function set_tipo($tipo) {
            $this->tipo = $tipo;
        }

        function get_tipo() {
            return $this->tipo;
        }
    }
    
?>