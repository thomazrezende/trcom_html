<?php   

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log();

	$id = $_SESSION["id"]; 

	$valores = array( 	array("id", 0), 
					  	array("tipo", "emb"), 
						array("embed", emb_100($_POST["embed"])), 
						array("id_projeto", $id));

	sql_insert( $conexao, "arquivos", $valores); 
	$id_emb = mysqli_insert_id ( $conexao );

	//atualiza layout  

	$dados = sql_select($conexao,"projetos","layout_itens,layout_larguras","","id=".$id,false);
	
	$layout_itens = $dados['layout_itens'];
	$layout_larguras = $dados['layout_larguras'];  

	if(!empty($dados['layout_itens'])){
		$layout_itens .= ',';
		$layout_larguras .= ',';	
	}

	$layout_itens .= "item".$id_emb;
	$layout_larguras .= "w100"; 

	$dados = array(	array("layout_itens", $layout_itens),
				   	array("layout_larguras", $layout_larguras)
					);
 
	sql_update($conexao, "projetos", $dados, "id='".$id."'" );  
	xml_projeto( $conexao, $id); 

	location("../projeto_arquivos.php","msg_ok=VÍDEO INSERIDO COM SUCESSO"); 

?> 