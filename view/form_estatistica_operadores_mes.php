<?php
	session_start();
	/*
	form com estatistica de quantidades, totais e metas anual os operadores. (Recuperado da integridade)
	Rafael Eduardo L - @sudorafa
	Recife, 28 de Setembro de 2016
	*/
	include('../../global/conecta.php');
	include('../../global/libera.php');
	include('../cabecalho.php');
	//include("/controller/ip.php");
	//include('../menu.php');
	
	$mesParaBuscar	= 	$_POST["mes"];
	$mes = $mesParaBuscar;
	
	//$anoParaBuscar	= 	date('Y');
	$anoParaBuscar	= 	$_POST["ano"];
	$ano = $anoParaBuscar;
	
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
		'11' => 'Novembro',
		'12' => 'Dezembro',
	);
	
	$mesArr = $meses[$mes];
	
	$dataInicial	=	$ano."-".$mes."-01";
	$dataFinal		=	$ano."-".$mes."-31";
	
	//operadoras com recargas meste mês:
	$operadoresUp 	= mysql_query("select id_operador, sum(valor) as total, count(valor) as qtd_recarga from recargasrec where data between '$dataInicial' and '$dataFinal' group by id_operador order by total desc, qtd_recarga desc");
	//$operadoresUp 	= mysql_query("select id_operador, sum(valor) as total from recargasrec where data between '$dataInicial' and '$dataFinal' group by id_operador order by total desc");
	
	//linhas operadorUp
	$linhasUp 		= mysql_num_rows($operadoresUp);
	$uso_movUp 		= $linhasUp;	
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
					<h1 align="center"> <font color="blue"> Recargas Mes de <?php echo $mesArr . " de " . $ano?> </font></h1> 
					<br/>
					<label><a href="form_estatistica_operadores.php " title="Voltar para Estatisticas de Operadores"> <img src="/_imagens/btn_voltar.png"></a></label>
					<br/><br/>
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
						<td class="title" height="26"> Percentual "Mes" </td>
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
								
								//valor total de recargas no meses
								$dadosTotalMes = mysql_fetch_array(mysql_query("SELECT sum(valor) as total_valor FROM recargasrec WHERE data between '$dataInicial' and '$dataFinal'"));
								$totalMes = $dadosTotalMes[total_valor];
								
								//percentual
								$percentual = ($valorUp * 100) / $totalMes;
								
								//percentual convertido
								$percentualConvertido = number_format($percentual,2,',','.');
								
						?>
						<tr>
							<td class="corpo" height="26" > <?php echo $posicaoUp.'';?> </td>
							<td class="corpo" height="26" > <?php echo $operadorUp?> </td>
							<td class="corpo" height="26" > <?php echo strtoupper($nomeOperadorUp[nomeOperador])?> </td>
							<td class="corpo" height="26" > <?php echo $resultOperadoresUp[qtd_recarga]?> </td>
							<td class="corpo" height="26" > <?php echo $valorTotalUp?> </td>
							<td class="corpo" height="26" > <?php echo $percentualConvertido?> %</td>
						<?php };?>
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