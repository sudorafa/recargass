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
	
	$anoVi	= 	date('Y');
?>

<html>
    <head>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="/_css/style.css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=11"/>		
	</head>
	<body onLoad="document.form_meta_ano.ano.focus()"> 
	<!---------------------------------------------------------------------------------->
	<script language="javascript">
	<!-- chama a função (cadastro) -->
	function valida_dados (form_meta_ano)
	{
		if (form_meta_ano.ano.value=="")
		{
			alert ("Por favor digite o ano.");
			form_meta_ano.ano.focus();
			return false;
		}	
	return true;
	}
	</script>
	<!---------------------------------------------------------------------------------->
		<div id="interface">
			<?php include('../menu.php'); ?>
			<div id="Conteudo">
				<div align="center">
					<br/>
					<h1 align="center"> <font color="blue"> Metas Anual </font></h1> 
					<br/>
					<label><a href="form_upar.php " title="Voltar para Atualização Anual "> <img src="/_imagens/btn_voltar.png"></a></label>
					<br/><br/>
					<hr width="30%">
					<table cellpadding="0" border="1" width="80%" align="center">
					<tr>
						<form action="form_meta_ano.php" method="post" name="form_meta_ano" align="center" onSubmit="return valida_dados(this)">
						<td	align="center" width="60%"> 
							<br/>	
							<label> <font color="336699">  Digite o Ano: </label> &nbsp;
							<input name="ano" value="<?php echo $anoVi ?>" type="text" size="4" maxlength="4" onkeyup='if (isNaN(this.value)) {this.value = ""}'> &nbsp;
							
							<input type="submit" name="listar" value="listar"> &nbsp; &nbsp; &nbsp;
							<br/> <br/>
						</td>
						</form>
					</tr>
					</table> 
					<hr width="30%">
						<?php 
							
							$ano 	= $_POST['ano'];
							 
							$consulta = mysql_query("select * from metasrec where ano = $ano");
							$linha = mysql_num_rows($consulta);
					 
							
							
							if(($_POST[ano]) or ($_POST[ano] <> "") or ($_POST[ano] <> 0)){
								
								if($linha == 1)
								{
									//  existe;
									include("form_meta.php");
								}
								else
								{
									// não existe;
									include("form_cad_meta.php");
								}
							}else{
								?><br/><br/><br/><br/><br/><br/><br/><br/><?php
							}
						

						?>
				</div>
			<?php 
				include('../../rodape.php');
			?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>