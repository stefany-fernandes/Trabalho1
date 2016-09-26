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
    public function testConstructor(){
        $bankObj = new Bank('0635', '0020173-1');
        $this->assertEquals($bankObj->toInteger(), 63500201731);
        $this->assertEquals($bankObj->toFormatted(), '0635 0020173-1');
    }

}
