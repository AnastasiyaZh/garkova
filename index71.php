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
        
	//Считывание из файла
	$text1 = file_get_contents('index10.txt');
	$text = mbStringToArray(mb_strtolower($text1));
	$key = mbStringToArray($key);
	
	echo "<br><b>Ключ: </b>";
	for($i = 0; $i < count($key); $i++){
		echo $key[$i]; 
	}
	echo "<br><b>Строка: </b>";
	echo $text1;
	
    $length = count($text);
	$jj = 0;
	
	echo "<br><br><b>Таблица: </b><br>";
	echo "<table border='1'>";
	echo "<tr>";
	for($j = 0; $j < $length; $j++){
		echo "<td style='padding: 3px;'>".$key[$jj]."</td>";
		if($jj + 1 == count($key)){
			$jj = 0;
		}
		else{
			$jj++;
		}
	}
	echo "</tr>";
	echo "<tr>";
	for($j = 0; $j < $length; $j++){
		echo "<td style='padding: 3px;'>".$text[$j]."</td>";
	}
	echo "</tr>";
	echo "</table>";
        
	//Шифрование
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
?>