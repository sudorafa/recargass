<?php
	session_start();
	/*
	form para gerar relatorio anual. (Recuperado da integridade)
	Rafael Eduardo L - @sudorafa
	Recife, 28 de Setembro de 2016
	*/
	include('../../global/conecta.php');
	include('../../global/libera.php');
	include('../cabecalho.php');
	//include("/controller/ip.php");
	//include('../menu.php');
	
	$ano 	=	$_POST["ano"];
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
					<h1 align="center"> <font color="blue"> Estatistica Anual <?php echo $ano ?></font></h1> 
					<br/><br/>
						<?php 
							
							$sql 	= mysql_query("select * from metasrec where ano = '$ano'");
							$dados 	= mysql_fetch_array($sql);
							
							for($i=1;$i<=12;$i++) {
								
							$meses = Array(
								'1' => 'Janeiro',
								'2' => 'Fevereiro',
								'3' => 'Marco',
								'4' => 'Abril',
								'5' => 'Maio',
								'6' => 'Junho',
								'7' => 'Julho',
								'8' => 'Agosto',
								'9' => 'Setembro',
								'10' => 'Outubro',
								'11' => 'Novembro',
								'12' => 'Dezembro',
							);
					
							?>
								<table border="1"cellspacing="1"cellpadding="1" align="center">
								<tr>
									<td  colspan="5" align="center"> <?php echo $meses[$i] . " de " . $ano; ?></td>
								</tr>

								<tr>
									<td class="title" width="10" height="26"> Operadores </td>
									<td class="title" width="10" height="26"> Recargas </td>
									<td class="title" width="70" height="26"> Total </td>
									<td class="title" width="70" height="26"> Meta </td>
									<td class="title" width="70" height="26"> Resto </td>
								</tr>
								<tr>
								<?php
										
									//operadoras com recargas meste mês:
									$qtdOperador 	= mysql_query("select * from recargasrec where data between '$ano-$i-01' and '$ano-$i-31' group by id_operador");
									$linhas 		= mysql_num_rows($qtdOperador);
									$linhasOp 		= $linhas;
									
									//valores gerais
									$resultOperadores = mysql_fetch_array(mysql_query("SELECT sum(valor) as total_valor, count(valor) as qtd_recarga FROM recargasrec WHERE data between '$ano-$i-01' and '$ano-$i-31'"));
									
									//valor total convertido
									$valor = $resultOperadores[total_valor];
									$valorTotal = number_format($valor,2,',','.');
									
									//meta
									if ($i == 1) {
										$meta = $dados[jan];
									} elseif ($i == 2) {
										$meta = $dados[fev];
									} elseif ($i == 3) {
										$meta = $dados[mar];
									} elseif ($i == 4) {
										$meta = $dados[abr];
									} elseif ($i == 5) {
										$meta = $dados[mai];
									} elseif ($i == 6) {
										$meta = $dados[jun];
									} elseif ($i == 7) {
										$meta = $dados[jul];
									} elseif ($i == 8) {
										$meta = $dados[ago];
									} elseif ($i == 9) {
										$meta = $dados[sete];
									} elseif ($i == 10) {
										$meta = $dados[outu];
									} elseif ($i == 11) {
										$meta = $dados[nov];
									} elseif ($i == 12) {
										$meta = $dados[dez];
									}
									$metaFormat = number_format($meta,2,',','.');
									
								?>
									<td class="corpo" height="26" > <?php echo $linhasOp;?> </td>
									<td class="corpo" height="26" > <?php echo $resultOperadores[qtd_recarga]?> </td>
									<td class="corpo" height="26" > <?php echo $valorTotal?> </td>
									<td class="corpo" height="26" > <?php echo $metaFormat?> </td>
								<?php 
									if ($valor > $meta){
										$restoMeta1 = ($valor - $meta);
										$restoMeta = number_format($restoMeta1,2,',','.');
								?>		<td color="ff6600" bgcolor="grem" align="center" height="26" > <?php echo $restoMeta?> </td> <?php
									} elseif ($valor < $meta){
										$restoMeta1 = ($meta - $valor);
										$restoMeta = number_format($restoMeta1,2,',','.');
								?>		<td color="ff6600" bgcolor="red" align="center" height="26" > <?php echo $restoMeta?> </td> <?php
									} else {
								?>		<td color="ff6600" bgcolor="blue" align="center" height="26" > <?php echo $valorTotal?> </td> <?php
									}		
								?>
								</tr>
								<tr>
									<td  colspan="5" align="center">
										<a href="form_mes_detalhado.php?mes=<?php echo $i ?>&ano=<?php echo $ano ?>"><?php echo "Detalhe do Mes de " . $meses[$i]?></a>
									</td>
								</tr>
								</table>
								<br/> <br/>
							<?php
							}
						?>
				</div>
			<br/><br/>
			<?php 
				include('../../rodape.php');
			?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>