<?php
	session_start();
	/*
	form para gerar relatorios. (Recuperado da integridade)
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
	<body onLoad="document.form_estatistica_anual.ano.focus()"> 
	<!---------------------------------------------------------------------------------->
	<script language="javascript">
	<!-- chama a função (cadastro) -->
	function valida_dados (form_estatistica_anual)
	{
		if (form_estatistica_anual.ano.value=="")
		{
			alert ("Por favor digite o ano.");
			form_estatistica_anual.ano.focus();
			return false;
		}	
	return true;
	}
	</script>
	<!---------------------------------------------------------------------------------->
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
					<h1 align="center"> <font color="blue"> Estatistica Anual </font></h1> 
					<br/><br/>
					<hr width="40%">
					<br/>
					<table cellpadding="0" border="1" width="80%" align="center">
					<tr>
						<form action="form_estatistica_anual.php" method="post" name="form_estatistica_anual" align="center" onSubmit="return valida_dados(this)">
						<td	align="center" width="60%"> 
							<label> <font color="336699">  Digite o Ano: </label> &nbsp;
							<input name="ano" value="<?php echo $anoVi ?>" type="text" size="4" maxlength="4" onkeyup='if (isNaN(this.value)) {this.value = ""}'> &nbsp;
							
							<input type="submit" name="listar" value="listar"> &nbsp; &nbsp; &nbsp;
							<br/> <br/>
						</td>
						</form>
					</tr>
					</table> 
					<hr width="40%">
				</div>
			<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			<?php 
				include('../../rodape.php');
			?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>