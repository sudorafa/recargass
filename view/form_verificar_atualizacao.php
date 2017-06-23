<?php
	session_start();
	/*
	form para . (Recuperado da integridade)
	corpoel Eduardo L - @sudorafa
	Recife, 28 de Setembro de 2016
	*/
	include('../../global/conecta.php');
	include('../../global/libera.php');
	include('../cabecalho.php');
	//include("/controller/ip.php");
	//include('../menu.php');
	
	$mes	=	1;
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
					<h1 align="center"> <font color="blue"> Atualizacao de <?php echo $ano ?> </font></h1> 
					<br/>
					<label><a href="form_verificar_atualizacao_ano.php " title="Voltar para Atualização Anual "> <img src="/_imagens/btn_voltar.png"></a></label>
					<br/><br/>
					<?php

					while ($mes <= 4) {

						if($mes == 1) {
							$dias=31;
							$nome="Janeiro";
									
							$dias2=28;
							$nome2="Fevereiro";
							
							$dias3=31;
							$nome3="Marco";
						} elseif($mes == 2) {
							$dias=30;
							$nome="Abril";
						
							$dias2=31;
							$nome2="Maio";
						
							$dias3=30;
							$nome3="Junho";
						} elseif($mes == 3) {
							$dias=31;
							$nome="Julho";
									
							$dias2=31;
							$nome2="Agosto";
							
							$dias3=30;
							$nome3="Setembro";
						} elseif($mes == 4) {
							$dias=31;
							$nome="Outubro";
							
							$dias2=30;
							$nome2="Novembro";
							
							$dias3=31;
							$nome3="Dezembro";
						}
					?>
				 
					<table cellpadding="0" border="0" width="76%" align="center">
					<tr>
						<td >
							<table width="210" border="1"cellspacing="1"cellpadding="1" align="center" style="float:left;">
							<tr class="corpo">
								<td  colspan="7" align="center"> <?php echo $nome . " de " . $ano; ?></td>
							</tr >

							<tr class="corpo">
								<td width=30><center>D</center></td>
								<td width=30><center>S</center></td>
								<td width=30><center>T</center></td>
								<td width=30><center>Q</center></td>
								<td width=30><center>Q</center></td>
								<td width=30><center>S</center></td>
								<td width=30><center>S</center></td>
							</tr>
							<tr class="corpo">
							<?php
								for($i=1;$i<=$dias;$i++) {
									
									if ($nome == "Janeiro"){
										
										$diadasemana = date("w",mktime(0,0,0,1,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano/01/$i";
										
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhas = mysql_num_rows($busca);
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> 
													<?php echo $i?>
												</center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=1&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									} else if ($nome == "Abril"){
										
										$diadasemana = date("w",mktime(0,0,0,4,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano-04-$i";
										
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhasBusca = mysql_num_rows($busca);
										$linhas = $linhasBusca;
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> 
												<?php echo $i?>
											</center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=4&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									} else if ($nome == "Julho"){
										
										$diadasemana = date("w",mktime(0,0,0,7,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano/07/$i";
										
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhas = mysql_num_rows($busca);
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> <?php echo $i; ?> </center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=7&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									} else if ($nome == "Outubro"){
										
										$diadasemana = date("w",mktime(0,0,0,10,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano/10/$i";
										
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhas = mysql_num_rows($busca);
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> <?php echo $i; ?> </center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=10&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									}
									
									if($diadasemana == 6) { ?>
							</tr >
							<tr >
									<?php }
								} ?>
							</tr>
							</table>
							
							<table width="7" border="0"cellspacing="1"cellpadding="1" align="center" style="float:left;"><tr> <td> </td> </tr></table>
							
							<table width="210" border="1"cellspacing="1"cellpadding="1" align="center" style="float:left;">
							<tr class="corpo">
								<td  colspan="7" align="center"> <?php echo $nome2 . " de " . $ano; ?></td>
							</tr>

							<tr class="corpo">
								<td width=30><center>D</center></td>
								<td width=30><center>S</center></td>
								<td width=30><center>T</center></td>
								<td width=30><center>Q</center></td>
								<td width=30><center>Q</center></td>
								<td width=30><center>S</center></td>
								<td width=30><center>S</center></td>
							</tr>
							<tr class="corpo">
							<?php
								for($i=1;$i<=$dias2;$i++) {
									
									if ($nome2 == "Fevereiro"){
										
										$diadasemana = date("w",mktime(0,0,0,2,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano/02/$i";
										 
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhas = mysql_num_rows($busca);
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> <?php echo $i; ?> </center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=2&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									} else if ($nome2 == "Maio"){
										
										$diadasemana = date("w",mktime(0,0,0,5,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano-05-$i";
										
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhasBusca = mysql_num_rows($busca);
										$linhas = $linhasBusca;
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> <?php echo  $i; ?> </center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=5&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									} else if ($nome2 == "Agosto"){
										
										$diadasemana = date("w",mktime(0,0,0,8,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano/08/$i";
										
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhas = mysql_num_rows($busca);
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> <?php echo $i; ?> </center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=8&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									} else if ($nome2 == "Novembro"){
										
										$diadasemana = date("w",mktime(0,0,0,11,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano/11/$i";
										
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhas = mysql_num_rows($busca);
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> <?php echo $i; ?> </center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=11&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									}
									
									if($diadasemana == 6) { ?>
							</tr>
							<tr>
									<?php }
								} ?>
							</tr>
							</table>
							
							<table width="7" border="0"cellspacing="1"cellpadding="1" align="center" style="float:left;"><tr> <td> </td> </tr></table>
							
							<table width="210" border="1"cellspacing="1"cellpadding="1" align="center" style="float:left;">
							<tr class="corpo">
								<td  colspan="7" align="center"> <?php echo $nome3 . " de " . $ano; ?></td>
							</tr>

							<tr class="corpo">
								<td width=30><center>D</center></td>
								<td width=30><center>S</center></td>
								<td width=30><center>T</center></td>
								<td width=30><center>Q</center></td>
								<td width=30><center>Q</center></td>
								<td width=30><center>S</center></td>
								<td width=30><center>S</center></td>
							</tr>
							<tr class="corpo">
							<?php
								for($i=1;$i<=$dias3;$i++) {
									
									if ($nome3 == "Marco"){
										
										$diadasemana = date("w",mktime(0,0,0,3,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano/03/$i";
										 
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhas = mysql_num_rows($busca);
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> <?php echo $i; ?> </center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=3&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									} else if ($nome3 == "Junho"){
										
										$diadasemana = date("w",mktime(0,0,0,6,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano-06-$i";
										
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhasBusca = mysql_num_rows($busca);
										$linhas = $linhasBusca;
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> <?php echo  $i; ?> </center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=6&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									} else if ($nome3 == "Setembro"){
										
										$diadasemana = date("w",mktime(0,0,0,9,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano/09/$i";
										
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhas = mysql_num_rows($busca);
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> <?php echo $i; ?> </center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=9&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									} else if ($nome3 == "Dezembro"){
										
										$diadasemana = date("w",mktime(0,0,0,12,$i,$ano));
										$cont = 0;
										if($i == 1) {
											while($cont < $diadasemana) {
												?> <td> </td> <?php
												$cont++;
											}
										}
										
										$dataProBanco = "$ano/12/$i";
										
										$busca = mysql_query("select id from recargasrec where data = '$dataProBanco'");
										$linhas = mysql_num_rows($busca);
										
										if ($linhas == 0){
											?> <td width=30 bgcolor="red"><center> <?php echo $i; ?> </center></td> <?php
										} else {
											?> <td width=30 bgcolor="grem"><center> 
												<a href="form_grafico_hora.php?dia=<?php echo $i?>&mes=12&ano=<?php echo $ano?>"target="_blank"><?php echo $i?></a>
											</center></td> <?php
										}
									}
									
									if($diadasemana == 6) { ?>
							</tr>
							<tr>
									<?php }
								} ?>
							</tr>
							</table>
						</td>
					</tr>
					</table>
					
					<br/>
					<?php $mes++; } ?>
				<br/><br/>
				</div>
			<?php 
				include('../../rodape.php');
			?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>