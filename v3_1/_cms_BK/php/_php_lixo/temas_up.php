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
	
	for($i = 0; $i < $n_arq; $i++) { 		
		
		list($width, $height) = getimagesize($_FILES['imagens']['tmp_name'][$i]);
		
		if($width < $height) $ref = $width; 
		else $ref = $height;
		
		($ref > 1200)?($g = 1200):($g = $ref);
		($ref > 800)?($m = 800):($m = $ref);
		($ref > 350)?($p = 350):($p = $ref);		
		
		$valores = array( array("id", 0)); 
		sql_insert( $conexao, "temas", $valores ); 
		
		$id_img = mysqli_insert_id ( $conexao );
		
		up_img_fixo("imagens",$i,$p,$p,"../../temas/tema".$id_img."_p","jpeg"); 
		up_img_fixo("imagens",$i,$m,$m,"../../temas/tema".$id_img."_m","jpeg"); 
		up_img_fixo("imagens",$i,$g,$g,"../../temas/tema".$id_img."_g","jpeg");  
		

	} 
	
?> 