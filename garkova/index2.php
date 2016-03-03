<h1>Анаграмма числа</h1>
<?php
	error_reporting(0);
	
	//Считывание из файла
	$s = file_get_contents('index2.txt');
	$text = $s;
	$s1 = $s;	
	$length = mb_strlen($s);
	
	//Вывод	
	echo "<b>Ваш текст: </b>".$s."<br><br>";	
	for($m = 0; $m < $length; $m++){
		for($i = $length - 1; $i >= 0; $i--){
			for($j = $length - 1; $j >= 0; $j--){
				if(($s[$i] != $s[$j]) && (($s[$i] < $s[$j]) || ($s[$i] == $s1[$i])) && ($s1[$j] != $s[$i]) && ($s[$j] != $s1[$i])){
					$k = $s[$j];
					$s[$j] = $s[$i];
					$s[$i] = $k;
				}
			}
		}
	}

	$s2 = $s;
	$s = $s3;	
	
	for($m = 0; $m < $length; $m++){
		for($i = 0; $i < $length; $i++){
			for($j = 0; $j < $length; $j++){
				if(($s[$i] != $s[$j]) && (($s[$i] < $s[$j]) || ($s[$i] == $s1[$i])) && ($s1[$j] != $s[$i]) && ($s[$j] != $s1[$i])){
					$k = $s[$j];
					$s[$j] = $s[$i];
					$s[$i] = $k;
				}
			}
		}
	}
	
	if($text == $s || $text == $s2){
		echo "Замена невозможна";
	}
	else{
		echo "<b>Анаграмма: </b>";
		if((int)$s2 < (int)$s){
			for($i = 0; $i < $length; $i++){
				echo $s[$i]; 
			}
		}
		else{
			for($i = 0; $i < $length; $i++){
				echo $s2[$i]; 
			}
		}
	}
?>