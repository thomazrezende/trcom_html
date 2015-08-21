<?php   

	require_once("../../../_control/seguranca.php"); 
	require_once("../../../_control/acesso.php");
	require_once("../_tr/html.php"); 
	require_once("../_tr/xml.php"); 
	require_once("../_tr/arquivo.php");
	require_once("../_tr/mysql.php");
	
	$conexao = conectar();
	verif_log();
       	
	$n_arq = count($_FILES['imagens']['name']);  

	$id = $_SESSION["id"];  

	$dados = sql_select($conexao,"projetos","lb_arquivos,layout_itens,layout_larguras","","id=".$id,false);
	$lb_img = $dados["lb_arquivos"];
	
	$itens_extra = array();
	$larguras_extra = array();
	
	for($i = 0; $i < $n_arq; $i++) { 
		 
		$valores = array( 	array("id", 0), 
						 	array("tipo", "img"), 
						 	array("id_projeto", $id));
		
		sql_insert( $conexao, "arquivos", $valores); 
		$id_img = mysqli_insert_id ( $conexao );
		 
		list($width, $height) = getimagesize($_FILES['imagens']['tmp_name'][$i]);
		
		($width > 900)?($g = 900):($g = $width);
		($width > 650)?($m = 650):($m = $width);
		($width > 350)?($p = 350):($p = $width);
		
		up_img_var ("imagens",$i,"w",$p,"../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_p","jpeg");
		up_img_var ("imagens",$i,"w",$m,"../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_m","jpeg");
		up_img_var ("imagens",$i,"w",$g,"../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_g","jpeg");
		up_img_fixo ("imagens",$i,36,36,"../../projetos/projeto".$id."/TRCOM_".$lb_img."_".$id_img."_tb","jpeg");
		  
		array_push($itens_extra, 'item'.$id_img );
		array_push($larguras_extra, 'w100' );
	
	}

	//atualiza layout  
	
	$layout_itens = $dados['layout_itens'];
	$layout_larguras = $dados['layout_larguras'];  

	if(!empty($dados['layout_itens'])){
		$layout_itens .= ',';
		$layout_larguras .= ',';	
	}

	$layout_itens .= join(",",$itens_extra);
	$layout_larguras .= join(",",$larguras_extra); 

	$dados = array(	array("layout_itens", $layout_itens),
				   	array("layout_larguras", $layout_larguras)
					);
 
	sql_update($conexao, "projetos", $dados, "id='".$id."'" ); 
	
	xml_projeto( $conexao, $id);
	
	
?> 