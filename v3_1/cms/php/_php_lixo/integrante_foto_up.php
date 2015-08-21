<?php  

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/arquivo.php");
	
	$conexao = conectar();
	verif_log();

	$id = $_GET["id"];

	unlink("../../equipe/integrante".$id."/foto.jpg");
	up_img_fixo("arquivo", -1, 350, 350,"../../equipe/integrante".$id."/foto", "jpeg");  
	
		   
?>