<?php
	session_start();
	/*
	form para . (Recuperado da integridade)
	Rafael Eduardo L - @sudorafa
	Recife, 28 de Setembro de 2016
	*/
	include('../../global/conecta.php');
	include('../../global/libera.php');
	include('../cabecalho.php');
	//include("/controller/ip.php");
	//include('../menu.php');

	$dataInicial 	= date('Y/01/01');
	$dataFinal 		= date('Y/12/31');
	
	$anoVi	= 	date('Y');
?>

<html>
    <head>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="/_css/style.css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=11"/>		
	</head>
	<body>
	<!---------------------------------------------------------------------------------->
	<script language="javascript">
	<!-- chama a função (cadastro) -->
	function valida_dados (form_estatistica_operadores_mes)
	{
		if (form_estatistica_operadores_mes.ano.value=="")
		{
			alert ("Por favor digite o ano.");
			form_estatistica_operadores_mes.ano.focus();
			return false;
		}
	return true;
	}
	</script>
	<!---------------------------------------------------------------------------------->

	<!---------------------------------------------------------------------------------->
	<script language="javascript">
	<!-- chama a função (cadastro) -->
	function valida_dados1 (form_estatistica_operadores_ranking)
	{
		if (form_estatistica_operadores_ranking.data.value=="")
		{
			alert ("Por favor digite a data.");
			form_estatistica_operadores_ranking.data.focus();
			return false;
		}
		if (form_estatistica_operadores_ranking.qtd.value=="")
		{
			alert ("Por favor digite a quantidade.");
			form_estatistica_operadores_ranking.qtd.focus();
			return false;
		}
	return true;
	}
	</script>
	<!---------------------------------------------------------------------------------->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

	<script language="javascript" src="fcampo.js"></script>

	<script type="text/javascript">
		function Formatadata(Campo, teclapres)
		{
			var tecla = teclapres.keyCode;
			var vr = new String(Campo.value);
			vr = vr.replace("/", "");
			vr = vr.replace("/", "");
			vr = vr.replace("/", "");
			tam = vr.length + 1;
			if (tecla != 8 && tecla != 8)
			{
				if (tam > 0 && tam < 2)
					Campo.value = vr.substr(0, 2) ;
				if (tam > 2 && tam < 4)
					Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2);
				if (tam > 4 && tam < 7)
					Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(4, 7);
			}
		}
	</script>
	<!---------------------------------------------------------------------------------->
		<div id="interface">
			<?php include('../menu.php'); ?>
			<div id="Conteudo">
				<div align="center">
					<br/>
					<h1 align="center"> <font color="blue"> Relatorio Operadores </font></h1> 
					<br/><br/>
					<hr width="60%">
					<table cellpadding="0" border="1" width="60%" align="center">
					<tr>
						<form action="form_estatistica_operadores_mes.php" method="post" name="form_estatistica_operadores_mes" align="center" onSubmit="return valida_dados(this)">
						<td	align="center" width="40%"> 
							<br/>	
							<label> <font color="336699">  Listar Recargas de Todos Operadores por Mes: </label> &nbsp;
							<br/> <br/>
							<select size="1" name="mes">
								<option value="01">Janeiro</option>
								<option value="02">Fevereiro</option>
								<option value="03">Marco</option>
								<option value="04">Abril</option>
								<option value="05">Maio</option>
								<option value="06">Junho</option>
								<option value="07">Julho</option>
								<option value="08">Agosto</option>
								<option value="09">Setembro</option>
								<option value="10">Outubro</option>
								<option value="11">Novembro</option>
								<option value="12">Dezembro</option>
							</select> &nbsp; &nbsp;
							
							<label> <font color="336699"> Ano: </label> &nbsp;
							<input name="ano" value="<?php echo $anoVi ?>" type="text" size="4" maxlength="4" onkeyup='if (isNaN(this.value)) {this.value = ""}'> &nbsp;
									
							<input type="submit" name="listar" value="listar"> &nbsp; &nbsp; &nbsp;
							<br/> <br/>
						</td>
						</form>
					</tr>
					</table> 
					
					<hr width="60%">

					<table cellpadding="0" border="1" width="60%" align="center">
					<tr>
						<form action="form_estatistica_operadores_gerais.php" method="post" name="form_estatistica_operadores_gerais" align="center" onSubmit="return valida_dados(this)">
						<td	align="center" width="60%"> 
							<br/>	
							<label> <font color="336699">  Listar Totais Gerais por Operador: </label> &nbsp;
							<br/> <br/>
							<select size="1" name="operador">
							
							<?php
								$idOperadores = mysql_query("select id_operador from recargasrec where data between '$dataInicial' and '$dataFinal' group by id_operador");
								
								while ($dadosOperadores = mysql_fetch_array($idOperadores)){
									
									$idOperador = $dadosOperadores[id_operador];
									$nomeOperador = mysql_fetch_array(mysql_query("select nomeOperador from operadoresrec where numOperador = '$idOperador'"));
							?>
									<option value="<?php echo $idOperador?>"> <?php echo $idOperador . " - " . strtoupper($nomeOperador[nomeOperador]);?></option>
							<?php }?>
									
							</select> &nbsp; &nbsp;
							
							<label> <font color="336699"> Ano: </label> &nbsp;
							<input name="ano" value="<?php echo $anoVi ?>" type="text" size="4" maxlength="4" onkeyup='if (isNaN(this.value)) {this.value = ""}'> &nbsp;
							
							<input type="submit" name="listar" value="listar"> &nbsp; &nbsp; &nbsp;
							<br/> <br/>
						</td>
						</form>
					</tr>
					</table> 

					<hr width="60%">

					<table cellpadding="0" border="1" width="60%" align="center">
					<tr>
						<form action="form_estatistica_operadores_ranking.php" method="post" name="ranking_diario" align="center" onSubmit="return valida_dados1(this)">
						<td	align="center" width="60%"> 
							<br/>	
							<label> <font color="336699">  Gerar Ranking Diario (Top Day): </label> &nbsp;
							<br/> <br/>
							
							<label> <font color="336699">  Data: </label> &nbsp;
							<input type="text" name="data" size="13" maxlength="10" value="<?php echo date(d)-1 . date('/m/Y')?>" onkeyup="Formatadata(this,event)" /> &nbsp; &nbsp; &nbsp;
							
							<input type="submit" name="listar" value="listar"> &nbsp; &nbsp; &nbsp;
							<br/> <br/>
						</td>
						</form>
					</tr>
					</table>
					
					<hr width="60%">
					
				</div>
			<br/><br/>
			<?php 
				include('../../rodape.php');
			?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>