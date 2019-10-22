<?PHP	
	function GPost($v){
		global $_POST;
		if(isset($_POST[$v]))
			return $_POST[$v];
		else 
			return "";
    }
	function putere($v){
		$p = 1;
		for($i = 1;$i <= $v; $i++)
			$p *= 2;
		return $p;
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
	function p_negatie($v,$s=0){
		if(strlen($v)==4){
			$tee = str_split($v);
			if($tee[$s]=="(" and $tee[$s+1]=="!" and p_clasic($tee[$s+2]) and $tee[$s+3]==")")
				return 1;
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
			return 0;
		if(p_negatie($v,$s))
			return 1;
		elseif(p_conjunctie($v,$s))
			return 1;
		elseif(p_disjunctie($v,$s))
			return 1;
		elseif(p_implicatie($v,$s))
			return 1;
		elseif(p_echivalenta($v,$s))
			return 1;
		elseif(p_prop_paranteze($v,$s))
			return 0;
		elseif(p_clasic($v))
			return 1;
		elseif(p_repeat($v))
			return 0;
		else 
			return 0;
	}
	function p_exist($v){
		if(strlen($v)>5){
			if(p_total_paranteze($v))
				return 0;
			elseif(p_max_repeat($v))
				return 0;
			elseif(p_litere_mici($v))
				return 0;
			elseif(p_fara_paranteze($v))
				return 0;
			elseif(p_eroare_negatie($v))
				return 0;
			elseif(p_eroare_conjunctie($v))
				return 0;
			elseif(p_eroare_disjunctie($v))
				return 0;
			elseif(p_eroare_implicatie($v))
				return 0;
			elseif(p_eroare_echivalenta($v))
				return 0;
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
					if($rsp==1){
						if(p_find($cuv)==1){
							for($i=0; $i < $s; $i++)
								$text .= $tee[$i];
							$text .= "A";
							for($i=$d+1; $i < strlen($v); $i++)
								$text .= $tee[$i];
						}
						if(strlen($text)>1)
							return p_exist($text);
						else
							return 0; 			
					}else
						return 0;
				}else
					return 0;	
			}
		}else{
			if(p_find($v)==1)
				return 1;		
			else
				return 0;
		}
	}
	function p_echo($v){
		if(strlen($v)>5){
			echo "Propozitia este: <b>".p_check($v,1)."</b>";
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
			$cuv = "";
			$text = "";
			for($k=$s; $k<=$d;$k++)
				$cuv .= $tee[$k];
			$rsp = p_find($cuv);
			if($rsp==1 or $rsp == 2 or $rsp == 3 or $rsp == 4 or $rsp == 5 or $rsp == 7){
				echo " si notam: <b>A = ".p_check($cuv,1)."</b> "."<br>";
				if(p_find($cuv)){
					for($i=0; $i < $s; $i++)
						$text .= $tee[$i];
					$text .= "A";
					for($i=$d+1; $i < strlen($v); $i++)
						$text .= $tee[$i];
				}
				if(strlen($text)>1){
					p_echo($text);
				}else{
					return $cuv." ".$text; 
				}						
			}else{
				echo " Propozitia selectata: <b>".p_check($cuv,1)."</b> ";
			}
		}else{
			echo "Propozitia este: <b>".p_check($v,1)."</b> <br>";
		}	
	}
	function show_message($v){
		if(p_exist(p_check($v))){
			echo "Este o propozitie!";
			echo "<br>";
			p_echo($v);
		}else
			echo "Nu este o propozitie!";
	}
	function val($ch){
		if($ch=="A")
			return 1;
		elseif($ch == "B")
			return 0;
		else{
			$g = GPost('val_'.$ch);
			if($g == '2')
				return 0;
			else
				return 1;
		}
	}
	function val_conj($v,$typ){
		$tee = str_split($v);
		$v1 = get_val($tee[1],$typ);
		$v2 = get_val($tee[3],$typ);
		if($v1 and $v2)
			return 1;
		else
			return 0;
	}
	function val_disj($v,$typ){
		$tee = str_split($v);
		$v1 = get_val($tee[1],$typ);
		$v2 = get_val($tee[3],$typ);
		if(!$v1 and !$v2)
			return 0;
		else
			return 1;
	}
	function val_impl($v,$typ){
		$tee = str_split($v);
		$v1 = get_val($tee[1],$typ);
		$v2 = get_val($tee[3],$typ);
		if($v1 and !$v2)
			return 0;
		else
			return 1;
	}
	function val_echi($v,$typ){
		$tee = str_split($v);
		$v1 = get_val($tee[1],$typ);
		$v2 = get_val($tee[3],$typ);
		if(!$v1 and !$v2 or $v1 and $v2)
			return 1;
		else
			return 0;
	}
	function val_true($v,$typ){
		$tee = str_split($v);
		if(strlen($v)==4){
			$val = get_val($tee[2],$typ);
			if($val)
				return 0;
			else
				return 1;
		}else{
			if($tee[2]=="&")
				return val_conj($v,$typ);
			elseif($tee[2]=="|")
				return val_disj($v,$typ);
			elseif($tee[2]==">")
				return val_impl($v,$typ);
			elseif($tee[2]=="=")
				return val_echi($v,$typ);
		}
	}
	function all_termen($v){
		$ll = strlen($v);
		$tee = str_split($v);
		$jj = 0;
		$list = array();
		for($ii = 0; $ii < $ll; $ii++){
			if(p_clasic($tee[$ii])){
				$kk = 0;
				$ok = 1;
				while($kk < $jj){
					if($list[$kk] == $tee[$ii]){
						$ok = 0;
						break;
					}
					$kk++;
				}
				if($ok==1){
					$list[$jj] = $tee[$ii];
					$jj++;
				}
			}
		}
		return $list;
	}
	function calc_true($v,$typ){
		if(strlen($v)>5){
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
			$cuv = "";
			$text = "";
			for($k=$s; $k<=$d;$k++)
				$cuv .= $tee[$k];
			for($i=0; $i < $s; $i++)
				$text .= $tee[$i];
			if(val_true($cuv,$typ))
				$text .= "A";
			else
				$text .= "B";
			for($i=$d+1; $i < strlen($v); $i++)
				$text .= $tee[$i];
			return calc_true($text,$typ);		
		}else{
			return val_true($v,$typ);
		}
	}
	function get_val($v,$k){
		if($v=="A")
			return 1;
		elseif($v == "B")
			return 0;
		else{
			$prop = p_check(GPost("prop"));
			$lista = all_termen($prop);
			$len = count($lista);
			$pos = 0;
			for($i = 0; $i < $len; $i++){
				if($lista[$i]==$v){
					$pos = $i;
				}
			}
			$val_adv = generate_true($len);
			return $val_adv[$k][$pos];
		}
	}
	function generate_true($arrlength){
		$max = putere($arrlength);
		$val_adv = array();
		$k = 2;
		for($tj=0; $tj < $arrlength; $tj++){
			$a = 0;
			$p = 1;
			for($ti = 1; $ti <= $max; $ti++){
				$new_max = $max / $k;
				if(!$a)
					$p = 1;
				if($a == $new_max)
					$p = 0;
				if($p){
					$a++;
					$val_adv[$ti][$tj] = 0;
				}else{
					$a--;
					$val_adv[$ti][$tj] = 1;
				}			
			}
			$k *= 2;
		}
		return $val_adv;
	}
	function show_replace($v){
		if(strlen($v)>5){
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
			$cuv = "";
			$text = "";
			for($k=$s; $k<=$d;$k++)
				$cuv .= $tee[$k];
			echo "<td style='background: #8BC34A;'>".p_check($cuv,1)."</td>";
			
			for($i=0; $i < $s; $i++)
				$text .= $tee[$i];
			$text .= "A";
			for($i=$d+1; $i < strlen($v); $i++)
				$text .= $tee[$i];
			return show_replace($text);		
		}else{
			echo "<td style='background: #8BC34A;'>".p_check($v,1)."</td>";
		}
	}
	function show_replace_with($v,$typ){
		if(strlen($v)>5){
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
			$cuv = "";
			$text = "";
			for($k=$s; $k<=$d;$k++)
				$cuv .= $tee[$k];
			
			for($i=0; $i < $s; $i++)
				$text .= $tee[$i];
			echo "<td style='background: #8BC34A;'>".val_true($cuv,$typ)."</td>";
			if(val_true($cuv,$typ))
				$text .= "A";
			else
				$text .= "B";
			for($i=$d+1; $i < strlen($v); $i++)
				$text .= $tee[$i];
			return show_replace_with($text,$typ);		
		}else{
			echo "<td style='background: #8BC34A;'>".val_true($v,$typ)."</td style='background: #8BC34A;'>";
		}
	}
?>
