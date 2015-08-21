<?php  
require_once("../../../../_control/seguranca.php");
require_once("../../../../_control/acesso.php");   
require_once("../_tr/html.php");  
require_once("../_tr/mysql.php");  

	//logoff
	if(isset($_GET["sessao"]) && $_GET["sessao"] == "false"){
		logout();
		location("../login.php","");
	}else{
		$conexao = conectar(); 
		$dados = sql_select( $conexao,"thomaz","email, senha","","",false);  
		
		if(1>2){
		//if($_POST["login"] != $dados["email"] || comparePassword( $conexao, $_POST["senha"], $dados["senha"])!=1){ 
			location("../login.php","msg_erro=DADOS INCORRETOS");
		}else{
			registra_log( $conexao, "../../../../_control/logs" ); 
			sessao_local( array( 
								array("logado",md5("acesso_ok_90432498")),
								array("user", $_POST["login"]), 
						),true ); 
			
			sessao_lg("_pt");
			location("../thomaz_dados.php","msg_ok=BEM VINDO!");
		} 
	}

?>


 