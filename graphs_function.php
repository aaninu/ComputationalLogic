<?PHP	
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
	function find_dominant($v){
		if(p_exist(p_check($v))){
			if(strlen($v)>5){
				
			
			}else{
				$tee = str_split($v);
				for($k=0;$k<strlen($v);$k++){
					if($tee[$k]=="!") return '';
				}
					
			}
		}else
			return 0;
	}
	function show_circle($x,$y,$t){
		echo '<div id="cerc" style="left: '.$x.'px; top:'.$y.'px;">'.$t.'</div>';
	}
	function show_line($x,$y,$r){
		echo '<div id="line" style="left: '.$x.'px; top:'.$y.'px;transform: rotate('.$r.'deg);"></div>';
	}
	function show_simple($v,$x=100,$y=500,$r = 45){
		$tee = str_split($v);
		if(strlen($v)==4){
			show_circle($x,$y,"(,".p_check($tee[1],1).",)");
			show_line($x-3,$y+63,90);
			show_circle($x,$y+86,$tee[2]);
		}else{
			show_circle($x,$y,"(,".p_check($tee[2],1).",)");
			show_line($x-16,$y+57,-45);
			show_line($x+16,$y+57,45);
			show_circle($x-30,$y+75,$tee[1]);	
			show_circle($x+40,$y+75,$tee[3]);
		}
	}
	function show_arbore($v){
		global $global_p;
		global $global_s;
		if(p_exist(p_check($v))){
			show_simple($v,200,600);
		/*
			$tee = str_split($v);
			for($k=0;$k<strlen($v);$k++){
				if(p_clasic($tee[$k])){
					$global_p++; 
					$left = $global_p * 70;
					echo show_circle($left,572,$tee[$k]);
					$leftline = 45 + $global_p * 35;
					if($global_p%2!=0)
						$rotate = -45;
					else
						$rotate = 45;
					echo show_line($leftline,555,$rotate);
				}elseif($tee[$k]=="!" or $tee[$k]=="&" or $tee[$k]=="|" or $tee[$k]==">" or $tee[$k]=="="){
					$global_s++;
					$leftline = 30 + $global_s * 70;
					echo show_circle($leftline,500,p_check($tee[$k],1));
				}
			}
			*/
		}else
			echo "Nu este o propozitie!";
	}
	function sshow_arbore($v){
		global $global_p;
		global $global_s;
		if(p_exist(p_check($v))){
			$tee = str_split($v);
			for($k=0;$k<strlen($v);$k++){
				if(p_clasic($tee[$k])){
					$global_p++; 
					$left = $global_p * 70;
					echo show_circle($left,572,$tee[$k]);
					$leftline = 45 + $global_p * 35;
					if($global_p%2!=0)
						$rotate = -45;
					else
						$rotate = 45;
					echo show_line($leftline,555,$rotate);
				}elseif($tee[$k]=="!" or $tee[$k]=="&" or $tee[$k]=="|" or $tee[$k]==">" or $tee[$k]=="="){
					$global_s++;
					$leftline = 30 + $global_s * 70;
					echo show_circle($leftline,500,p_check($tee[$k],1));
				}
			}
		}else
			echo "Nu este o propozitie!";
	}
	
?>
