<?php

/**
 *
 * conforme contato com Johnatan Young, segue resolução do problema 
 * do cash machine
 *
 * @author Valdir Bruxel Junior <hagnat@gmail.com>
 */

require_once dirname(__FILE__).'/exceptions/NoteUnavailableException.php';

class CashMachine
{
	protected $available_bills = array(100, 50, 20, 10);

	public function withdraw($value)
	{
		$value = (int)$value;

		// throws an exception if the value is negative
		if (0 > $value) {
			throw new InvalidArgumentException();
		}

		$bills = array();

		// sorts available bills in reverse order, so we will always provide
		// the least amount of bills possible
		rsort($this->available_bills);

		// iterates over each available bill
		foreach ($this->available_bills as $bill) {
			// it will stack bills of this value while it can
			while ($bill <= $value) {
				$bills[] = $bill;
				$value -= $bill;
			}
		}

		// if after iterating over all available bills it didn't managed to
		// reach the requested value, it will throw an exception that it doesn't
		// have the bills necessary to fulfilll this request
		if ($value) {
			throw new NoteUnavailableException();
		}

		return $bills;
	}
}