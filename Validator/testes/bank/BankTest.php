<?php
/**
 * Created by PhpStorm.
 * User: Stefany Fernandes
 * Date: 24/09/2016
 * Time: 19:36
 */

namespace Validator\testes\bank;

use Validator\Bank\Bank;


class BankTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $agencia
     * @param string $conta
     * @dataProvider providerTest
     *
     */
    public function testConstructorValidAgencia(string $agencia, string $conta){
        $bankObj1 = new Bank($agencia,$conta);
        $this->assertEquals($bankObj1->toFormatted(), "$agencia $conta");
    }

    /**
     * @param string $agencia
     * @param string $conta
     *
     * @dataProvider providerTest
     *
     */

    public function testConstructorInvalidAgencia(string $agencia, string $conta) {
        $bankObj2 = new Bank ($agencia, $conta);
        $this->assertEquals($bankObj2->validateAg(), true);
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

    public function testeContaInvalida (string $agencia, string $conta){
        $bankObj4 = new Bank($agencia, $conta);
        $this->assertEquals($bankObj4->validateC(), false);

    }


    /**
     * @param string $agencia
     * @param string $conta
     *
     * @dataProvider providerTestErro
     */

    public function testeAgenciaInvalida(string $agencia, string $conta){
        $bankObj5 = new Bank ($agencia, $conta);
        $this->assertEquals($bankObj5->validateAg(), false);
    }

    /**
     * @param string $agencia
     * @param string $conta
     *
     * @dataProvider providerTest
     */

    public function TesteFinalContaAgValidas(string $agencia, string $conta) {
        $bankObj6 = new Bank ($agencia, $conta);
        $this->assertEquals($bankObj6->validate(), true);
    }

    /**
     * @param string $agencia
     * @param string $conta
     *
     * @dataProvider providerTest
     */
    public function testToInteger(string $agencia, string $conta){
        $bankObj7 = new Bank($agencia, $conta);
        $this->assertEquals($bankObj7->toInteger(), 63500201731);
    }

    /**
     * @return array
     */


    public function providerTestErro() {
        return [
            ['0633', '0020179-1'],

        ];
    }

    public function providerTest() {
        return [
          ['0635', '0020173-1'],
        ];
    }


}
