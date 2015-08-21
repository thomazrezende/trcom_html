<?php    

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log(); 

	$id = $_GET["id"];
  
	$dados = array(	
		//array("hex_topo", verifica_hex($_POST["hex_topo"])),
		array("hex_logo", verifica_hex($_POST["hex_logo"])),
		array("hex_titulo", verifica_hex($_POST["hex_titulo"])),
		array("hex_subtitulo", verifica_hex($_POST["hex_subtitulo"])),
		array("hex_subtitulo_bg", verifica_hex($_POST["hex_subtitulo_bg"])),
		array("hex_base", verifica_hex($_POST["hex_base"]))
	);

	sql_update($conexao, "temas", $dados, "id='".$id."'" );
  
	xml_bd($conexao);

	location("../tema.php","id=".$id."&msg_ok=DADOS ALTERADOS COM SUCESSO");  
	  
	
?> 