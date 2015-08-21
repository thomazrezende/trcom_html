<?php   

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log();  
	
	if(isset($_POST["nome"]) && !empty($_POST["nome"])){
		
		$valores = array(array("nome", $_POST["nome"])); 
		sql_insert( $conexao, "clientes", $valores);
		
		$prox = mysqli_insert_id ( $conexao );		
		mkdir("../../clientes/cliente".$prox, 0777); 
		
		location("../cliente.php","id=".$prox); 
	}else{ 
		location("../clientes.php","msg_erro=ESCOLHA UM NOME"); 
	}
	
?>