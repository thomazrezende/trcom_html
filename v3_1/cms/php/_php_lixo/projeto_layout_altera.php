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
					array("layout_itens", $_POST["layout_itens"]),
					array("layout_larguras", $_POST["layout_larguras"])			
					);
 
	sql_update($conexao, "projetos", $dados, "id='".$id."'" ); 
	
	xml_projeto( $conexao, $id);

	location("../projeto_layout.php","msg_ok=LAYOUT ALTERADO COM SUCESSO"); 
	
?> 