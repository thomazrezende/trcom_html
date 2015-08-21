<?php  

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php");
	require_once("../_tr/mysql.php");
	require_once("../_tr/xml.php");
	
	$conexao = conectar();
	verif_log(); 
		
	$valores = array(
		array("email",$_POST["email"]),
		array("endereco",$_POST["endereco"]),
		array("telefone",$_POST["telefone"]),
		array("email",$_POST["email"]),
		array("facebook",verifica_http($_POST["facebook"])),
		array("instagram",verifica_http($_POST["instagram"])),
		array(lg("sobre"),$_POST[lg("sobre")])
	);
	
	$ok = sql_update($conexao, "dados", $valores , "");
	
	if($ok){ 
		
		xml_bd($conexao);
		location("../dados.php?msg_ok=DADOS ALTERADOS COM SUCESSO","");
	}else{
		location("../dados.php?msg_erro=ERRO","");
	}
	

?>