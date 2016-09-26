<?php


declare(strict_types=1);

namespace Validator;

abstract Class Validator {
    protected $value;

    /**
     * Validator constructor.
     * @param int $value
     */
    protected function __construct(float $value){
       $this->value=$value;
    }

    /**
     * Esta função converte o dado para inteiro.
     * @return int
     */
    public  function  toInteger():float {

      return $this->value;

    }

    /**
     * @return bool
     */
    public abstract function validate():bool;

    /**
     * @return string
     */

    public abstract function toFormatted():string;
}


