<?php   

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/arquivo.php");
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log();

	$id = $_SESSION["id"];

	$dados = sql_select($conexao,"projetos","lb_arquivos","","id=".$id,false);
	$lb_img = $dados["lb_arquivos"];
	$id_img = $_GET["id"];
	
	list($width, $height) = getimagesize($_FILES['imagem']['tmp_name']);

	($width > 900)?($g = 900):($g = $width);
	($width > 650)?($m = 650):($m = $width);
	($width > 350)?($p = 350):($p = $width);
	
	unlink("../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_p.jpg");
	unlink("../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_m.jpg");
	unlink("../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_g.jpg");
	unlink("../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_tb.jpg");

	up_img_var ("imagem",-1,"w",$p,"../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_p","jpeg"); 
	up_img_var ("imagem",-1,"w",$m,"../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_m","jpeg"); 
	up_img_var ("imagem",-1,"w",$g,"../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_g","jpeg");   
	up_img_fixo ("imagem",-1,36,36,"../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_tb","jpeg");   
 
	
?> 