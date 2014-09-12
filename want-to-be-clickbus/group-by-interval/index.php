<?php


$numbers = array(10, 1, -20,  14, 99, 136, 19, 20, 117, 22, 93,  120, 131);

sort($numbers);     //Sort all members of array to ascendent 
$groups = array();
$range = 15;        //Define the range to compare and separate
$limit_group = 0;   //Used to determine the end of new group

$only_integers = is_numeric(implode('',$numbers));  //Validate if all items in array is numeric

if(!$only_integers){

    throw new InvalidArgumentException('Ops we have an invalid argument here ;p ');

}else{

    /*
    *    Compare all items and separate them in your range
    */
    for($i = 0; $i < count($numbers); $i++)
    {
        if($i > 0 && ( $numbers[$i] <= $limit_group ) ){        
            array_push($groups[count($groups) - 1], $numbers[$i]);
        }
        else {
            $limit_group = $numbers[$i] + $range;        
            array_push($groups, array($numbers[$i])); 
        }
    }

    /*
    *    Implode all items in each group
    */
    foreach($groups as $group)
    {
        echo implode($group,','). '<br>';
    }

}


?>

