<?php    
	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/arquivo.php");
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log(); 
	
	$dados = array(array("layout_equipe",$_POST["layout"]));
	
	sql_update($conexao, "dados", $dados, ""); 
	
	xml_bd($conexao);
	
	location("../equipe.php","msg_ok=LAYOUT ALTERADO COM SUCESSO&pagey=".$_POST["pagey_out"]);

	
?> 