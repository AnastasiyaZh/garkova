<h1>Частотный анализ</h1>
<?php
	error_reporting(0);
	
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
	
	//Считывание из файла
	$text1 = file_get_contents('index1.txt');
	$text = mbStringToArray(mb_strtolower($text1));
	
	
	$length = count($text);
	for($i = 0; $i < $length; $i++){
		$j = $i + 1;
		if(preg_match('/[а-я]+/i', $text[$i]) == 1 && preg_match('/[а-я]+/i', $text[$j]) == 1 && $j < $length && $text[$i] != "»" && $text[$j] != "»" && $text[$i] != "«" && $text[$j] != "«"){
			$d = $text[$i].$text[$j];
			$arr[] = $d;
		}
	}
	$arr_count = array_count_values($arr);
	arsort($arr_count);
	
	//Вывод
	echo "<b>Ваш текст: </b>".$text1."<br><br>";
	foreach($arr_count as $key => $value){
		echo $key." => ".round($value/count($arr), 3)."<br>";
	}
?>