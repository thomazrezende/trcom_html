<?php  

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/mysql.php"); 
	
	$conexao = conectar();
	verif_log();   
	
	$dados_arr = sql_select($conexao,"dados", "senha", "", "", false); 	
	$senha_banco = $dados_arr["senha"];  
	
	if( empty($_POST["senha_nova"]) || empty($_POST["senha_confirma"]) || empty($_POST["senha_atual"]) ) {  
		
		$msg="PREENCHA OS 3 CAMPOS";
		location("../senha.php","msg_erro=".$msg);
		
	} 
	
	elseif( $_POST["senha_nova"] != $_POST["senha_confirma"]) {
		
		$msg="CONFIRMAÇÃO INVÁLIDA";
		location("../senha.php","msg_erro=".$msg); 
	
	}else{
		
		$compara = comparePassword( $conexao, $_POST["senha_atual"], $senha_banco);
		 
		if(	$compara == 1) {
			$senha_nova = getPasswordHash(getPasswordSalt(), $_POST["senha_nova"] ); 
			 
			$ok = sql_update($conexao, "dados", array(array("senha",$senha_nova)),""); 
			 
			if($ok){
				$msg="SENHA ALTERADA COM SUCESSO";
				location("../senha.php","msg_ok=".$msg); 
			}else{ 
				location("../senha.php","msg_erro=ERRO");
			}
		
		}else{		
			$msg="SENHA ATUAL INCORRETA";			
			location("../senha.php","msg_erro=".$msg); 
			
		}			
	}


?>