<?PHP 
	$global_p = 0;
	$global_s = 0;
	require('graphs_function.php'); 
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
				height:500px;
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
			<b>Program pentru Logica Propozitiilor:</b>
			<hr/>
			<table width="100%">
				<tr><th>Exemplu</th><th> Notatia Logica </th><th> Notatie in program </th><th> Reprezentare </th></tr>
				<tr><td>(¬A)</td><td> ¬ </td><td>!</td><td> Folosit pentru negatie </td></tr>
				<tr><td>(A∧B)</td><td> ∧ </td><td> & </td><td> Folosit pentru conjunctie </td></tr>
				<tr><td>(A∨B)</td><td> ∨ </td><td>|</td><td> Folosit pentru disjunctie </td></tr>
				<tr><td>(A→B)</td><td> → </td><td>></td><td> Folosit pentru implicatie </td></tr>
				<tr><td>(A↔B)</td><td> ↔ </td><td>=</td><td> Folosit pentru echivalenta </td></tr>
				<tr><td>A</td><td colspan=3> Este o propozitie (o afirmatie simpla) </td></tr>
				<tr><td colspan=2> Caractere permise:</td><td colspan=2> Literele mari de la A la Z si simbolurile mentionate mai sus. </td></tr>
				<tr><td colspan=2> Exemplu:</td><td colspan=2>((!(P>Q))&((!P)|R))</td></tr>
				<tr><td colspan=2> Exemplu:</td><td colspan=2>(((((((!(!(!(!(!(!(!(!(!(!(!(!A))))))))))))&A)&A)&A)&A)&A)&A)</td></tr>
			</table>
			<hr/>
			<form action="" method="post">
				<textarea class="textarr" name="prop"><?=GPost("prop");?></textarea>
				<input class="butt" type="submit" name="submit" value="Verifica">
			</form>
			<div class="clear"></div>
		</div>
		<?PHP if(GPost("submit")){ echo '<div class="w3-panel w3-note"><p>'; show_arbore(p_check(GPost("prop"))); echo '</p></div>'; } ?>
	</body>
</html>

