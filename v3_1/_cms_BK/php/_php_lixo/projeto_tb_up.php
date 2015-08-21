<?php  

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/arquivo.php");
	
	$conexao = conectar();
	verif_log();

	$id = $_SESSION["id"];

	unlink("../../projetos/projeto".$id."/tb.jpg");
	up_img_fixo("arquivo", -1, 350, 350,"../../projetos/projeto".$id."/tb", "jpeg");   
	up_img_fixo("arquivo", -1, 36, 36,"../../projetos/projeto".$id."/tbp", "jpeg");   
		   
?>