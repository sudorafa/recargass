<?php
	session_start();
	/*
	form para . (Recuperado da integridade)
	Rafael Eduardo L - @sudorafa
	Recife, 28 de Setembro de 2016
	*/
	include('../../global/conecta.php');
	include('../../global/libera.php');
	//include("/controller/ip.php");
	//include('../menu.php');
	
	$ano = $_POST["ano"];
?>

<html>
    <head>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="/_css/style.css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=11"/>		
	</head>
	<body onLoad="document.cadastro.nome.focus()"> 
	<script type="text/javascript">
		function FormataValor(Campo, teclapres)
		{
			var tecla = teclapres.keyCode;
			var vr = new String(Campo.value);
			vr = vr.replace(".", "");
			vr = vr.replace(".", "");
			tam = vr.length + 1;
			if (tecla != 8 && tecla != 8)
			{
				if (tam > 0 && tam < 2)
					Campo.value = vr.substr(0, 2) ;
				if (tam > 2 && tam < 4)
					Campo.value = vr.substr(0, 3) + '.' + vr.substr(2, 3);
			}
		}
	</script>
	<br/><br/>
		<div id="interface">
			<div id="Conteudo">
				<div align="center">
					<br/>
					<h1 align="center"> <font color="blue"> Atualizar Metas do Ano <?php echo $ano ?> </font></h1> 
					
					<?php

						$sql 	= mysql_query("select * from metasrec where ano = $ano");
						$dados 	= mysql_fetch_array($sql);

						$jan1	= $dados[jan];
						$fev1	= $dados[fev];
						$mar1	= $dados[mar];
						$abr1	= $dados[abr];
						$mai1	= $dados[mai];
						$jun1	= $dados[jun];
						$jul1	= $dados[jul];
						$ago1	= $dados[ago];
						$sete1	= $dados[sete];
						$outu1	= $dados[outu];
						$nov1	= $dados[nov];
						$dez1	= $dados[dez];

						$jan1 	= str_replace(".00","","$jan1");
						$fev1	= str_replace(".00","","$fev1");
						$mar1	= str_replace(".00","","$mar1");
						$abr1	= str_replace(".00","","$abr1");
						$mai1	= str_replace(".00","","$mai1");
						$jun1	= str_replace(".00","","$jun1");
						$jul1	= str_replace(".00","","$jul1");
						$ago1	= str_replace(".00","","$ago1");
						$sete1	= str_replace(".00","","$sete1");
						$outu1	= str_replace(".00","","$outu1");
						$nov1	= str_replace(".00","","$nov1");
						$dez1	= str_replace(".00","","$dez1");

						$jan1 	= number_format($jan1,0,',','.');
						$fev1	= number_format($fev1,0,',','.');
						$mar1	= number_format($mar1,0,',','.');
						$abr1	= number_format($abr1,0,',','.');
						$mai1	= number_format($mai1,0,',','.');
						$jun1	= number_format($jun1,0,',','.');
						$jul1	= number_format($jul1,0,',','.');
						$ago1	= number_format($ago1,0,',','.');
						$sete1	= number_format($sete1,0,',','.');
						$outu1	= number_format($outu1,0,',','.');
						$nov1	= number_format($nov1,0,',','.');
						$dez1	= number_format($dez1,0,',','.');

					?>
					<br/><br/>
					<hr width="80%">
					<table cellpadding="0" border="1" width="80%" align="center">

						<tr>
						<form action="../controller/query_meta.php" method="post" name="meta">
							
							<tr> 
								<td	align="center">
								</br> </br>
								
									<label> <font color="336699"> Jan: </label> &nbsp;
									<input type="text" value="<?php echo $jan1 ?>"  name="jan" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
								&nbsp; &nbsp; &nbsp;
									<label> <font color="336699"> Fev: </label> &nbsp;
									<input type="text" value="<?php echo $fev1 ?>" name="fev" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
								&nbsp; &nbsp; &nbsp;	
									<label> <font color="336699"> Mar: </label> &nbsp;
									<input type="text" value="<?php echo $mar1 ?>" name="mar" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
								&nbsp; &nbsp; &nbsp;
									<label> <font color="336699"> Abr: </label> &nbsp;
									<input type="text" value="<?php echo $abr1 ?>" name="abr" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
								
								</br> </br>
								
									<label> <font color="336699"> Mai: </label> &nbsp;
									<input type="text" value="<?php echo $mai1 ?>" name="mai" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
								&nbsp; &nbsp; &nbsp;
									<label> <font color="336699"> Jun: </label> &nbsp;
									<input type="text" value="<?php echo $jun1 ?>" name="jun" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
								&nbsp; &nbsp; &nbsp; &nbsp;
									<label> <font color="336699"> Jul: </label> &nbsp;
									<input type="text" value="<?php echo $jul1 ?>" name="jul" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
								&nbsp; &nbsp; &nbsp;
									<label> <font color="336699"> Ago: </label> &nbsp;
									<input type="text" value="<?php echo $ago1 ?>" name="ago" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
								
								</br> </br>
								&nbsp;
									<label> <font color="336699"> Set: </label> &nbsp;
									<input type="text" value="<?php echo $sete1 ?>" name="sete" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
								&nbsp; &nbsp; &nbsp;
									<label> <font color="336699"> Out: </label> &nbsp;
									<input type="text" value="<?php echo $outu1 ?>" name="outu" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
								&nbsp; &nbsp; &nbsp;	
									<label> <font color="336699"> Nov: </label> &nbsp;
									<input type="text" value="<?php echo $nov1 ?>" name="nov" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
								&nbsp; &nbsp; &nbsp;
									<label> <font color="336699"> Dez: </label> &nbsp;
									<input type="text" value="<?php echo $dez1 ?>" name="dez" size="4" maxlength="6" onkeyup="FormataValor(this,event)" /> ,00
									<input type="hidden" name="ano" value="<?php echo $ano ?>" >
									
								</br> </br> </br>
								
								<table cellpadding="0" border="0" width="20%" align="center">
								<tr align="center">
									<td align="center"> 
										<input align="center" type="submit" name="salvar" value="salvar"> 
									</td>
						</form>
								</tr>
								</table>
								<br>
						</td>
						</tr>
					</table>
					<hr width="80%">
					<br/><br/>
				</div>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>