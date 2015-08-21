<?php  
	require_once("../../../../_control/seguranca.php"); 
	require_once("../../../../_control/acesso.php");
	require_once("../_tr/html.php");  
	
	verif_log();
	
	$itens = array (array("id_cliente", $_GET["id"]));
	
	sessao_local( $itens, true ); 

	location("../cliente_dados.php","");	
?>