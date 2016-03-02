<h1>Шифр "Марк"</h1>
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
        
        echo "<b>Таблица: </b><br>";
        $new_array = "";
        $m = 0; $p = 224;
        for($i = 0; $i <= 3; $i++){
            for($j = 0; $j <= 9; $j++){
                if($m < count($alfavit_new)){
                    $new_array[$i][$j] = $alfavit_new[$m];
                    $m++;
                }
                else{
                    if(!in_array(iconv("WINDOWS-1251", "UTF-8", chr($p)), $alfavit_new)){
                        $new_array[$i][$j] = iconv("WINDOWS-1251", "UTF-8", chr($p));
                        $p++;
                    }
                    else{
                        $j--;
                        $p++;
                    }
                    
                    if($p == 256){
                        break;
                    }
                    
                }
            }
        }

        for($i = 0; $i <= 3; $i++){
            for($j = 0; $j <= 9; $j++){
                echo $new_array[$i][$j]." ";
            }
            echo "<br>";
        }
        
	//Считывание из файла
	$text1 = file_get_contents('index8.txt');
	$text = explode(" ", $text1);
	echo "<br><b>Ключ: </b>";
	for($i = 0; $i < count($key); $i++){
		echo $key[$i]; 
	}
	echo "<br><b>Строка: </b>";
	echo $text1;
        
	//Декодирование
	echo "<br><br><b>Декодированное: </b>";
	$length_text = count($text);
	for($q = 0; $q < $length_text; $q++){
            $tt = mbStringToArray($text[$q]);
            if(count($tt) == 1){
                echo $new_array[0][$tt[0]-1];
            }
            else{
                $i1 = $tt[0];
                if($i1 == 8){
                    $i1 = 1;
                }
                if($i1 == 9){
                    $i1 = 2;
                }
                if($i1 == 0){
                    $i1 = 3;
                }
                echo $new_array[$i1][$tt[1]-1];
            }  
	}
?>