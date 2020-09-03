<?php

namespace es\fdi\ucm\aw;
class Talla{

    private static $valores = array(0 => '--', 1 => 'XS', 2 =>  'S', 3 =>  'M', 4  =>'L',  5 =>'XL');

    private $talla;

    public function getValor($num){
        return self::$valores[$num];
    }

    public function getString(){
        return self::$valores[$this->talla];
    }

    public function numValores(){
        return sizeof(self::$valores);
    }

    public function getTalla(){
        return $this->talla;
    }
    
    public function getStringtalla(){
        return $this->talla;
    }

    public function setTalla($valor){
        $this->talla = $valor;
    } 

    public function __construct( $talla = NULL) {
        if (!is_null($talla)){
            $this->talla = $talla;
        }else{
            $this->talla = 0;
        }
    }
}

?>