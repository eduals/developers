<?php

require_once dirname(__FILE__).'/../../CashMachine.php';

class CashMachineTest extends PHPUnit_Framework_TestCase
{
	public function setup()
	{
		$this->cash_machine = new CashMachine();
	}

	/**
     * @expectedException InvalidArgumentException
	 */
	public function testWithdrawThrowsInvalidArgumentExceptionOnNegativeValue()
	{
		$bills = $this->cash_machine->withdraw(-10);
	}

	/**
     * @expectedException NoteUnavailableException
	 */
	public function testWithrdawThrowsExceptionOnUnaivailableNote()
	{
		$bills = $this->cash_machine->withdraw(5);
	}

	public function validWithdrawalProvider()
	{
		return array(
			array(null, array()),
			array(10,   array(10)),
			array(20,   array(20)),
			array(30,   array(20,10)),
			array(40,   array(20,20)),
			array(50,   array(50)),
			array(60,   array(50, 10)),
			array(70,   array(50, 20)),
			array(80,   array(50, 20, 10)),
			array(90,   array(50, 20, 20)),
			array(100, array(100)),
			);
	}

	/**
	 * @dataProvider validWithdrawalProvider
	 */
	public function testValidWithdrawals($value, $expected)
	{
		$bills = $this->cash_machine->withdraw($value);
		$this->assertEquals($expected, $bills);
	}

}