<h1>Числа палиндромы</h1>
<?php
	error_reporting(0);
	$n = file_get_contents('index9.txt');

	$num = $n + 1;
	$exp = strlen((int)($num - pow(10,(strlen($num) - 2)))) - 1;
	$num -= pow(10, $exp); 

	echo "<b>Полиндром ".$n ." - </b>";

	if($n < 10){
		echo $n;
	}
	else{
		if($num >= pow(10, $exp) || $num == 0){ //четно
			$str_rev = strval(strrev($num));
			$s = strval($num);
			echo substr($s, 0, -1).$str_rev;
		}
		else{ // нечетно
			$str_rev = strval(strrev($num));
			echo $num.$str_rev;
		}
	}
?>
