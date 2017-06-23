<?php

//$idusuario_ad = $_SESSION["idusuario_ad"];
######################################
//include("ip.php");
session_start();
include('../../global/conecta.php');
include('../../global/libera.php');


$jan1	= $_POST["jan"];
$fev1	= $_POST["fev"];
$mar1	= $_POST["mar"];
$abr1	= $_POST["abr"];
$mai1	= $_POST["mai"];
$jun1	= $_POST["jun"];
$jul1	= $_POST["jul"];
$ago1	= $_POST["ago"];
$sete1	= $_POST["sete"];
$outu1	= $_POST["outu"];
$nov1	= $_POST["nov"];
$dez1	= $_POST["dez"];

if ($jan1 == ""){
	$jan1 = "null";
} if($fev1 == ""){
	$fev1 = "null";
} if($mar1 == ""){
	$mar1 = "null";
} if($abr1 == ""){
	$abr1 = "null";
} if($mai1 == ""){
	$mai1 = "null";
} if($jun1 == ""){
	$jun1 = "null";
} if($jul1 == ""){
	$jul1 = "null";
} if($ago1 == ""){
	$ago1 = "null";
} if($sete1 == ""){
	$sete1 = "null";
} if($outu1 == ""){
	$outu1 = "null";
} if($nov1 == ""){
	$nov1 = "null";
} if($dez1 == ""){
	$dez1 = "null";
} 


$jan1 	= str_replace(".","","$jan1");
$fev1	= str_replace(".","","$fev1");
$mar1	= str_replace(".","","$mar1");
$abr1	= str_replace(".","","$abr1");
$mai1	= str_replace(".","","$mai1");
$jun1	= str_replace(".","","$jun1");
$jul1	= str_replace(".","","$jul1");
$ago1	= str_replace(".","","$ago1");
$sete1	= str_replace(".","","$sete1");
$outu1	= str_replace(".","","$outu1");
$nov1	= str_replace(".","","$nov1");
$dez1	= str_replace(".","","$dez1");

$ano	= $_POST["ano"];

$servidor = `uname -a | awk -F" " '{print $2}'`;
$filial1  = trim($servidor);

	$query = "update metasrec set jan = $jan1, fev = $fev1, mar = $mar1, abr = $abr1, mai = $mai1, jun = $jun1, jul = $jul1, ago = $ago1, sete = $sete1, outu = $outu1, nov = $nov1, dez = $dez1, filial = '$filial1' where ano = $ano";

	if( mysql_query($query))
	{
		echo 
		"<script>window.alert('Atualizado com Sucesso !')
			window.location.replace('../view/form_meta_ano.php');
		</script>";	
	}
	else
	{
		echo 
		"<script>window.alert('Algo Errado no Query ! ')
			window.location.replace('../view/form_meta_ano.php');
		</script>";
		
	}
	
?>

	
