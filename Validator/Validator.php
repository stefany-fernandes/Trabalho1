<?php


declare(strict_types=1);

namespace Validator;


/**
 *
 * Classe mãe: possui metodos abstratos que serão desenvolvidos nas classes validadoras que extenderem ela.
 * Class Validator
 * @package Validator
 */

abstract Class Validator {

    /**
     * Valor que ficará salvo a agência e a conta(apenas numerais)
     * @var float
     */
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
     * Esse método será implementado por todas as classes filhas.
     * @return bool
     */
    public abstract function validate():bool;

    /**
     * Esse método será implementado por todas as classes filhas.
     * @return string
     */
    public abstract function toFormatted():string;
}


