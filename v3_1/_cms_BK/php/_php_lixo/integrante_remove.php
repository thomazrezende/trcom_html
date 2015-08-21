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

	remove_pasta( $conexao, '../../equipe/integrante'.$id, 'equipe', $id, false, false);
	//remove_pasta( $conexao, $path, $tabela, $id, $tabelas_vinc, $lbs_vinc)
	
	verifica_vinculo( $conexao, 'dados','layout_equipe','item'.$id,'',false);
	//verifica_vinculo( $conexao, $tabela, $coluna, $itm, $where, $multiple)

	xml_bd($conexao);

	location("../equipe.php","msg_ok=INTEGRANTE REMOVIDO COM SUCESSO");
	
?>