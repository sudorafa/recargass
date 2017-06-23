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

	$dia	= $_GET[dia];
	$mes	= $_GET[mes];
	$ano 	= $_GET[ano];
?>

<html>
    <head>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="/_css/style.css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=11"/>		
	</head>
	<body> 
		<div id="interface">
			<?php include('../menu.php'); ?>
			<div id="Conteudo">
				<div align="center">
					<br/>
					<h1 align="center"> <font color="blue"> Grafico Recargas Por Horario Data <?php echo $dia.'/'.$mes.'/'.$ano ?> </font></h1> 
					<br/><br/>
					<table cellpadding="0" border="0" width="30%" align="center">
					<tr>
						<td width="70%" align="right" >
							<img src="../grafico/<?php echo $ano?>/<?php echo $mes?>/<?php echo $dia?>.png" />
						</td>
					</tr>
					</table>
				</div>
			<br/><br/><br/><br/><br/>
			<?php 
				include('../../rodape.php');
			?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>