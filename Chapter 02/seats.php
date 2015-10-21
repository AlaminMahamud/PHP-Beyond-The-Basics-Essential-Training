<?php

$a = 'Kevin';
$b = 'Skoglund';
$c = 'Joe';
$d = 'Marini';
$e = 'lynda';

$students = array('a', 'c', 'e');
foreach($students as $seat)
{
  echo $$seat . '<br/>';
}

?>
