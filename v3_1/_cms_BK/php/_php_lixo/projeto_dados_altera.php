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
					array(lg("publicado"), $_POST[lg("publicado")]),
					array("codigo", $_POST["codigo"]),
					array("destaque", $_POST["destaque"]),
					array(lg("nome"), $_POST[lg("nome")]),
					array(lg("subtitulo"), $_POST[lg("subtitulo")]),
					array("data", $_POST["data"]),
					array("lb_arquivos", $_POST["lb_arquivos"]),
					array("cidade", $_POST["cidade"]),
					array("cliente", $_POST["cliente"]),
					array("categoria", $_POST["categoria"]),
					array("marcadores", $_POST["marcadores"]),
					array(lg("texto"), $_POST[lg("texto")]),
					array(lg("creditos"), $_POST[lg("creditos")])				
					);
 
	sql_update( $conexao, "projetos", $dados, "id='".$id."'" ); 
	
	xml_projeto( $conexao, $id );

	location("../projeto_dados.php","msg_ok=DADOS ALTERADOS COM SUCESSO"); 
	
?> 