<h1>Шифр "Марк"</h1>
<?php
	error_reporting(0);
	$key = mb_strtolower(file_get_contents('key5.txt'));
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
	$j = 0;
	for($i = 0; $i < $length; $i++){
		if (!in_array($key[$i], $alfavit_new)){
			if(preg_match('/[а-я]+/i', $key[$i]) == 1 && $key[$i] != "»" && $key[$i] != "«"){
				$alfavit_new[] = $key[$i];
				$j++;
				if($j == 7) break;
			}
		}
	}
   if(count($alfavit_new) < 2){
	   echo "Ключ слишком мал";
   } 
   else{
	echo "<b>Таблица: </b><br>";
	$new_array = "";
	$m = 0; $p = 224;
	for($j = 0; $j <= 9; $j++){
		$new_array[0][$j] = $alfavit_new[$j];
	}
	for($i = 1; $i <= 3; $i++){
		for($j = 0; $j <= 9; $j++){
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
	echo "<table border='1'>";
	for($i = 0; $i <= 3; $i++){
		echo "<tr>";
		for($j = 0; $j <= 9; $j++){
			echo "<td style='padding: 3px;'>".$new_array[$i][$j]."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
        
	//Считывание из файла
	$text1 = file_get_contents('index7.txt');
	$text = mbStringToArray(mb_strtolower($text1));
	echo "<br><b>Ключ: </b>";
	for($i = 0; $i < count($key); $i++){
		echo $key[$i]; 
	}
	echo "<br><b>Строка: </b>";
	echo $text1;
        
	//Декодирование
	echo "<br><br><b>Зашифрованное: </b>";
	$length_text = count($text);
	for($q = 0; $q < $length_text; $q++){
            $tt = $text[$q];
            if($tt == "ё"){
                $tt = "е";
            }
            
            for($i = 0; $i <= 3; $i++){
                for($j = 0; $j <= 9; $j++){
                    if($new_array[$i][$j] == $tt){
                        $i1 = $i;
                        $j1 = $j + 1;
                        if($j1 == 10){
                            $j1 = 0;
                        }
                        if($i1 == 0){
                            $i1 = "";
                        }
                        if($i1 == 1){
                            $i1 = 8;
                        }
                        if($i1 == 2){
                            $i1 = 9;
                        }
                        if($i1 == 3){
                            $i1 = 0;
                        }
                        echo $i1.$j1."";
                    }
                }
            }   
	}
   }
?>