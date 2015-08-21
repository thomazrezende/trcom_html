<?php   


	require_once("../../../../_tr_8362036/seguranca.php"); 
	require_once("../../../../_tr_8362036/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php");
	require_once("../_tr/mysql.php");
	
	conectar();
	verif_log();   

	sql_delete("timeline", "id", $_GET["id"], 1); 

	xml_timeline();
	
	location("../timeline.php","msg_ok=REGISTRO REMOVIDO COM SUCESSO"); 
	
	
?> 