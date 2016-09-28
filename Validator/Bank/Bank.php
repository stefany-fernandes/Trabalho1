<?php


declare(strict_types=1);


namespace Validator\Bank;

use Validator\Validator;

Class Bank extends Validator {
    private $agencia;
    private $numeroConta;

    /**
     * Bank constructor.
     * @param string $agencia
     * @param string $numeroConta
     * @throws \Exception
     */
    public function __construct(string $agencia, string $numeroConta) {

        $this->numeroConta=$numeroConta;
        $this->agencia=$agencia;
        $this->numeroConta=str_replace('P', '0', $this->numeroConta);
        $this->numeroConta= (string)str_replace('-', '', $this->numeroConta);
        $this->agencia=str_replace('P', '0', $this->agencia);
        $this->agencia= (string)str_replace('-', '', $this->agencia);
        if (strlen($agencia) != 5 or strlen ($numeroConta) < 8) {
            throw new \Exception("A agência deve ter cinco números(com o dígito) e a conta deve conter 8 (também com o dígito).");
        }
        $value = (float) ($this->agencia . $this->numeroConta);

        parent::__construct($value);
        
        $this->agencia = str_split($this->agencia);
        $this->numeroConta=str_split($this->numeroConta);

    }

    /**
     *
     * Converte o dado para string adicionando o ' - ' e separando a agencia e a conta.
     * @return string
     */

    public function toFormatted():string {
        $x = count($this->agencia);
        
        foreach ($this->agencia as $y) {

            if ($x == 1) {
                $format = $format . '-';
            }
            $format = $format . $y;
            $x--;
        }
        
        $format = $format . ' ';
        $x = count($this->numeroConta);
        
        foreach ($this->numeroConta as $y) {

            if ($x == 1) {
                $format = $format . '-';
            }
            $format = $format . $y;
            $x--;
        }
        

        return $format;
    }

    /**
     *
     * Verifica se a agência é valida, de acordo com o dígito verificador
     *
     * @return bool
     */
    public function validateAg():bool {
        $valores = array (5, 4, 3, 2);
        $soma = 0;
        $cont = 0;
        foreach ($valores as $y) {
            $soma = $soma + ($y * (int)$agencia[$cont]);
            $cont++;
        }
        $mod = 11 - ($soma % 11);
        if ($mod == 10 or $mod == 11) {
            if ($this->agencia[$cont] == 0) {
                return true;
            }
        }
        else {
            if ($mod == $this->agencia[$cont]) {
                return true;
            }
        }
        return false;
    }

    /**
     *
     * Verifica se a conta é válida de acordo com o dígito verificador
     *
     * @return bool
     */
    public function validateC():bool {

        $soma = 0;
        $contador = 0;

        $pesos = array(2, 7, 6, 5, 4, 3, 2);
        foreach ($pesos as $value) {
            $soma = $soma + ($value * $this->numeroConta[$contador]);
            $contador++;
        }
        $mod = $soma % 11;
        if ($mod == 0 || $mod == 1) {
            if ($this->numeroConta[$contador] == 0) {
                return true;
            }
        }
        else {
            $mod = 11 - $mod;
            if ($mod == $this->numeroConta[$contador]) {
                return true;
            }
        }
        return false;
    }

    /**
     *
     * Verifica se o conjunto conta-agência é valido, de acordo com o digito verificador
     *
     * @return bool
     */

    public function validate():bool {
        if ($this->validateAg() == 1 and $this->validateC() == 1) {
            return true;
        }
        return false;
    }

}
