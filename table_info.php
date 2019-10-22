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
			<b>Valoarea de adevar a propozitiilor:</b>
			<hr/>	
			<table width="100%">
				<tr><th> P </th><th> Q </th><th> ¬P </th><th> ¬Q </th><th> P ∧ Q </th><th> P ∨ Q </th><th> P → Q </th><th> P ↔ Q </th></tr>
				<tr><td> F </td><td> F </td><td> A </td><td> A </td><td> F </td><td> F </td><td> A </td><td> A </td></tr>
				<tr><td> F </td><td> A </td><td> A </td><td> F </td><td> F </td><td> A </td><td> A </td><td> F </td></tr>
				<tr><td> A </td><td> F </td><td> F </td><td> A </td><td> F </td><td> A </td><td> F </td><td> F </td></tr>
				<tr><td> A </td><td> A </td><td> F </td><td> F </td><td> A </td><td> A </td><td> A </td><td> A </td></tr>
			</table>
			<b>Inapoi in program <a href="table.php"> Aici </a></b>
		</div>
	</body>
</html>

