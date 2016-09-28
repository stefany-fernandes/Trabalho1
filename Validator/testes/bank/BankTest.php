<?php
/**
 * Created by PhpStorm.
 * User: Stefany Fernandes
 * Date: 24/09/2016
 * Time: 19:36
 */

namespace Validator\testes\bank;

use Validator\Bank\Bank;

//
class BankTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $agencia
     * @param string $conta
     * @dataProvider providerTestToIntegerAndToFormatted
     *
     */
    public function testConstructorValidAgencia(string $agencia, string $conta){
        $bankObj1 = new Bank($agencia,$conta);
        $this->assertEquals($bankObj1->toFormatted(), "$agencia $conta");
    }


    public function testExcecao () {
        $this->assertEquals( $bankOnj = new Bank('635', '20173'), "A agência deve ter quatro números e a conta deve conter 8 (com o dígito).");
    }



    /**
     * @param string $agencia
     * @param string $conta
     *
     * @dataProvider providerTestErro
     *
     */

    public function testConstructorInvalidAgencia(string $agencia, string $conta) {
        $bankObj2 = new Bank ($agencia, $conta);
        $this->assertEquals($bankObj2->validateAg(), 0);
    }

    /**
     * @param string $agencia
     * @param string $conta
     *
     * @dataProvider providerTest
     */

    public function testConstructorValidateAcc(string $agencia, string $conta) {
        $bankObj3 = new Bank($agencia, $conta);
        $this->assertEquals($bankObj3->validateC(), true);
    }

    /**
     * @param string $agencia
     * @param string $conta
     *
     * @dataProvider providerTestErro
     */

    public function testContaInvalida (string $agencia, string $conta){
        $bankObj4 = new Bank($agencia, $conta);
        $this->assertEquals($bankObj4->validateC(), false);

    }


    /**
     * @param string $agencia
     * @param string $conta
     *
     * @dataProvider providerTestErro
     */

    public function testAgenciaInvalida(string $agencia, string $conta){
        $bankObj5 = new Bank ($agencia, $conta);
        $this->assertEquals($bankObj5->validateAg(), false);
    }

    /**
     * @param string $agencia
     * @param string $conta
     *
     * @dataProvider providerTest
     */

    public function testFinalContaAgValidas(string $agencia, string $conta) {
        $bankObj6 = new Bank ($agencia, $conta);
        $this->assertEquals($bankObj6->validate(), true);
    }


    /**
     * @param string $agencia
     * @param string $conta
     *
     * @dataProvider providerTestErro
     */

    public function testFinalContaAgInvalidas (string $agencia, string $conta) {
        $bankObj9 = new Bank ($agencia, $conta);
        $this->assertEquals($bankObj9->validate(), false);
    }



    /**
     * @param string $agencia
     * @param string $conta
     *
     * @dataProvider providerTestToIntegerAndToFormatted
     */
    public function testToInteger(string $agencia, string $conta){
        $bankObj8 = new Bank($agencia, $conta);
        $this->assertEquals($bankObj8->toInteger(), 63500201731);

    }

    /**
     * @return array
     */


    /**
     *
     * As contas fornecidas por esse método são inválidas, portanto o validador DEVE retornar 0
     *
     * @return array
     */

    public function providerTestErro() {
        return [
            ['0633', '9920000-1'],
            ['0635', '98000173-0'],
            ['3345', '12349952-3'],
            ['1333', '8982233-0'],
        ];
    }

    /**
     * Todas as contas aqui fornecidas são válidas, portanto o validador deve retornar 1
     *
     * @return array
     *
     */

    public function providerTestToIntegerAndToFormatted() {
        return [
            ['0635', '0020173-1']
        ];
    }

    public function providerTest() {
        return [
          ['0635', '0020173-1'],
          ['3345', '0344657-3'],
          ['0000', '0000000-0'] // apenas para testar se isso é considerado uma conta válida. Nenhuma outra utilidade.

        ];
    }


}
