<h1>Числа палиндромы</h1>
<?php
	error_reporting(0);
	$n = file_get_contents('index9.txt');;
	echo "<b>Полиндром номер ".$n." : </b>";
	
	$currlen = 1;
	$currcount = 9;
	while($n > $currcount){
		$n -= $currcount;
		$currlen += 1;
		$currcount =  pow(9*10, ceil(($currlen - 1) / 2));
	}
	
	$leftsize = ceil(($currlen - 1) / 2); 
	$rightsize = $currlen - $leftsize;

	$leftpart = pow(10, ($leftsize - 1)) + $n - 1; 
	$rightpart = strrev($leftpart); 
	if($rightsize < $leftsize){
		$rightpart = substr($rightpart, 1);  
	}
	
	echo $leftpart.$rightpart;
?>