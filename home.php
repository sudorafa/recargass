<?php
	session_start();
	/*
	Form Home do sistema Recargas (Recuperado da integridade)
	//form com os top 20 no HOME.
	Rafael Eduardo L - @sudorafa
	Recife, 28 de Setembro de 2016
	*/
	include('../global/libera.php');
	include('cabecalho.php');
	//include("/controller/ip.php");
	//include('../menu.php');
	
	$meses = Array(
		'01' => 'Janeiro',
		'02' => 'Fevereiro',
		'03' => 'Marco',
		'04' => 'Abril',
		'05' => 'Maio',
		'06' => 'Junho',
		'07' => 'Julho',
		'08' => 'Agosto',
		'09' => 'Setembro',
		'10' => 'Outubro',
		'12' => 'Novembro',
		'11' => 'Dezembro',
	);
	
	$dataInicial 	= date('Y/m/01');
	$dataFinal 		= date('Y/m/31');
	
	//operadoras com recargas meste mês:
	$operadoresUp 	= mysql_query("select id_operador, sum(valor) as total, count(valor) as qtd_recarga from recargasrec where data between '$dataInicial' and '$dataFinal' group by id_operador order by total desc, qtd_recarga desc limit 20");
	$operadoresDown = mysql_query("select id_operador, sum(valor) as total, count(valor) as qtd_recarga from recargasrec where data between '$dataInicial' and '$dataFinal' group by id_operador order by total asc, qtd_recarga asc limit 20");
	
	//linhas operadorUp
	$linhasUp 		= mysql_num_rows($operadoresUp);
	$uso_movUp 		= $linhasUp;
	
	//linhas operadorDown
	$linhasDown 	= mysql_num_rows($operadoresDown);
	$uso_movDown 	= $linhasDown;
	
	//valor total de recargas no meses
	$dadosTotalMes = mysql_fetch_array(mysql_query("SELECT sum(valor) as total_valor FROM recargasrec WHERE data between '$dataInicial' and '$dataFinal'"));
	$totalMes = $dadosTotalMes[total_valor];
?>

<html>
    <head>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="/_css/style.css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=11"/>		
	</head>
	<body> 
		<div id="interface">
			<?php include('menu.php'); ?>
			<div id="Conteudo">
				<div align="center">
					<br/>
					<h1 align="center"> <font color="blue"> Top UP <?php echo $meses[date('m')]; ?> </font></h1> 
					<br/>
					<table cellpadding="0" border="1" width="70%" height="26" align="center">
					<tr height="26">
						<?php 
						if ($uso_movUp == 0) { ?>
							<td class="title" height="26"> NADA PARA EXIBIR </td>
						<?php }
						else { ?>
						<td class="title" height="26"> Posicao </td>
						<td class="title" height="26"> Operador </td>
						<td class="title" height="26"> Nome Operador </td>
						<td class="title" height="26"> Quant Recargas </td>
						<td class="title" height="26"> Valor Total </td>
						<td class="title" height="26"> Percentual  "Mes" </td>
					</tr height="26">
						<?php
							while ($dadosOperadoresUp = mysql_fetch_array($operadoresUp)){
								
								$operadorUp = $dadosOperadoresUp[id_operador];
								
								//resultados
								$resultOperadoresUp = mysql_fetch_array(mysql_query("SELECT id_operador, sum(valor) as total_valor, count(valor) as qtd_recarga FROM recargasrec WHERE id_operador = '$operadorUp' and data between '$dataInicial' and '$dataFinal'"));
								
								//nomeOperadores
								$nomeOperadorUp = mysql_fetch_array(mysql_query("select nomeOperador from operadoresrec where numOperador = '$operadorUp'"));
								
								$posicaoUp++;
								
								$valorUp = $resultOperadoresUp[total_valor];
								$valorTotalUp = number_format($valorUp,2,',','.');
								
								//percentual
								$percentualUp = ($valorUp * 100) / $totalMes;
								
								//percentual convertido
								$percentualConvertidoUp = number_format($percentualUp,2,',','.');
						?>
						<tr>
							<td class="corpo" height="26" > <?php echo $posicaoUp.'';?> </td>
							<td class="corpo" height="26" > <?php echo $operadorUp?> </td>
							<td class="corpo" height="26" > <?php echo strtoupper($nomeOperadorUp[nomeOperador])?> </td>
							<td class="corpo" height="26" > <?php echo $resultOperadoresUp[qtd_recarga]?> </td>
							<td class="corpo" height="26" > <?php echo $valorTotalUp?> </td>
							<td class="corpo" height="26" > <?php echo $percentualConvertidoUp?> % </td>
						<?php };?>
						</tr>
					<?php } ?>
					</tr>
					</table>

					<br/> <br/>

					<h1 align="center"> <font color="red"> Top Down <?php echo $meses[date('m')]; ?> </font></h1> 
					<br/>
					
					<table cellpadding="0" border="1" width="70%" height="26" align="center">
					<tr height="26">
						<?php 
						if ($uso_movDown == 0) { ?>
							<td class="title" height="26"> NADA PARA EXIBIR </td>
						<?php }
						else { ?>
						<td class="title" height="26"> Posicao </td>
						<td class="title" height="26"> Operador </td>
						<td class="title" height="26"> Nome Operador </td>
						<td class="title" height="26"> Quant Recargas </td>
						<td class="title" height="26"> Valor Total </td>
						<td class="title" height="26"> Percentual "Mes" </td>
					</tr height="26">
						<?php
							while ($dadosOperadoresDown = mysql_fetch_array($operadoresDown)){
								
								$operadorDown = $dadosOperadoresDown[id_operador];
								
								//resultados
								$resultOperadoresDown = mysql_fetch_array(mysql_query("SELECT id_operador, sum(valor) as total_valor, count(valor) as qtd_recarga FROM recargasrec WHERE id_operador = '$operadorDown' and data between '$dataInicial' and '$dataFinal'"));
								
								//nomeOperadores
								$nomeOperadorDown = mysql_fetch_array(mysql_query("select nomeOperador from operadoresrec where numOperador = '$operadorDown'"));
								
								$i++;
								$posicaoDown=21-$i;
								
								$valorDown = $resultOperadoresDown[total_valor];
								$valorTotalDown = number_format($valorDown,2,',','.');
								
								//percentual
								$percentualDown = ($valorDown * 100) / $totalMes;
								
								//percentual convertido
								$percentualConvertidoDown = number_format($percentualDown,2,',','.');
								
						?>
						<tr>
							<td class="corpo" height="26" > <?php echo $posicaoDown.'';?> </td>
							<td class="corpo" height="26" > <?php echo $operadorDown?> </td>
							<td class="corpo" height="26" > <?php echo strtoupper($nomeOperadorDown[nomeOperador])?> </td>
							<td class="corpo" height="26" > <?php echo $resultOperadoresDown[qtd_recarga]?> </td>
							<td class="corpo" height="26" > <?php echo $valorTotalDown?> </td>
							<td class="corpo" height="26" > <?php echo $percentualConvertidoDown?> % </td>
						<?php };?>
						</tr>
					<?php } ?>
					</tr>
					</table>
				</div>
			<br/><br/>
			<?php 
				include('../rodape.php');
			?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>