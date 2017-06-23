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
	
	$id 	= $_POST["operador"];
	$ano 	= $_POST["ano"];
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
					<h1 align="center"> <font color="blue"> Estatistica Anual do Operador <?php echo $id ?> </font></h1> 
					<br/>
					<label><a href="form_estatistica_operadores.php " title="Voltar para Estatisticas de Operadores"> <img src="/_imagens/btn_voltar.png"></a></label>
					<br/><br/>
					<?php 
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
						<table width="60%" border="1"cellspacing="1"cellpadding="1" align="center">
						<tr>
							<td  colspan="5" align="center"> <?php echo $meses[$i] . " de " . $ano; ?></td>
						</tr>

						<tr>
							<td class="title" height="26"> Operador </td>
							<td class="title" height="26"> Nome </td>
							<td class="title" height="26"> Recargas </td>
							<td class="title" height="26"> Total </td>
							<td class="title" height="26"> Percentual "Mes"</td>
						</tr>
						<tr>
						<?php
								
							//valores gerais do operador
							$resultOperador = mysql_fetch_array(mysql_query("SELECT sum(valor) as total_valor, count(valor) as qtd_recarga FROM recargasrec WHERE data between '$ano-$i-01' and '$ano-$i-31' and id_operador = '$id'"));
							
							//valor total operador convertido
							$valor = $resultOperador[total_valor];
							$valorTotal = number_format($valor,2,',','.');
							
							//nome do operador
							$buscaNome = mysql_fetch_array(mysql_query("select nomeOperador from operadoresrec where numOperador = '$id'"));
							$nome = $buscaNome[nomeOperador];
							
							//qtd recargas
							$qtd = $resultOperador[qtd_recarga];
							
							//valor total de recargas no meses
							$dadosTotalMes = mysql_fetch_array(mysql_query("SELECT sum(valor) as total_valor FROM recargasrec WHERE data between '$ano-$i-01' and '$ano-$i-31'"));
							$totalMes = $dadosTotalMes[total_valor];
							
							//percentual
							$percentual = ($valor * 100) / $totalMes;
							
							//percentual convertido
							$percentualConvertido = number_format($percentual,2,',','.');
							
						?>
							<td class="corpo" height="26" > <?php echo $id;?> </td>
							<td class="corpo" height="26" > <?php echo strtoupper($nome)?> </td>
							<td class="corpo" height="26" > <?php echo $qtd?> </td>
							<td class="corpo" height="26" > <?php echo $valorTotal?> </td>
							<td class="corpo" height="26" > <?php echo $percentualConvertido?> % </td>
						
						</tr>
						</table>
						<br/> <br/>
					<?php
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