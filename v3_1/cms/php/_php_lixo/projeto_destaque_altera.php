<?php    

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log(); 

	$id = $_GET["id"];
	
	$dados = array(	array("destaque", $_GET["destaque"])
					);
 
	sql_update($conexao, "projetos", $dados, "id='".$id."'" ); 
	
	xml_projeto( $conexao, $id);

	location("../projetos.php",""); 
	
?> 