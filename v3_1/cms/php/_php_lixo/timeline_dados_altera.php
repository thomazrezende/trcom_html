<?php  

	require_once("../../../../_tr_8362036/seguranca.php"); 
	require_once("../../../../_tr_8362036/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/mysql.php");  
	require_once("../_tr/xml.php");  
	
	conectar();
	verif_log();  
	
	$valores = array(
		array("titulo_".get_lg(),$_POST["titulo_".get_lg()]),
		array("sub_".get_lg(),$_POST["sub_".get_lg()]), 
		array("data_ini",$_POST["data_ini"]),
		array("data_fim",$_POST["data_fim"]),
		array("id_projeto",$_POST["id_projeto"]),
		array("url",$_POST["url"])
	); 
	
	/*print_r($valores);*/ 
	
	$ok = sql_update("timeline", $valores , "id='".$_SESSION["id_evento"]."'");
	
	if($ok){
		xml_timeline();
		location("../timeline_dados.php?msg_ok=DADOS ALTERADOS COM SUCESSO","");
	}else{
		location("../timeline_dados.php?msg_erro=ERRO","");
	}
	

?>