<?PHP

// Author: Aninu Alin / 2016

	function GPost($v){
		global $_POST;
		if(isset($_POST[$v]))
			return $_POST[$v];
		else 
			return "";
    }
	//used for displaying the propositions
	function p_check($v,$t=0) {
		$replace = array(
			'0'	=> "",
			'1'	=> "!",
			'2'	=> "&",	
			'3'	=> "|",	
			'4'	=> ">",	
			'5'	=> "=",	
			'6'	=> "",	
			'7'	=> "",	
			'8'	=> "",	
			'9'	=> "",	
		);
		$search = array(
			'0'	=> " ",
			'1'	=> "¬",
			'2'	=> "∧",	
			'3'	=> "∨",	
			'4'	=> "→",	
			'5'	=> "↔",	
			'6'	=> ",",	
			'7'	=> ".",		
			'8'	=> "\n",	
			'9'	=> "\t",	
		);
		if($t==0)
			$v = str_replace($search, $replace, $v);
		else
			$v = str_replace($replace, $search, $v);
		return $v;
	}
	function p_return($n){
		switch($n){
			case 0:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: Nu pot exista doua propozitii lipite</font> <br>";
				echo "<font color='red'> Propozitiile compuse trebuie scrise in paranteze </font> <br>";
				echo "<font color='red'> Operatorii nu pot forma singuri o propozitie </font> <br>";
				echo "<font color='red'> Cifrele nu pot fi folosite in propozitii </font> <br>";
				echo "<font color='red'> Parantezele sunt folosite pentru propozitii compuse </font> <br>";
				break;
			case 1:
				echo "<font color='green'>Este o propozitie. (Negatie) </font>";
				break;
			case 2:
				echo "<font color='green'>Este o propozitie. (Conjunctie)</font>";
				break;
			case 3:
				echo "<font color='green'>Este o propozitie. (Disjunctie)</font>";
				break;
			case 4:
				echo "<font color='green'>Este o propozitie. (Implicatie)</font>";
				break;
			case 5:
				echo "<font color='green'>Este o propozitie. (Echivalenta)</font>";
				break;
			case 6:
				p_return(0);
				break;
			case 7:
				echo "<font color='green'>Este o propozitie. (Simpla)</font>";
				break;
			case 8:
				p_return(0);
				break;
			case 9:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: Parantezele deschise difera de cele inchise!</font> <br>";
				break;
			case 10:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: Folositi modelul oferit mai sus pentru a scrie o propozitie corect!</font> <br>";
				break;
			case 11:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: O propozitie corecta nu poate folosii litere mici!</font> <br>";
				break;
			case 12:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: O propozitie compusa trebuie sa contina paranteze!</font> <br>";
				break;
			case 13:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: Nu ati respectat regula de scriere pentru negatie!</font> <br>";
				break;
			case 14:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: Nu ati respectat regula de scriere pentru conjunctie!</font> <br>";
				break;
			case 15:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: Nu ati respectat regula de scriere pentru disjunctie!</font> <br>";
				break;
			case 16:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: Nu ati respectat regula de scriere pentru implicatie!</font> <br>";
				break;
			case 17:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: Nu ati respectat regula de scriere pentru echivalenta!</font> <br>";
				break;
			case 18:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: Scrierea unei propozitii compuse este gresita!</font> <br>";
				break;
			case 19:
				echo "<br>Nu este o propozitie. (Scrierea este gresita) <br>";
				echo "<font color='red'> Nota: Propozitia gasita nu este una corecta!</font> <br>";
				break;
		}
	}
	function p_negatie($v,$s=0){
		if(strlen($v)==4){
			$tee = str_split($v);
			if($tee[$s]=="(" and $tee[$s+1]=="!" and p_clasic($tee[$s+2]) and $tee[$s+3]==")")
				return 1;
			//elseif($tee[$s+1]=="!" and p_clasic($tee[$s+2]))
				//return 0;
			else
				return 0;
		}else
			return 0;
	}
	function p_conjunctie($v,$s=0){
		if(strlen($v)==5){
			$tee = str_split($v);
			if($tee[$s]=="("  and p_clasic($tee[$s+1]) and $tee[$s+2]=="&" and p_clasic($tee[$s+3]) and $tee[$s+4]==")")
				return 1;
			else
				return 0;
		}else
			return 0;
	}
	function p_disjunctie($v,$s=0){
		if(strlen($v)==5){
			$tee = str_split($v);
			if($tee[$s]=="("  and p_clasic($tee[$s+1]) and $tee[$s+2]=="|" and p_clasic($tee[$s+3]) and $tee[$s+4]==")")
				return 1;
			else
				return 0;
		}else
			return 0;
	}
	function p_implicatie($v,$s=0){
		if(strlen($v)==5){
			$tee = str_split($v);
			if($tee[$s]=="("  and p_clasic($tee[$s+1]) and $tee[$s+2]==">" and p_clasic($tee[$s+3]) and $tee[$s+4]==")")
				return 1;
			else
				return 0;
		}else
			return 0;
	}
	function p_echivalenta($v,$s=0){
		if(strlen($v)==5){
			$tee = str_split($v);
			if($tee[$s]=="("  and p_clasic($tee[$s+1]) and $tee[$s+2]=="=" and p_clasic($tee[$s+3]) and $tee[$s+4]==")")
				return 1;
			else
				return 0;
		}else
			return 0;
	}
	function p_total_paranteze($v){
		$p1 = substr_count($v,"(");
		$p2 = substr_count($v,")");
		if($p1 == $p2)
			return 0;
		else
			return 1;
	}
	function p_prop_paranteze($v,$s=0){
		if(strlen($v)==3){
			$tee = str_split($v);
			if($tee[$s]=="(" and $tee[$s+2]==")")
				return 1;
			else
				return 0;
		}else
			return 0;
	}
	function p_repeat($v){
			$ok = 0;
			$tee = str_split($v);
			for($i=0; $i < strlen($v) - 1; $i++)
				if((p_clasic($tee[$i]) and p_clasic($tee[$i+1])) or (!p_clasic($tee[$i]) and p_clasic($tee[$i+1])) or (p_clasic($tee[$i]) and !p_clasic($tee[$i+1])) or (!p_clasic($tee[$i]) and !p_clasic($tee[$i+1]))){
					$ok = 1;
					break;
				}
			return $ok;
	}
	function p_max_repeat($v){
			$ok = 0;
			$tee = str_split($v);
			for($i=0; $i < strlen($v) - 1; $i++)
				if((p_clasic($tee[$i]) and p_clasic($tee[$i+1])) 
					or ($tee[$i]=="!" and $tee[$i+1]=="!") or ($tee[$i]=="!" and $tee[$i+1]=="&") or ($tee[$i]=="!" and $tee[$i+1]=="|") or ($tee[$i]=="!" and $tee[$i+1]==">") or ($tee[$i]=="!" and $tee[$i+1]=="=")
					or ($tee[$i]=="&" and $tee[$i+1]=="!") or ($tee[$i]=="&" and $tee[$i+1]=="&") or ($tee[$i]=="&" and $tee[$i+1]=="|") or ($tee[$i]=="&" and $tee[$i+1]==">") or ($tee[$i]=="&" and $tee[$i+1]=="=")
					or ($tee[$i]=="|" and $tee[$i+1]=="!") or ($tee[$i]=="|" and $tee[$i+1]=="&") or ($tee[$i]=="|" and $tee[$i+1]=="|") or ($tee[$i]=="|" and $tee[$i+1]==">") or ($tee[$i]=="|" and $tee[$i+1]=="=")
					or ($tee[$i]==">" and $tee[$i+1]=="!") or ($tee[$i]==">" and $tee[$i+1]=="&") or ($tee[$i]==">" and $tee[$i+1]=="|") or ($tee[$i]==">" and $tee[$i+1]==">") or ($tee[$i]==">" and $tee[$i+1]=="=")
					or ($tee[$i]=="=" and $tee[$i+1]=="!") or ($tee[$i]=="=" and $tee[$i+1]=="&") or ($tee[$i]=="=" and $tee[$i+1]=="|") or ($tee[$i]=="=" and $tee[$i+1]==">") or ($tee[$i]=="=" and $tee[$i+1]=="=")
					){
					$ok = 1;
					break;
				}
			return $ok;
	}
	function p_clasic($v){
		if(strlen($v)==1){
			$ok = 0;
			for($i=65; $i<=90; $i++){
				if(ord($v) == $i){
					$ok = 1;
					break;
				}
			}
			return $ok;
		}else
			return 0;
	}	
	function p_litere_mici($v){
		$tee = str_split($v);
		$ok = 0;
		for($j=0; $j < strlen($v) - 1; $j++){
			for($i=97; $i<=122; $i++){
				if(ord($tee[$j]) == $i){
					$ok = 1;
					break;
				}
			}			
		}
		return $ok;
	}	
	// verifies if we start with ( and not with )
	function p_fara_paranteze($v){
		$tee = str_split($v);
		$ok = 1;
		for($j=0; $j < strlen($v) - 1; $j++)
			if($tee[$j] == "("){
				$ok = 0;
				break;
			}		
		for($j=1; $j < strlen($v); $j++)
			if($tee[$j] == ")"){
				$ok = 0;
				break;
			}		
		return $ok;
	}	
	function p_eroare_negatie($v){
		$tee = str_split($v);
		$ok = 0;
		for($j=0; $j < strlen($v) - 2; $j++)
			if(($tee[$j] == "!" and p_clasic($tee[$j+1]) and $tee[$j+2] == "!")){
				$ok = 1;
				break;
			}
		return $ok;
	}	
	function p_eroare_conjunctie($v){
		$tee = str_split($v);
		$ok = 0;
		for($j=0; $j < strlen($v) - 2; $j++)
			if(($tee[$j] == "&" and p_clasic($tee[$j+1]) and $tee[$j+2] == "&")){
				$ok = 1;
				break;
			}
		return $ok;
	}	
	function p_eroare_disjunctie($v){
		$tee = str_split($v);
		$ok = 0;
		for($j=0; $j < strlen($v) - 2; $j++)
			if(($tee[$j] == "|" and p_clasic($tee[$j+1]) and $tee[$j+2] == "|")){
				$ok = 1;
				break;
			}
		return $ok;
	}	
	function p_eroare_implicatie($v){
		$tee = str_split($v);
		$ok = 0;
		for($j=0; $j < strlen($v) - 2; $j++)
			if(($tee[$j] == ">" and p_clasic($tee[$j+1]) and $tee[$j+2] == ">")){
				$ok = 1;
				break;
			}
		return $ok;
	}	
	function p_eroare_echivalenta($v){
		$tee = str_split($v);
		$ok = 0;
		for($j=0; $j < strlen($v) - 2; $j++)
			if(($tee[$j] == "=" and p_clasic($tee[$j+1]) and $tee[$j+2] == "=")){
				$ok = 1;
				break;
			}
		return $ok;
	}	
	function p_find($v,$s=0){
		if(p_total_paranteze($v,$s))
			return 9;
		if(p_negatie($v,$s))
			return 1;
		elseif(p_conjunctie($v,$s))
			return 2;
		elseif(p_disjunctie($v,$s))
			return 3;
		elseif(p_implicatie($v,$s))
			return 4;
		elseif(p_echivalenta($v,$s))
			return 5;
		elseif(p_prop_paranteze($v,$s))
			return 6;
		elseif(p_clasic($v))
			return 7;
		elseif(p_repeat($v))
			return 8;
		else 
			return 0;
	}
	function p_exist($v){
		if(strlen($v)>5){
			echo "Propozitia este: <b>".p_check($v,1)."</b>";
			if(p_total_paranteze($v))
				return p_return(9);
			elseif(p_max_repeat($v))
				echo p_return(10);
			elseif(p_litere_mici($v))
				echo p_return(11);
			elseif(p_fara_paranteze($v))
				echo p_return(12);
			elseif(p_eroare_negatie($v))
				echo p_return(13);
			elseif(p_eroare_conjunctie($v))
				echo p_return(14);
			elseif(p_eroare_disjunctie($v))
				echo p_return(15);
			elseif(p_eroare_implicatie($v))
				echo p_return(16);
			elseif(p_eroare_echivalenta($v))
				echo p_return(17);
			else{
				$tee = str_split($v);
				$d = 0;
				$s = 0;
				for($i=0; $i < strlen($v); $i++){
					if(($tee[$i] == "(") and !$d)
						$s = $i;
					if($tee[$i]==")" and $s)
						$d = $i;
					if($s and $d)
						break;
				}
				if($s and $d){
					$cuv = "";
					$text = "";
					for($k=$s; $k<=$d;$k++)
						$cuv .= $tee[$k];
					$rsp = p_find($cuv);
					if($rsp==1 or $rsp == 2 or $rsp == 3 or $rsp == 4 or $rsp == 5 or $rsp == 7){
						echo " si notam: <b>A = ".p_check($cuv,1)."</b> ";
						echo p_return(p_find($cuv))."<br>";
						if(p_find($cuv)){
							for($i=0; $i < $s; $i++)
								$text .= $tee[$i];
							$text .= "A";
							for($i=$d+1; $i < strlen($v); $i++)
								$text .= $tee[$i];
						}
						if(strlen($text)>1){
							p_exist($text);
						}else{
							return $cuv." ".$text; 
						}						
					}else{
						echo " Propozitia selectata: <b>".p_check($cuv,1)."</b> ";
						echo p_return(19);
					}
				}else
					echo p_return(18);
				
			}
		}else{
			echo "Propozitia este: <b>".p_check($v,1)."</b> <br>";
			return p_return(p_find($v));
		}	
	}
?>
