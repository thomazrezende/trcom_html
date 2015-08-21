<?php   

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/string.php"); 
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log();  
	
	if(isset( $_POST[lg('nome')] ) && !empty( $_POST[lg('nome')] )){  
		 
		
		
		$nome = mb_strtolower( $_POST[lg('nome')],'UTF-8' );
		$lb_arquivos = clean ($nome);
		
		$valores = array(	array(lg("nome"), $nome),
							array("lb_arquivos",$lb_arquivos),
							array("publicado_pt",0),
							array("publicado_en",0)
							);
		
		sql_insert( $conexao, "projetos", $valores);
		
		$prox = mysqli_insert_id ( $conexao );
		mkdir("../../projetos/projeto".$prox,0777);
		
		location("escolhe_projeto.php","id=".$prox); 
	}else{ 
		location("../projetos.php","msg_erro=ESCOLHA UM NOME"); 
	}
	
?>