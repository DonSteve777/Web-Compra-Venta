<?php
class Talla extends SplEnum {
    const __default = self::xs;
    const xs = 1;
    const s = 2;
    const M = 3;
    const L = 4;
    const XL = 5;
    const XXL = 6;
    const notSizeable = 7;
}

/*echo new Talla(Talla::xs) . PHP_EOL;

try {
    new Talla(13);
} catch (UnexpectedValueException $uve) {
    echo $uve->getMessage() . PHP_EOL;
}*/
?>