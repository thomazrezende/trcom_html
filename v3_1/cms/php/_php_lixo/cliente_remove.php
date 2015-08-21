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

	remove_pasta( $conexao, '../../clientes/cliente'.$id, 'clientes', $id, false, false);
	//remove_pasta( $conexao, $path, $tabela, $id, $tabelas_vinc, $lbs_vinc) 

	xml_bd($conexao);

	location("../clientes.php","msg_ok=CLIENTE REMOVIDO COM SUCESSO");
	
?>