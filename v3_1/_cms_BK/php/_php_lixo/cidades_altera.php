<?php    

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log();   
	
	$cidades = sql_select($conexao, "cidades","id","","",true );  

	for($i=0; $i<count($cidades); $i++){
		$id = $cidades[$i]['id'];
		
		$dados = array(
			array(lg("nome"), $_POST[lg("nome").$id]),
			array("lat", $_POST["lat".$id]),
			array("lng", $_POST["lng".$id])
			); 
		
		sql_update($conexao, "cidades", $dados, "id='".$id."'" );  
		
	}
  	
	xml_bd($conexao);

	location("../cidades.php","msg_ok=DADOS ALTERADOS COM SUCESSO"); 
	
?> 