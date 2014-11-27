<?php


$numbers = array(10, 1, -20,  14, 99, 136, 19, 20, 117, 22, 93,  120, 131);
order($numbers);

$groups = array();
$range = 10;
$limit_group = 0;

for ($i = 0; $i < count($numbers); $i++) {
  if($i > 0 && ( $numbers[$i] <= $limit_group ) ){        
    $groups[count($groups) - 1][] = $numbers[$i];
  }
  else {
    $limit_group = $numbers[$i] + $range;
    $groups[] = array($numbers[$i]);
  }
}

foreach ($groups as $group) {
  echo implode($group,','). '<br>';
}



/* 
 * Function to reorder an array.
 */
function order(&$array) {

  $tam = count($array);

  for ($i = $tam - 1; $i >= 1; $i--) {
    for ($j = 0; $j < $i; $j++) {
      if (!is_numeric($array[$j])) {
        throw new InvalidArgumentException('Ops we have an invalid argument here ;p ');
      }

      if ($array[$j] > $array[$j + 1]) {
        $k = $array[$j];
        $array[$j] = $array[$j + 1];
        $array[$j + 1] = $k;
      }
    }
  }

  return $array;
}

?>

