<?php   

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log();  
	
	if(isset($_POST[lg("nome")]) && !empty($_POST[lg("nome")])){ 
		
		$valores = array(array(lg("nome"),$_POST[lg("nome")]));  
		sql_insert( $conexao, "cidades", $valores);
		
		location("../cidades.php","msg_ok=CIDADE CRIADA COM SUCESSO"); 
	}else{ 
		location("../cidades.php","msg_erro=ESCOLHA UM NOME"); 
	}
	
?>