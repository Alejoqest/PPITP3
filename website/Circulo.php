<?php

include 'Figura.php';

class Circulo implements Figura {
    public const PI = 3.14159265;

    public function __construct(protected float $radio) {}

    function Perimetro(): float {
        $diametro  = $this->radio * 2;
        $perimetro = self::PI * $diametro;
        return $perimetro;
    }
    function Area(): float {
        $area = self::PI * ($this->radio ** 2);
        return $area;
    }
}
?>