<?php    

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log(); 

	$id = $_SESSION["id"];
	
	$dados = array(
					array("hex_topo", verifica_hex($_POST["hex_topo"])),
					array("hex_logo", verifica_hex($_POST["hex_logo"])),
					array("hex_nome", verifica_hex($_POST["hex_nome"])),
					array("hex_base", verifica_hex($_POST["hex_base"]))			
					);
 
	sql_update($conexao, "projetos", $dados, "id='".$id."'" ); 
	
	xml_projeto( $conexao, $id);

	location("../projeto_capa.php","msg_ok=DADOS ALTERADOS COM SUCESSO"); 
	
?> 