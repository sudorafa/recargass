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
	
	$perfil = $_SESSION["perfil"];
?>

<html>
    <head>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="/_css/style.css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=11"/>		
	</head>
	<body> 
	<script type="text/javascript">
        $(document).ready(function($){
          $(function(){
              $('.mask-data').mask('99/99/9999');
          });
        })
	</script>
		<div id="interface">
			<?php include('../menu.php'); ?>
			<div id="Conteudo">
				<div align="center">
					<br/>
					<h1 align="center"> <font color="blue"> Gerenciamento do Sistema </font></h1> 
					<br/><br/>
					<hr width="90%">
					<br/>
					<?php if ($perfil == "GERENCIA" or $perfil == "CADASTRO" or $perfil == "F. CAIXA" or $perfil == "CPD"){ ?>
						<table cellpadding="0" border="0" width="80%" align="center">
						<tr align="center">
						<td>
						<form action="../controller/query_sitef.php"  name="upar_sitef" method="post" enctype="multipart/form-data">
							<fieldset><legend align="center">Importar csv do sitef</legend>
								<input class="arq" type="file" name="arq_csv" /> &nbsp; &nbsp;
								<!--
								<label class="lbl">Informe a Data do Movimento: </label> &nbsp;
								<input type="text" name="data"  size=10 maxlength=10 class="mask-data" />
								-->
								<input type="submit" value="Importar para o BD"/>
								<br/>
							</fieldset>
						</form>
						</td>
						</tr>
						</table>
						<br/>
						<hr width="90%">
						<br/><br/>
					<?php } ?>
					<?php if ($perfil == "CPD"){ ?>
						<table cellpadding="0" border="0" width="80%" align="center">
						<tr align="center">
						<td>
						<form action="../controller/query_operadores.php"  name="upar_operadores" method="post" enctype="multipart/form-data">
							<fieldset><legend align="center">Atualizar Operadores</legend>
								<input class="arq" type="file" name="arq_txt" /> &nbsp; &nbsp;
								<input type="submit" value="Importar para o BD"/>
								<br/>
							</fieldset>
						</form>
						</td>
						</tr>
						</table>
						<br/>
						<hr width="90%">
						<br/><br/>
					<?php } ?>
					<?php if ($perfil == "CPD" or $perfil == "F. CAIXA"){ ?>
						<table cellpadding="0" border="0" width="80%" align="center">
						<tr align="center">
						<td>
						<form action="form_meta_ano.php"  name="meta" method="post" enctype="multipart/form-data">
							<fieldset><legend align="center">Gerenciar Meta do Mes</legend>
								<input type="submit" value="metas"/>
								<br/>
							</fieldset>
						</form>
						</td>
						</tr>
						</table>
						</br>
						<hr width="90%">
						<br/><br/>
					<?php } ?>
					<br/>
				</div>
				<br/><br/><br/><br/>
			<?php 
				include('../../rodape.php');
			?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>