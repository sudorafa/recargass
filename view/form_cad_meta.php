<?php
	session_start();
	/*
	form para . (Recuperado da integridade)
	Rafael Eduardo L - @sudorafa
	Recife, 28 de Setembro de 2016
	*/
	include('../../global/conecta.php');
	include('../../global/libera.php');
	//include("/controller/ip.php");
	//include('../menu.php');
	
	$ano = $_POST["ano"];
?>

<html>
    <head>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="/_css/style.css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=11"/>		
	</head>
	<body onLoad="document.cadastro.nome.focus()"> 
	<!---------------------------------------------------------------------------------->
	<script type="text/javascript">
		function FormataValor(Campo, teclapres)
		{
			var tecla = teclapres.keyCode;
			var vr = new String(Campo.value);
			vr = vr.replace(".", "");
			vr = vr.replace(".", "");
			tam = vr.length + 1;
			if (tecla != 8 && tecla != 8)
			{
				if (tam > 0 && tam < 2)
					Campo.value = vr.substr(0, 2) ;
				if (tam > 2 && tam < 4)
					Campo.value = vr.substr(0, 3) + '.' + vr.substr(2, 3);
			}
		}
	</script>
	<!---------------------------------------------------------------------------------->
		<br/><br/>
		<div id="interface">
			<div id="Conteudo">
				<div align="center">
					<br/>
					<h1 align="center"> <font color="blue"> Cadastrar Metas do Ano <?php echo $ano ?> </font></h1> 
					<br/><br/>
					<hr width="80%">
					<table cellpadding="0" border="1" width="80%" align="center">

					<tr>
					<form action="../controller/query_cad_meta.php" method="post" name="meta">
						
						<tr> 
							<td	align="center">
							</br> </br>
							
								<label> <font color="336699"> Jan: </label> &nbsp;
								<input type="text"  name="jan" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							&nbsp; &nbsp; &nbsp;
								<label> <font color="336699"> Fev: </label> &nbsp;
								<input type="text"  name="fev" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							&nbsp; &nbsp; &nbsp;	
								<label> <font color="336699"> Mar: </label> &nbsp;
								<input type="text" name="mar" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							&nbsp; &nbsp; &nbsp;
								<label> <font color="336699"> Abr: </label> &nbsp;
								<input type="text" name="abr" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							
							</br> </br>
							
								<label> <font color="336699"> Mai: </label> &nbsp;
								<input type="text" name="mai" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							&nbsp; &nbsp; &nbsp;
								<label> <font color="336699"> Jun: </label> &nbsp;
								<input type="text" name="jun" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							&nbsp; &nbsp; &nbsp; &nbsp;
								<label> <font color="336699"> Jul: </label> &nbsp;
								<input type="text" name="jul" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							&nbsp; &nbsp; &nbsp;
								<label> <font color="336699"> Ago: </label> &nbsp;
								<input type="text" name="ago" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							
							</br> </br>
							&nbsp;
								<label> <font color="336699"> Set: </label> &nbsp;
								<input type="text" name="sete" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							&nbsp; &nbsp; &nbsp;
								<label> <font color="336699"> Out: </label> &nbsp;
								<input type="text" name="outu" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							&nbsp; &nbsp; &nbsp;	
								<label> <font color="336699"> Nov: </label> &nbsp;
								<input type="text" name="nov" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							&nbsp; &nbsp; &nbsp;
								<label> <font color="336699"> Dez: </label> &nbsp;
								<input type="text" name="dez" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
							<input type="hidden" name="ano" value="<?php echo $ano ?>" >
								
							</br> </br> </br>
							
							<table cellpadding="0" border="0" width="20%" align="center">
							<tr align="center">
								<td align="center"> 
									<input align="center" type="submit" name="salvar" value="salvar"> 
								</td>
					</form>
							</tr>
							</table>
							<br>
					</td>
					</tr>
				</table> 
				<hr width="80%">
				<br/><br/>
				</div>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>