<?php
	session_start();
	/*
	form com ranking diario gerados (Recuperado da integridade)
	Rafael Eduardo L - @sudorafa
	Recife, 28 de Setembro de 2016
	*/
	include('../../global/conecta.php');
	include('../../global/libera.php');
	include('../cabecalho.php');
	//include("/controller/ip.php");
	//include('../menu.php');
	
	$data0	= 	$_POST["data"];
	$qtd	= 	999;
	
	$data	= str_replace('-','/',$data0);
	$data 	= explode("/", $data);
	$data1 	= $data[2] . "-" . $data[1] . "-" . $data[0];
	
		
	$dataInicial 	= $data1;
	$dataFinal 		= $data1;
	
	$mesAno	= $data[2] . "-" . $data[1] . "-";
	
	
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
	
	//operadoras com recargas meste dia:
	$operadoresUp 	= mysql_query("select id_operador, sum(valor) as total, count(valor) as qtd_recarga from recargasrec where data between '$dataInicial' and '$dataFinal' group by id_operador order by total desc, qtd_recarga desc limit $qtd");
	$operadoresDown = mysql_query("select id_operador, sum(valor) as total, count(valor) as qtd_recarga from recargasrec where data between '$dataInicial' and '$dataFinal' group by id_operador order by total asc, qtd_recarga asc limit $qtd");
	//$operadoresUp 	= mysql_query("select id_operador, sum(valor) as total from recargasrec where data between '$dataInicial' and '$dataFinal' group by id_operador order by total desc limit $qtd");
	//$operadoresDown = mysql_query("select id_operador, sum(valor) as total from recargasrec where data between '$dataInicial' and '$dataFinal' group by id_operador order by total asc limit $qtd");
	
	//linhas operadorUp
	$linhasUp 		= mysql_num_rows($operadoresUp);
	$uso_movUp 		= $linhasUp;
	
	//linhas operadorDown
	$linhasDown 	= mysql_num_rows($operadoresDown);
	$uso_movDown 	= $linhasDown;
	
	//valor total de recargas no meses
	$dadosTotalMes = mysql_fetch_array(mysql_query("SELECT sum(valor) as total_valor FROM recargasrec WHERE data between '$mesAno-01' and '$mesAno-31'"));
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
			<?php include('../menu.php'); ?>
			<div id="Conteudo">
				<div align="center">
					<br/>
					<h1 align="center"> <font color="blue"> Top Day - Ranking de <?php echo $data0; ?> </font></h1> 
					<br/>
					<label><a href="form_estatistica_operadores.php " title="Voltar para Estatisticas de Operadores"> <img src="/_imagens/btn_voltar.png"></a></label>
					<label><a href="form_estatistica_operadores_ranking_print.php?data=<?php echo $data0 ?>" title="Imprimir" target="_blank"> <img src="/_imagens/btn_imprimir.png"></a></label>
					<br/><br/>
					<table cellpadding="0" border="1" width="80%" height="26" align="center">
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
						<td class="title" height="26"> Valor Dia </td>
						<td class="title" height="26"> Valor Mês </td>
						<td class="title" height="26"> Percentual "Mes"</td>
					</tr height="26">
						<?php
							while ($dadosOperadoresUp = mysql_fetch_array($operadoresUp)){
								
								$operadorUp = $dadosOperadoresUp[id_operador];
								
								//resultados
								$resultOperadoresUp = mysql_fetch_array(mysql_query("SELECT id_operador, sum(valor) as total_valor, count(valor) as qtd_recarga FROM recargasrec WHERE id_operador = '$operadorUp' and data between '$dataInicial' and '$dataFinal'"));
								
								//Valor Mês
								$resultValorMesOper = mysql_fetch_array(mysql_query("SELECT sum(valor) as totalMesOper FROM recargasrec WHERE id_operador = '$operadorUp' and data between '$mesAno-01' and '$mesAno-31'"));
								
								//nomeOperadores
								$nomeOperadorUp = mysql_fetch_array(mysql_query("select nomeOperador from operadoresrec where numOperador = '$operadorUp'"));
								
								$posicaoUp++;
								
								//valor Dia
								$valorUp = $resultOperadoresUp[total_valor];
								$valorTotalUp = number_format($valorUp,2,',','.');
								
								//valor Mês
								$totalMesOper1 = $resultValorMesOper[totalMesOper];
								$totalMesOper = number_format($totalMesOper1,2,',','.');
								
								//percentual
								$percentualUp = ($totalMesOper1 * 100) / $totalMes;
								
								//percentual convertido
								$percentualConvertidoUp = number_format($percentualUp,2,',','.');
						?>
						<tr>
							<td class="corpo" height="26" > <?php echo $posicaoUp.'';?> </td>
							<td class="corpo" height="26" > <?php echo $operadorUp?> </td>
							<td class="corpo" height="26" > <?php echo strtoupper($nomeOperadorUp[nomeOperador])?> </td>
							<td class="corpo" height="26" > <?php echo $resultOperadoresUp[qtd_recarga]?> </td>
							<td class="corpo" height="26" > <?php echo $valorTotalUp?> </td>
							<td class="corpo" height="26" > <?php echo $totalMesOper?> </td>
							<td class="corpo" height="26" > <?php echo $percentualConvertidoUp?> % </td>
						<?php };
							//operadoras com recargas meste mês
							$operadoresUpMes 	= mysql_query("select id_operador, sum(valor) as total, count(valor) as qtd_recarga from recargasrec where data between '$mesAno-01' and '$mesAno-31' group by id_operador order by total desc, qtd_recarga desc limit $qtd");
							
							while ($dadosOperadoresUpMes = mysql_fetch_array($operadoresUpMes)){
									
								$operadorUp = $dadosOperadoresUpMes[id_operador];
								
								//resultados
								$resultOperadoresUp = mysql_fetch_array(mysql_query("SELECT id_operador, sum(valor) as total_valor, count(valor) as qtd_recarga FROM recargasrec WHERE id_operador = '$operadorUp' and data between '$dataInicial' and '$dataFinal'"));
								
								//Valor Mês
								$resultValorMesOper = mysql_fetch_array(mysql_query("SELECT sum(valor) as totalMesOper FROM recargasrec WHERE id_operador = '$operadorUp' and data between '$mesAno-01' and '$mesAno-31'"));
								
								//nomeOperadores
								$nomeOperadorUp = mysql_fetch_array(mysql_query("select nomeOperador from operadoresrec where numOperador = '$operadorUp'"));
								
								//valor Dia
								$valorUp = $dadosOperadoresUpMes[total_valor];
								$valorTotalUp = number_format($valorUp,2,',','.');
								
								//valor Mês
								$totalMesOper1 = $resultValorMesOper[totalMesOper];
								$totalMesOper = number_format($totalMesOper1,2,',','.');
								
								//percentual
								$percentualUp = ($totalMesOper1 * 100) / $totalMes;
								
								//percentual convertido
								$percentualConvertidoUp = number_format($percentualUp,2,',','.');
							
								if ($resultOperadoresUp[qtd_recarga] == 0) { $posicaoUp++; ?>
									<tr>
									<td class="corpo" height="26" > <?php echo $posicaoUp.'';?> </td>
									<td class="corpo" height="26" > <?php echo $operadorUp?> </td>
									<td class="corpo" height="26" > <?php echo strtoupper($nomeOperadorUp[nomeOperador])?> </td>
									<td class="corpo" height="26" > <?php echo $resultOperadoresUp[qtd_recarga]?> </td>
									<td class="corpo" height="26" > <?php echo $valorTotalUp?> </td>
									<td class="corpo" height="26" > <?php echo $totalMesOper?> </td>
									<td class="corpo" height="26" > <?php echo $percentualConvertidoUp?> % </td>
								<?php
								} 
							}
						?>
						</tr>
					<?php } ?>
					</tr>
					</table>

				</div>
			<br/><br/>
			<?php
				include('../../rodape.php');
			?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>