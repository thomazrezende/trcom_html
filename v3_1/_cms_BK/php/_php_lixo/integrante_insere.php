<?php   

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/mysql.php");
	require_once("../_tr/xml.php");
	
	$conexao = conectar();
	verif_log();  
	
	if(isset($_POST["nome"]) && !empty($_POST["nome"])){
		
		sql_insert( $conexao, "equipe", $valores);
		
		$prox = mysqli_insert_id ( $conexao );
		mkdir("../../equipe/integrante".$prox,0777);
		
		$valores = array(array("nome", $_POST["nome"])); 
		
		location("../integrante.php","id=".$prox); 
	}else{ 
		location("../equipe.php","msg_erro=ESCOLHA UM NOME"); 
	}
	
?>