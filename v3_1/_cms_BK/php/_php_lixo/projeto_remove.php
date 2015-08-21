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

	remove_pasta( $conexao, '../../projetos/projeto'.$id, 'projetos', $id, array('arquivos'), array('id_projeto'));
	verifica_vinculo( $conexao, 'projetos','relacionados',$id,'',true); 

	xml_bd($conexao);
	
	location("../projetos.php","msg_ok=PROJETO REMOVIDO COM SUCESSO");
	
?>