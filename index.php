<?php


declare(strict_types=1);

use Validator\Bank\Bank;

$value = '20173-1';
//try {
/**
 * Tentará criar o objeto com a conta e agência dada e executar o pedido.
 * Caso falhe, irá exibir a mensagem da exceção.
 */
try {
    $a = new Bank('635-1', '20173-1');

        //echo $a->validate();
    //}
    //catch (Exception $e) {
    //    echo $e->getMessage();
    //}
        if($a->validate()){
          echo 'Conta e Agência válidas.';
   }
    else {
        echo 'Conta e Agência inválidas.';
    }
}
catch (Exception $e) {
        echo $e->getMessage();
}

$bankObj = new Bank ('0000', '0000000-0');
$bankObj->validateC();



echo $a->toFormatted(). "\n";
echo $a->toInteger();

/**
 * Carrega todas as classes necessárias apenas uma vez
 *
 * @param $class
 */
function  __autoload($class){
    $class= str_replace('\\','/', $class).'.php';
    require_once($class);
}
