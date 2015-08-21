<?php  
	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/mysql.php"); 
	require_once("../_tr/xml.php"); 
	
	$conexao = conectar();
	verif_log();
	
	$id = $_GET['id'];
		 
	sql_delete( $conexao, "cidades", "id", $id, 1 ); 
	
	xml_bd($conexao);

	location("../cidades.php","msg_ok=CIDADE REMOVIDA COM SUCESSO");
	
?>