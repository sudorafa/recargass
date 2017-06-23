<?php
	session_start();
	/*
	form para gerar relatorios do mes detalhado. (Recuperado da integridade)
	Rafael Eduardo L - @sudorafa
	Recife, 28 de Setembro de 2016
	*/
	include('../../global/conecta.php');
	include('../../global/libera.php');
	include('../cabecalho.php');
	//include("/controller/ip.php");
	//include('../menu.php');
	
	$ano		= $_GET[ano];
	$mes		= $_GET[mes];
	//$ano = 2016;
	
	/*
	$att = mysql_query("select * from recargasrec order by id desc limit 1");
	$dadosAtt = mysql_fetch_array($att);
	
	$dataAtt = $dadosAtt[data];
	$horaAtt = $dadosAtt[horaAdd];
	
	$dataAtt = explode("-", $dataAtt);
	$dataAtt = $dataAtt[2] . "/" . $dataAtt[1] . "/" . $dataAtt[0];
	*/
		
	//recargas neste mes:
	$resultRecargas = mysql_query("select * from recargasrec WHERE data between '$ano-$mes-01' and '$ano-$mes-31'");
	$linhas_mov_coletores = mysql_num_rows($resultRecargas);
	$uso_mov = $linhas_mov_coletores;
	
	//meta mes
	$sql 	= mysql_query("select * from metasrec where ano = '$ano'");
	$dadosMeta 	= mysql_fetch_array($sql);
	
	//valores gerais neste mes:
	$resultOperadores = mysql_fetch_array(mysql_query("SELECT sum(valor) as total_valor, count(valor) as qtd_recarga FROM recargasrec WHERE data between '$ano-$mes-01' and '$ano-$mes-31'"));
	
	//valor total convertido neste mes:
	$valor = $resultOperadores[total_valor];
	$valorTotal = number_format($valor,2,',','.');
		
		
	if ($mes == 1) {
		$meta = $dadosMeta[jan];
		$dias=31;
		$nomeMes="Janeiro";
	} elseif ($mes == 2) {
		$meta = $dadosMeta[fev];
		$dias=28;
		$nomeMes="Fevereiro";
	} elseif ($mes == 3) {
		$meta = $dadosMeta[mar];
		$dias=31;
		$nomeMes="Marco";
	} elseif ($mes == 4) {
		$meta = $dadosMeta[abr];
		$dias=30;
		$nomeMes="Abril";
	} elseif ($mes == 5) {
		$meta = $dadosMeta[mai];
		$dias=31;
		$nomeMes="Maio";
	} elseif ($mes == 6) {
		$meta = $dadosMeta[jun];
		$dias=30;
		$nomeMes="Junho";
	} elseif ($mes == 7) {
		$meta = $dadosMeta[jul];
		$dias=31;
		$nomeMes="Julho";
	} elseif ($mes == 8) {
		$meta = $dadosMeta[ago];
		$dias=31;
		$nomeMes="Agosto";
	} elseif ($mes == 9) {
		$meta = $dadosMeta[sete];
		$dias=30;
		$nomeMes="Setembro";
	} elseif ($mes == 10) {
		$meta = $dadosMeta[outu];
		$dias=31;
		$nomeMes="Outubro";
	} elseif ($mes == 11) {
		$meta = $dadosMeta[nov];
		$dias=30;
		$nomeMes="Novembro";
	} elseif ($mes == 12) {
		$meta = $dadosMeta[dez];
		$dias=31;
		$nomeMes="Dezembro";
	}
	$metaFormat = number_format($meta,2,',','.');
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
					<h1 align="center"> <font color="blue"> <?php echo $nomeMes . " de " . $ano . " - Detalhado"?> </font></h1>
					<br/><br/>
					<label><a href="form_estatistica_anual_ano.php " title="Voltar para Estatistica Anual"> <img src="/_imagens/btn_voltar.png"></a></label>
					<br/><br/>
					<table cellpadding="0" border="1" width="60%" align="center">
					<tr height="26">
						<?php 
						if ($uso_mov == 0) { ?>
							<td class="title" height="26"> NADA PARA EXIBIR </td>
						<?php }
						else { ?>
						<td class="title" height="26"> Operadores </td>
						<td class="title" height="26"> Recargas </td>
						<td class="title" height="26"> Total </td>
						<td class="title" height="26"> Meta </td>
						<td class="title" height="26"> Resto </td>
					</tr height="26">
						<?php
								
							//operadoras com recargas meste mês:
							$qtdOperador 	= mysql_query("select * from recargasrec where data between '$ano-$mes-01' and '$ano-$mes-31' group by id_operador");
							$linhas 		= mysql_num_rows($qtdOperador);
							$linhasOp 		= $linhas;
							
							//valores gerais
							$resultOperadores = mysql_fetch_array(mysql_query("SELECT sum(valor) as total_valor, count(valor) as qtd_recarga FROM recargasrec WHERE data between '$ano-$mes-01' and '$ano-$mes-31'"));
							
							//valor total convertido
							$valor = $resultOperadores[total_valor];
							$valorTotal = number_format($valor,2,',','.');
								
						?>

						<tr>
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
							
							<?php };?>
						</tr>
					</tr>
					</table>
					

				<br/> <br/>

					<table cellpadding="0" border="1" width="60%" align="center">
					<tr height="26">
						<?php 
						if ($uso_mov == 0) { ?>
							<td class="title" height="26"> NADA PARA EXIBIR </td>
						<?php }
						else { ?>
						<td class="title" height="26"> Dia </td>
						<td class="title" height="26"> Operadores </td>
						<td class="title" height="26"> Recargas </td>
						<td class="title" height="26"> Total</td>
						<td class="title" height="26"> Restante</td>
						<td class="title" height="26"> Meta </td>
						<!--<td class="title" height="26"> Resto </td>-->
					</tr height="26">
						<?php
							for($i=1;$i<=$dias;$i++) {
								
								//qtd operadoras com recargas neste dia:
								$qtdOperador 	= mysql_query("select * from recargasrec where data between '$ano-$mes-$i' and '$ano-$mes-$i' group by id_operador");
								$linhas 		= mysql_num_rows($qtdOperador);
								$linhasOp 		= $linhas;
								
								//valores gerais neste dia:
								$resultOperadores = mysql_fetch_array(mysql_query("SELECT sum(valor) as total_valor, count(valor) as qtd_recarga FROM recargasrec WHERE data between '$ano-$mes-$i' and '$ano-$mes-$i'"));
								
								//valor total convertido neste dia:
								$valorDia = $resultOperadores[total_valor];
								$valorTotalDia = number_format($valorDia,2,',','.');
								
								if ($i == 1){
									$restoMeta = ($meta - $valorDia);
									//Meta sugestiva para o dia
									$MetaDia = ($meta / $dias);
								} else {
									$restoMetaGuardar = $restoMeta;
									$restoMeta = ($restoMeta - $valorDia);
									$diaI = ($i - 1);
									$MetaDia = ($restoMetaGuardar / ($dias - $diaI));
								}
								
								//restante meta dia
								$restante = $valorDia - $MetaDia;
								
								$restoMetaFormat = number_format($restoMeta,2,',','.');
								$MetaDiaFormat = number_format($MetaDia,2,',','.');
								$restanteFormat = number_format($restante,2,',','.');
								
								//restante meta dia
								$restante = $valorDia - $MetaDia;
								
							if ($resultOperadores[qtd_recarga] > 0){
								
						?>

						<tr>
							<td class="corpo" height="26" > <?php echo $i;?> </td>
							<td class="corpo" height="26" > <?php echo $linhasOp;?> </td>
							<td class="corpo" height="26" > <?php echo $resultOperadores[qtd_recarga]?> </td>
							<!--<td <td class="corpo" height="26" > <?php //echo $valorTotalDia?> </td> -->
							<!--<td class="corpo" height="26" > <?php //echo $metaFormat?> </td> -->
							
							<?php 
								
							
								if ($MetaDia <= $valorDia){
							?>
									<td color="336699" bgcolor="green" align="center" height="26" > <?php echo $valorTotalDia?> </td>
									<td color="336699" bgcolor="green" align="center" height="26" > <?php echo $restanteFormat?> </td>
							<?php
								}else {
							?>
									<td color="336699" bgcolor="red" align="center" height="26" > <?php echo $valorTotalDia?> </td>
									<td color="336699" bgcolor="red" align="center" height="26" > <?php echo $restanteFormat?> </td>
							<?php
								}
							
							?>
							
							<td class="corpo" height="26" > <?php echo $MetaDiaFormat?> </td>
							
							
							<?php /*
								if ($restoMeta > 0){
							?>		<td color="ff6600" bgcolor="red" align="center" height="26" > <?php echo $restoMetaFormat?> </td> <?php
								} elseif ($restoMeta < 0){
							?>		<td color="ff6600" bgcolor="green" align="center" height="26" > <?php echo $restoMetaFormat?> </td> <?php
								} else {
							?>		<td color="ff6600" bgcolor="blue" align="center" height="26" > <?php echo $restoMetaFormat?> </td> <?php
								}	*/				
							?>
							
							<?php }}};?>
						</tr>
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