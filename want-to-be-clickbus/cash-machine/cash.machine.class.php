<?php

class NoteUnavailableException extends Exception{

    protected $title;

    public function __construct($title, $message, $code = 0, Exception $previous = null) {

        $this->title = $title;
        parent::__construct($message, $code, $previous);
    }

    public function getTitle(){

        return $this->title;
    }
}



class CashMachine 
{

	function __construct(){}

	public static function getMoney($amount){

		$count = array(0,0,0,0,0);
		$notes = array(100,50,20,10);
		$result = array();
		
		/*
		*	Composes count with values ​​available for withdrawal 	
		*/
		for($i=0;$i<count($notes);$i++):

			if($notes[$i]<$amount || $notes[$i]==$amount):
				
				$count[$i]=floor($amount/$notes[$i]);
				$amount= $amount%$notes[$i];

			endif;

		endfor;
		
		
		/*
		*	Composition of which and how many notes will be used to serve	
		*/
		if($amount==0):

			for($i=0;$i<count($count);$i++):
				if($count[$i]!=0):
					echo ($notes[$i].' * '.+$count[$i] .'='. ($notes[$i]*$count[$i])).'<br>';
					$tot += $notes[$i] * $count[$i];
				endif;
			endfor;

		else:

			if($amount<0):
				print '<b>This amount is negative and invalid to execute a withdrawal:  '.$amount.'</b>';
				throw new NoteUnavailableException("Withdrawals Invalid", "This amount is negative and invalid to execute a withdrawal");
			else:
				print '<b>Were sorry, this machine makes no withdrawals from fewer broken values​​:  '.$amount.'</b>';
				throw new InvalidArgumentException('Were sorry, this machine makes no withdrawals from fewer broken values​​ : '.$amount);
			endif;
			
		endif;
	}


}
	
	// Test drive
	$c = new CashMachine();
	print '<b>Composition and arrangement of notes for withdrawal : </b><br>';
	$c->getMoney(120);


?>