<?php  
	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/mysql.php"); 
	require_once("../_tr/xml.php"); 
	
	$conexao = conectar();
	verif_log();
	
	$id = $_GET['id'];
		 
	sql_delete( $conexao, "categorias", "id", $id, 1 );  

	xml_bd($conexao);

	location("../categorias.php","msg_ok=CATEGORIA REMOVIDA COM SUCESSO");
	
?>