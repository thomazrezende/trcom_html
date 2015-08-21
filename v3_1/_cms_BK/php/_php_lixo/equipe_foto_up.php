<?php  

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/arquivo.php");
	
	$conexao = conectar();
	verif_log(); 

	unlink("../../TRCOMarquitetos.jpg");
	up_img_fixo("arquivo", -1, 900, 450,"../../TRCOMarquitetos", "jpeg");
	
?>