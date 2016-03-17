<h1>Шифрование с маршрутным ключом</h1>
<?php
	error_reporting(0);
	$key = mb_strtolower(file_get_contents('key5.txt'));
    $k = mb_strtolower(file_get_contents('k5.txt'));
	//Считывание русских букв
	function mbStringToArray($string, $encoding = 'UTF-8'){
		$strlen = mb_strlen($string);
		while($strlen){
			$array[] = mb_substr($string, 0, 1, $encoding);
			$string = mb_substr($string, 1, $strlen, $encoding);
			$strlen = mb_strlen($string, $encoding);
		}
		return ($array);
	}
        
	$key = mbStringToArray($key);
	$length = count($key);
	for($i = 0; $i < $length; $i++){
            if (!in_array($key[$i], $alfavit_new)){
                if(preg_match('/[а-я]+/i', $key[$i]) == 1 && $key[$i] != "»" && $key[$i] != "«"){
                    $alfavit_new[] = $key[$i];
                }
            }
	}
	
	//Считывание из файла
	$text1 = mb_strtolower(file_get_contents('index6.txt'));
	$text = mbStringToArray(mb_strtolower($text1));
    echo "<b>k: </b>";
	echo $k;
    echo "<br><b>l: </b>";
	$l = count($alfavit_new);
	echo $l;
	echo "<br><b>Ключ: </b>";
	for($i = 0; $i < count($key); $i++){
		echo $key[$i]; 
	}
	echo " (";
	for($i = 0; $i < $l; $i++){
		echo $alfavit_new[$i]; 
	}
	echo ")";
	echo "<br><b>Строка: </b>";
	echo $text1;
	
	$length_text = count($text);
	$f = ceil($length_text / $l);
	$arr_new = "";
	$j = 0;
	for($h = 0; $h < $f; $h+=$k){
		if($h >= $f-$k){
			if($length_text - $l*$k*$j > $l){
			}
			else{
				for($i = $l*$k*$j; $i < $length_text; $i++){
					$arr_new[$f-$k+1][$i - $l*$k*$j] = $text[$i];
				}
			}
		}
		else{
			$m = 0;
			for($i = $l*$k*$j; $i < $l*$k*($j+1); $i+=$k){
				$arr_new[$h][$m] = $text[$i];
				$arr_new[$h+1][$m] = $text[$i+1];
				$m++;
			}
			$j++;
		}
	}
	
	echo "<br>";
	echo "<br>";
	for($i = 0; $i < $f; $i++){
		for($j = 0; $j < $l; $j++){
			echo $arr_new[$i][$j]." ";
		}
		echo "<br>";
		if($i%2 == 1){echo "----------<br>";}
	}
	
	echo "<br><br><b>Расшифрованное сообщение: </b>";
	for($h = 0; $h < $f; $h+=$k){
		for($t = 224; $t <= 255; $t++){		
		//echo array_search(iconv("WINDOWS-1251", "UTF-8", chr($t)), $alfavit_new);
			if(array_search(iconv("WINDOWS-1251", "UTF-8", chr($t)), $alfavit_new) === FALSE){}
			else{
				$i = array_search(iconv("WINDOWS-1251", "UTF-8", chr($t)), $alfavit_new);
				echo $arr_new[$h][$i];
				echo $arr_new[($h+1)][$i];
			}
		}
	}
?>