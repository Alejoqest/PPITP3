<?php

class Triangulo implements Figura{

    protected array $lados;
    public function __construct(float $ladobase, float $lado2, float $lado3) {
        $this->lados[0]= $ladobase;
        $this->lados[1]= $lado2;
        $this->lados[2]= $lado3;     
    }

    function Semiperimetro(): float{
        $Semiperimetro = null; 
        foreach ($this->lados as $lado) {
            $Semiperimetro += $lado;
        }
        $Semiperimetro = $Semiperimetro / 2;
        return $Semiperimetro;
    }
    function Perimetro(): float {
        $Perimetro = null;
        foreach($this->lados as $lado){
            $Perimetro += $lado;
        }
        return $Perimetro;
    }
    function Area(): float {
        $Area = null;
        $altura = null;
        if ($this->lados[0] == $this->lados[1] && $this->lados[1] == $this->lados[2]) {
            $altura = sqrt((($this->lados[0]/2)**2)-($this->lados[1]**2));
        } else if ($this->lados[0] != $this->lados[1] && $this->lados[1] == $this->lados[2]) {
            $altura = sqrt(($this->lados[0]**2)-(($this->lados[1]**2)/4));
        } else if ($this->lados[0] != $this->lados[1] && $this->lados[1] != $this->lados[2]) {
            $Semiperimetro = ($this->lados[0]+$this->lados[1]+$this->lados[2])/2;
            $altura = (2/$this->lados[0])*sqrt($Semiperimetro*($Semiperimetro-$this->lados[0])*($Semiperimetro-$this->lados[1])*($Semiperimetro-$this->lados[2]));
        }
        $Area = ($this->lados[0]*$altura)/2;
        return $Area;
    }
}
?>