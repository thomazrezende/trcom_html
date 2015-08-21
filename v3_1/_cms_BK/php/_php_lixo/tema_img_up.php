<?php   

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/arquivo.php");
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log();

	$id = $_GET['id'];

	list($width, $height) = getimagesize($_FILES['arquivo']['tmp_name']);

	if($width < $height) $ref = $width; 
	else $ref = $height; 

	($ref > 1200)?($g = 1200):($g = $ref);
	($ref > 800)?($m = 800):($m = $ref);
	($ref > 350)?($p = 350):($p = $ref); 

	unlink("../../temas/tema".$id."_p.jpg");
	unlink("../../temas/tema".$id."_m.jpg");
	unlink("../../temas/tema".$id."_g.jpg");

	up_img_fixo("arquivo",-1,$p,$p,"../../temas/tema".$id."_p","jpeg"); 
	up_img_fixo("arquivo",-1,$m,$m,"../../temas/tema".$id."_m","jpeg"); 
	up_img_fixo("arquivo",-1,$g,$g,"../../temas/tema".$id."_g","jpeg");  
	
?> 