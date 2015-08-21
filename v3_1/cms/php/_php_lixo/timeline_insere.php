<?php   

	require_once("../../../../_tr_8362036/seguranca.php"); 
	require_once("../../../../_tr_8362036/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/mysql.php");
	require_once("../_tr/xml.php");
	
	conectar();
	verif_log();  
	
	if(isset($_POST["titulo_".get_lg()]) && !empty($_POST["titulo_".get_lg()])){ 
		
		$valores = array(	array("titulo_".get_lg(), $_POST["titulo_".get_lg()])); 		
		 
		sql_insert("timeline", $valores);
		
		xml_timeline();
		
		location("../timeline.php","msg_ok=REGISTRO CRIADO COM SUCESSO"); 
	}else{ 
		location("../timeline.php","msg_erro=ESCOLHA UM TÍTULO"); 
	}
	
?> 