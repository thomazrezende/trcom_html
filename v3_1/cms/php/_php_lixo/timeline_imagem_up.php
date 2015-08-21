<?php  

	require_once("../../../../_tr_8362036/seguranca.php"); 
	require_once("../../../../_tr_8362036/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/arquivo.php");
	
	conectar();
	verif_log(); 
	
	unlink("../../thomaz/tl".$_SESSION["id_evento"].".jpg");
	up_img_fixo("arquivo",-1,225,225,"../../thomaz/tl".$_SESSION["id_evento"],"jpeg"); 
	

?>