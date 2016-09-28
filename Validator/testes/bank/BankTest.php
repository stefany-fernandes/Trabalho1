<?php


namespace Validator\testes\bank;

use Validator\Bank\Bank;

//
class BankTest extends \PHPUnit_Framework_TestCase
{


    public function testExcecao() {
        $bankOnj = new Bank('635', '20173');
    }


    /**
     * @param string $agencia
     * @param string $conta
     *
     */
    public function testConstructorValidAgencia(){
        $bankObj1 = new Bank('06351', '0020173-1');
        $this->assertEquals($bankObj1->toFormatted(), '0635-1 0020173-1');
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
        $this->assertEquals($bankObj8->toInteger(), 635100201731);

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
            ['06332', '9920000-1'],
            ['06353', '98000173-0'],
            ['33450', '12349952-3'],
            ['13330', '8982233-0'],
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
            ['06351', '0020173-1']
        ];
    }

    public function providerTest() {
        return [
          ['06351', '0020173-1'],
          ['04863', '0061651-6'],
          ['00000', '0000000-P'] // apenas para testar se isso é considerado uma conta válida. Nenhuma outra utilidade.

        ];
    }


}
