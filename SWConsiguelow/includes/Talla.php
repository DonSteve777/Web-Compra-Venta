<?php

namespace es\fdi\ucm\aw;
class Talla{

    private static $valores = array(0 => '--', 1 => 'XS', 2 =>  'S', 3 =>  'M', 4  =>'L',  5 =>'XL');

    private $talla;

    public function getValor($num){
        return self::$valores[$num];
    }

    public function numValores(){
        return sizeof(self::$valores);
    }

    public function getTalla(){
        return $this->talla;
    } 

    public function setTalla($valor){
        $this->talla = self::$valores[$valor];
    } 

    public function __construct( $talla = NULL) {
        if (isset($talla))
        $this->talla = $talla;
        $this->talla = self::$valores[0];
    }
}

?>