<?php  
	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/mysql.php"); 
	require_once("../_tr/xml.php"); 
	
	$conexao = conectar();
	verif_log();
	
	$lista = explode(',',$_GET['ids']);
	$id = $_SESSION['id'];
	$dados = sql_select( $conexao,"projetos","lb_arquivos, layout_itens, layout_larguras","","id=".$id,false);
	 
	for( $i=0; $i<count($lista); $i++){

		$id_img = $lista[$i]; 
		$dados_img = sql_select( $conexao,"arquivos","tipo","","id=".$id_img,false); 
		sql_delete( $conexao, "arquivos", "id", $id_img, 1 );

		if($dados_img["tipo"] == 'img'){
			unlink("../../projetos/projeto".$id."/TRCOM_".$dados["lb_arquivos"]."_".$id_img."_p.jpg");
			unlink("../../projetos/projeto".$id."/TRCOM_".$dados["lb_arquivos"]."_".$id_img."_m.jpg");
			unlink("../../projetos/projeto".$id."/TRCOM_".$dados["lb_arquivos"]."_".$id_img."_g.jpg");
			unlink("../../projetos/projeto".$id."/TRCOM_".$dados["lb_arquivos"]."_".$id_img."_tb.jpg");
		} 

		$itm = 'item'.$id_img;
		$itens = explode( ",", $dados['layout_itens'] ); 
		$larguras = explode( ",", $dados['layout_larguras'] );

		$key_itm = array_search( $itm, $itens );

		if( $key_itm !== false ){
			unset( $itens[$key_itm] );
			unset( $larguras[$key_itm] );	 
			$colunas =  array( 	array( 'layout_itens', join(",",$itens)),
								array( 'layout_larguras', join(",",$larguras)));

			sql_update( $conexao, 'projetos', $colunas, 'id='.$id ); 
		}  
	
	}

	xml_projeto( $conexao, $id );  
	location("../projeto_arquivos.php","msg_ok=ARQUIVO REMOVIDO COM SUCESSO");

?>