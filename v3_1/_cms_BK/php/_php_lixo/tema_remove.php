<?php  
	
	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/mysql.php"); 
	require_once("../_tr/arquivo.php");
	require_once("../_tr/xml.php");
	
	$conexao = conectar();
	verif_log();
	
	$id = $_GET['id'];

	sql_delete( $conexao, "temas", "id", $id, 1 ); 
	
	unlink("../../temas/tema".$id."_p.jpg");
	unlink("../../temas/tema".$id."_m.jpg");
	unlink("../../temas/tema".$id."_g.jpg"); 
	 
	xml_bd($conexao);

	location("../temas.php","msg_ok=IMAGEM REMOVIDA COM SUCESSO");
?>