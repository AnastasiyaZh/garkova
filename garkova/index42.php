<h1>Шифрование с маршрутным ключом</h1>
<?php
	error_reporting(0);
	$key = "маббдк";
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
        
        $new_array = "";
        $m = 0;
        for($i = 0; $i <= 9; $i++){
            for($j = 0; $j <= 3; $j++){
                $new_array[$j][$i] = $alfavit_new[$m];
                $m++;
            }
        }
	//Считывание из файла
	$text1 = file_get_contents('index5.txt');
	$text = mbStringToArray(mb_strtolower($text1));
        echo "<b>k: </b>";
	echo $k;
        echo "<br><b>l: </b>";
	echo count($alfavit_new);
	echo "<br><b>Ключ: </b>";
	for($i = 0; $i < count($key); $i++){
		echo $key[$i]; 
	}
	echo "<br><b>Строка: </b>";
	echo $text1;
	
        $length_text = count($text);
        $arr_new = "";
        $j = $m = 0;
	for($i = 0; $i < $length_text; $i++){
            $arr_new[$j][$m] = $text[$i];
            $m++;
            if($m == $l){
                $m = 0;
                $j++;
            }
	}
        
        echo var_dump($arr_new);
        
	//Декодирование
	echo "<br><br><b>Раскодированное: </b>";
	$length = count($text);
	for($i = 0; $i < $length; $i++){
		$j = array_search($text[$i], $alfavit_new);
		echo $alfavit[$j];
	}
	
?>