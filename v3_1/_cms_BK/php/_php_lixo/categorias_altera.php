<?php    

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/string.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log();   
	
	$categorias = sql_select($conexao, "categorias","id","","",true );  

	for($i=0; $i<count($categorias); $i++){
		
		$id = $categorias[$i]['id'];
		
		$dados = array(
			array(lg("nome"), caps( $_POST[lg("nome").$id] ) ),
			array("hex", verifica_hex($_POST["hex".$id]))
			); 
		
		sql_update($conexao, "categorias", $dados, "id='".$id."'" );  
		
	}
  	
	xml_bd($conexao);

	location("../categorias.php","msg_ok=DADOS ALTERADOS COM SUCESSO"); 
	
?> 