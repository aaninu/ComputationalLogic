<?PHP 
	$global_p = 0;
	$global_s = 0;
	// $global_t = 0;
	require('table_function.php'); 
?>
<html>
	<head>
		<title> Logica Propozitiilor </title>
		<style>
			#line{
				width: 45px;
				position: absolute;
				border: 1px solid;
			}
			#cerc{
				border: solid 1px black;
				border-radius: 50%;
				width: 40px;
				height: 20px;
				padding: 10px 0;
				text-align: center;
				position:absolute;
			}
			table {
				border-collapse: collapse;
			}
			table, th, td {
				border: 1px solid black;
			}
			th, td {
				border: 1px solid #ddd;
			}
			tr:hover {background-color: #f5f5f5}
			th {
				padding:5px;
				background-color: #4CAF50;
				color: white;
			}
			tr:nth-child(even) {background-color: #f2f2f2}
			td {
				padding:5px;
				text-align: center;
			}
			.w3-note {
				background-color: #ffffcc;
				border-left: 6px solid #ffeb3b;
			}
			.w3-panel {
				padding: 0.01em 16px;
				margin-top: 16px!important;
				margin-bottom: 16px!important;
			}
			*, *:before, *:after {
				box-sizing: inherit;
			}
			.size{
				width:750px;
				padding:10px;
				border: 1px solid #4CAF50;
			}
			.textarr{
				float:left;
				width:75%;
				height:40px;
				padding:5px;
				resize: none;
				background-color: #f8f8f8;
			}
			.butt{
				float:right;
				height:50px;
				width: 20%;
				background-color: #4CAF50;
				color: white;
				border: none;
				font-size: 18px;
				opacity:1;
			}
			.butt:hover{
				cursor:pointer;
				opacity:0.8;
			}
			.clear{
				clear:both;
			}
		</style>
	</head>
	<body>
		<div class="size">
			<table width="100%">
				<tr><th colspan=5> Program pentru Logica Propozitiilor </th></tr>
				<tr><td> (¬P) </td><td> (P∧Q) </td><td> (P∨Q) </td><td> (P→Q) </td><td> (P↔Q) </td></tr>
				<tr><td> ¬ sau ! </td><td> ∧ sau & </td><td> ∨ sau | </td><td> → sau > </td><td> ↔ sau = </td></tr>
				<tr><td> Negatie </td><td> Conjunctie </td><td> Disjunctie </td><td> Implicatie </td><td> Echivalenta </td></tr>
				<tr><td colspan=2> Caractere permise:</td><td colspan=3> Literele mari de la C la Z si simbolurile mentionate mai sus. </td></tr>
				<tr><td colspan=5>Caracterele A si B au fost rezervate pentru program, acestea avand: A valoarea 1 si B valoarea 0</td></tr>
			</table>
			<hr/>
			<form action="" method="post">
				<textarea class="textarr" name="prop"><?=GPost("prop");?></textarea>
				<input class="butt" type="submit" name="submit" value="Verifica">
			</form>
			<div class="clear"></div>
		</div>
		<?PHP if(GPost("submit")){ echo '<div class="w3-panel w3-note"><p>'; show_message(p_check(GPost("prop"))); echo '</p></div>'; } if(p_exist(p_check(p_check(GPost("prop"))))){	?>
		<div class="size">
			<b>Tabelul de adevar pentru propozitia introdusa:</b>
			<hr/>
			<table width="100%">
				<tr> 
					<?PHP 
						$pr = p_check(GPost("prop"));
						$lista = all_termen(p_check(GPost("prop")));
						$arrlength = count($lista);
						$max = putere($arrlength);
						for($x = 0; $x < $arrlength; $x++) { ?> <th> <?=$lista[$x];?>  </th> <?PHP } ?>
					<?PHP show_replace($pr); ?>
					<th> <?=p_check(GPost("prop"),1);?> </th>
				</tr>
				<?PHP
				$val_adv = generate_true($arrlength);
				for($tr = 1; $tr <= $max; $tr++){ ?>
				<tr> 
					<?PHP for($td = 0; $td < $arrlength; $td++){ ?>
						<td><?PHP echo $val_adv[$tr][$td]; ?> </td>
					<?PHP } ?>
					<?PHP show_replace_with($pr,$tr); ?>
						<th> <?PHP echo calc_true($pr,$tr); ?> </th>
				</tr>
				<?PHP } ?>
			</table>
		</div>
		<hr/>	
		<div class="size">
			<b>Valorile standard de adevar: <a href="table_info.php"> Aici </a></b>
		</div>
		<?PHP } ?>
	</body>
</html>

