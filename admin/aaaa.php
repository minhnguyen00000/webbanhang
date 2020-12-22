<?php


$t='<p>test<p><!--ccccc--><a href="#"> other text</a>';
echo strip_tags($t,'<a>'); 

?> <br><?php

$a=array("11","12","12"); $str=implode("+",$a);
echo $str;
?> <br><?php
$s="10-20-30";$a=explode("-", $s);$t=0;
foreach ($a as $key => $value) {
	$t+=$key+$value;
}
echo "$t";

?> <br><?php
$a=array(1,2,1,6);

foreach ($a as $key => $value) 
	if (isset($a[$value])) 
		unset($a[$value]);
	

echo array_sum($a);



function f6()
{
	$a=array(2=>0,1=>2,3=>1,4=>2);
	$s=0;
	foreach ($a as $key => $value) {$n=isset($a[$value])?$a[$value]:$a[$key];
		$s+=$n;
	}

	echo "$s";
}

f6();
?>