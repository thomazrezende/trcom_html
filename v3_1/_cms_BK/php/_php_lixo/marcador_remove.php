<?php  
	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/mysql.php"); 
	require_once("../_tr/xml.php"); 
	
	$conexao = conectar();
	verif_log();	
	
	$id = $_GET['id'];
		
	verifica_vinculo( $conexao, 'projetos','marcadores',$id,'',true);
	//verifica_vinculo( $conexao, $tabela, $coluna, $itm, $where, $multiple) 
		 
	sql_delete( $conexao, "marcadores", "id", $id, 1 );  

	xml_bd($conexao);

	location("../marcadores.php","msg_ok=MARCADOR REMOVIDO COM SUCESSO");
	
?>