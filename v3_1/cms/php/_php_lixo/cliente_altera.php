<?php  

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php");
	require_once("../_tr/mysql.php");
	require_once("../_tr/xml.php");
	
	$conexao = conectar();
	verif_log();

	$id = $_GET['id'];
		
	$valores = array(
		array('nome',$_POST['nome']),
		array('site',verifica_http($_POST['site']))
	);
	
	$ok = sql_update($conexao, "clientes", $valores , " id=".$id);
	
	if($ok){
		xml_bd($conexao);
		location("../cliente.php","id=".$id."&msg_ok=DADOS ALTERADOS COM SUCESSO");
	}else{
		location("../clientes.php","id=".$id."&msg_erro=ERRO");
	}

	

?>