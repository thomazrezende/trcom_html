<?php    

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log();   
	
	$marcadores = sql_select($conexao, "marcadores","id","","",true );  

	for($i=0; $i<count($marcadores); $i++){
		$id = $marcadores[$i]['id'];
		
		$dados = array(
			array(lg("nome"), $_POST[ lg("nome").$id])
			); 
		
		sql_update($conexao, "marcadores", $dados, "id='".$id."'" );  
		
	}
  	
	xml_bd($conexao); 

	location("../marcadores.php","msg_ok=DADOS ALTERADOS COM SUCESSO"); 
	
?> 