<?php  

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/arquivo.php");
	
	$conexao = conectar();
	verif_log();

	$id = $_SESSION["id"]; 

	list($width, $height) = getimagesize($_FILES['arquivo']['tmp_name']);

	if($width < $height) $ref = $width; 
	else $ref = $height; 

	($ref > 1200)?($g = 1200):($g = $ref);
	($ref > 800)?($m = 800):($m = $ref);
	($ref > 350)?($p = 350):($p = $ref);

	unlink("../../projetos/projeto".$id."/capa_p.jpg");
	unlink("../../projetos/projeto".$id."/capa_m.jpg");
	unlink("../../projetos/projeto".$id."/capa_g.jpg");

	up_img_fixo("arquivo", -1, $p, $p,"../../projetos/projeto".$id."/capa_p", "jpeg");   
	up_img_fixo("arquivo", -1, $m, $m,"../../projetos/projeto".$id."/capa_m", "jpeg");   
	up_img_fixo("arquivo", -1, $g, $g,"../../projetos/projeto".$id."/capa_g", "jpeg"); 

	if(!file_exists("../../projetos/projeto".$id."/tb.jpg")){
		up_img_fixo("arquivo", -1, $p, $p,"../../projetos/projeto".$id."/tb", "jpeg");  
		up_img_fixo("arquivo", -1, 36, 36,"../../projetos/projeto".$id."/tbp", "jpeg");  
	}

?>