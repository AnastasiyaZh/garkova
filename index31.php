<h1>Общая алфавитная перестановка</h1>
<?php
	error_reporting(0);
	$key = "баввде";
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
	$text1 = file_get_contents('index3.txt');
	$text = mbStringToArray(mb_strtolower($text1));
	echo "<b>Ключ: </b>";
	echo $key;
	echo "<br><b>Строка: </b>";
	echo $text1;
	
	//Алфавит нормальный
	echo "<br><br><b>Алфавит1: </b>";
	for($i = 224; $i <= 255; $i++){
		$alfavit[] = iconv("WINDOWS-1251", "UTF-8", chr($i));
	}
	for($i = 0; $i < count($alfavit); $i++){
		echo $alfavit[$i]; 
	}
	echo "<br>";
	
	//Новый алфавит
	echo "<b>Алфавит2: </b>";
	$key = mbStringToArray($key);
	$length = count($key);
	for($i = 0; $i < $length; $i++){
		if (!in_array($key[$i], $alfavit_new)){
			if(preg_match('/[а-я]+/i', $key[$i]) == 1 && $key[$i] != "»" && $key[$i] != "«"){
				$alfavit_new[] = $key[$i];
			}
		}
	}
	for($i = 0; $i < count($alfavit); $i++){
		if (!in_array($alfavit[$i], $alfavit_new)){
			$alfavit_new[] = $alfavit[$i];
		}		 
	}
	for($i = 0; $i < count($alfavit_new); $i++){
		echo $alfavit_new[$i]; 
	}
	echo "<br><br>";
	
	//Кодирование
	$new_text = "";
	echo "<b>Закодированное: </b>";
	$length = count($text);
	for($i = 0; $i < $length; $i++){
                $tt = $text[$i];
                if($tt == "ё"){
                    $tt = "е";
                }
		$j = array_search($tt, $alfavit);
                if(preg_match('/[а-я]+/i', $tt) == 1 && $tt != "»" && $tt != "«"){
                    echo $alfavit_new[$j];
                }
                else{
                    echo $tt;
                }
	}
	$new_text = mbStringToArray($new_text);
	
	//Декодирование
	//echo "<br><b>Раскодированное: </b>";
	$length = count($text);
	for($i = 0; $i < $length; $i++){
		$j = array_search($new_text[$i], $alfavit_new);
		//echo $alfavit[$j];
	}
	
?>