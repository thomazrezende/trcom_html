<?php    

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log(); 

	$id = $_GET["id"];
	$id_projeto = $_SESSION["id"];
	
	$dados = array( 
					array(lg("legenda"), $_POST[lg("legenda")]),
					array("link", verifica_http($_POST["link"])));
 
	sql_update($conexao, "arquivos", $dados, "id='".$id."'" );
	
	xml_projeto( $conexao, $id_projeto); 

	location("../projeto_arquivo.php","id=".$id."&tipo=img&msg_ok=DADOS ALTERADOS COM SUCESSO"); 
	
?> 