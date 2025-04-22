<?php
namespace Projetux\Math;

class Basic
{
    /**
     * @return int|float
     */
    public function soma(int|float $numero, int|float $numero2)
    {
        return $numero + $numero2;
    }

    /**
     * @return int|float
     */
    public function subtrai(int|float $numero, int|float $numero2)
    {
        return $numero - $numero2;
    }

   /**
     * @return int|float
     */
    public function divide(int|float $numero, int|float $numero2)
    {
        return $numero / $numero2;
    }

    /**
     * @return int|float
     */
    public function raiz(int|float $numero, int|float $numero2)
    {
        return sqrt($numero);
    }

    /**
     * @return int|float
     */
    public function multiplicar(int|float $numero, int|float $numero2)
    {
        return $numero * $numero2;
    }

    /**
     * @return int|float
     */
    public function elevado_ao_quadrado(int|float $numero, int|float $numero2)
    {
        return sqrt($numero ** $numero2);
    }

}