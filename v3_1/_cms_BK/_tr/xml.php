<?php 

/* TRCOM */ 

function chama_colunas($colunas){ 
	$nitens=count($colunas); // colunas  um array com os itens a serem listados
	$itens="";
 
	for($i=0;$i<$nitens;$i++){
		$itens.=$colunas[$i];
		if($i<($nitens - 1)) { $itens.=", "; }
		}
	return $itens;
}

function cdata($lb){
	if (substr($lb, 0, 4) == "nome" || 
		substr($lb, 0, 5) == "texto" || 
		substr($lb, 0, 5) == "embed" || 
		substr($lb, 0, 5) == "link" || 
		substr($lb, 0, 5) == "sobre" || 
		substr($lb, 0, 7) == "credito" ||
		substr($lb, 0, 7) == "legenda" ||
		substr($lb, 0, 8) == "endereco" ||
		substr($lb, 0, 3) == "bio" ||
		substr($lb, 0, 9) == "subtitulo"		
		) return true;
	else return false;
}  
  

function xml_bd( $conexao ){ 
	
	$arquivo 	= 	'../../xml/bd.xml';
	$tabelas 	= 	array( 	'dados','projetos','clientes','categorias','marcadores','cidades','equipe','temas');
	$condicoes	=	array( 	false,false,false,false,false,false,false,false);
	$pais	 	= 	array( 	'dados','projetos','clientes','categorias','marcadores','cidades','equipe','temas');
	$filhos 	= 	array( 	false,'projeto','cliente','categoria','marcador','cidade','integrante','tema');	
	$colunas 	= 	array( 	array('email','sobre_pt','sobre_en','instagram','facebook','endereco','telefone','layout_equipe'), //dados
							array('id','codigo','destaque','publicado_pt','publicado_en','sublogo','nome_pt','nome_en','subtitulo_pt','subtitulo_en','cidade','data','categoria','marcadores','cliente','hex_topo','hex_logo','hex_nome','hex_base'), //projetos
							array('id','nome','site'), //clientes
							array('id','nome_pt','nome_en','hex'), //categorias
							array('id','nome_pt','nome_en'), // marcadores
							array('id','nome_pt','nome_en','lat','lng'), // cidades  
							array('id','nome','bio_pt','bio_en'), // equipe 
							array('id','hex_topo','hex_logo','hex_titulo','hex_base','hex_subtitulo','hex_subtitulo_bg') // tema 
					);
	
	xml( $conexao, $arquivo, 'bd', $tabelas, $condicoes, $pais, $filhos, $colunas );
	
}

function verifica_null( $dd, $rt ){
	if( !empty($dd) && $dd != NULL ) return $rt;
	else return false;
}

function multiple_where( $dd, $lb ){  
	
	if(!empty($dd)){ 
		$list = explode( ',', $dd );
		$qt = count($list);  
		$where = "";
		
		for($i=0; $i<$qt; $i++){
			$where .= $lb."='".$list[$i]."' ";
			if( $i<$qt -1 ){  
				$where .= ' OR ';
			}
		}
		
		return $where;
		
	}else{
		return $lb."='0'"; 
	}
}

function xml_projeto( $conexao, $id ){ 
	
	$dados = sql_select( $conexao, "projetos", "*", "", "id=".$id, false );
	
	$cond_dados 	= "id='".$id."'";
	$cond_arquivos	= "id_projeto='".$id."'";
	
	$arquivo 	=	"../../projetos/projeto".$id."/dados.xml";
	$tabelas 	= 	array(	'projetos','arquivos');
	$condicoes	=	array(	$cond_dados, $cond_arquivos );
	$pais	  	= 	array(	'dados','arquivos');	
	$filhos  	= 	array(	false,'arquivo');	
	$colunas 	= 	array(	array('id','codigo','sublogo','nome_pt','nome_en','texto_pt','texto_en','creditos_pt','creditos_en',
								  'subtitulo_pt','subtitulo_en','cidade','data','categoria','marcadores','cliente','hex_topo','hex_logo',
								  'relacionados','lb_arquivos','layout_itens','layout_larguras'), //dados projeto
							array('id','tipo','embed','legenda_pt','legenda_en','link') // arquivos 
					);
	
	xml( $conexao, $arquivo, 'projeto', $tabelas, $condicoes, $pais, $filhos, $colunas );
	xml_bd( $conexao );
} 


function xml( $conexao, $arquivo, $root, $tabelas, $condicoes, $pais, $filhos, $colunas ){ 
	
	// Abre / cria o arquivo xml com permisso para escrever 
	$xml = fopen($arquivo, "w+");
	chmod($arquivo,0644);

	fwrite($xml, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n");  
	fwrite($xml, "<".$root.">\r\n");
	
	for($t=0; $t<count($tabelas); $t++){
	
		$tabela = $tabelas[$t];	 
		$itens = chama_colunas($colunas[$t]); 
		($condicoes[$t])?($condicao = " WHERE ".$condicoes[$t] ):($condicao = '');
		$pai = $pais[$t];
		$filho = $filhos[$t];
		
		$sql="SELECT ".$itens." FROM ".$tabela.$condicao." ;";
		
		$consulta = $conexao->query($sql);  
		$nreg=mysqli_num_rows($consulta); 
		
		fwrite($xml, "\t<".$pai.">\r\n");	 	

		$nrolls=count($colunas[$t]);
		$conteudo="";
		for($i=0; $i<$nreg; $i++) { 

			if($filho){
				$conteudo .= "\t\t<".$filho.">\r\n"; 
				$et = "\t";
			}else{
				$et = "";	
			}

			for($c=0;$c<$nrolls;$c++){
				$lb=$colunas[$t][$c]; 
				if( cdata($lb) ){
					$conteudo .= $et."\t\t<".$lb."><![CDATA[".mysqli_result($consulta,$i,$lb)."]]></".$lb.">\r\n"; 
				}else{
					$conteudo .= $et."\t\t<".$lb.">".mysqli_result($consulta,$i,$lb)."</".$lb.">\r\n"; 
				} 
			} 

			if($filho){
				$conteudo .= "\t\t</".$filho.">\r\n"; 
			}
		}		

		//Escrevendo no xml
		fwrite($xml, $conteudo);

		//Finalizando com a ltima tag 
		fwrite($xml, "\t</".$pai.">\r\n");
	
	} // for tabelas
		
	fwrite($xml, "</".$root.">\r\n");
	
	//Fechando o arquivo 
	fclose($xml); 		
} 	 

function xml_projetos(){
	$arquivo="../../xml/projetos.xml";
	$colunas=array("id","publicado","titulo","lat","lng","zoom","resumo");
	$join = array(
		array(	"resultados", // table to join / pai
			  	"resultado",  // filho
 				"id_projeto", // label id ex:id_projeto
			    array("id", "titulo", "label", "titulo_legenda", "legenda")),// colunas join
		array(	"arquivos", // table to join / pai
			  	"arquivo",  // filho
 				"id_projeto", // label id ex:id_projeto
			    array("id","grupo","titulo", "label")) // colunas join
	); 
	xml_join($arquivo, "projetos", "projeto", "projetos", $colunas, "ORDER BY id DESC",false, $join);
}


/*
EXEMPLO DO XML() COM mysqlis

$join = array(
array(	"arquivos", // table to join / pai
		"arquivo",  // filho
		"id_projeto", // label id ex:id_projeto
		array("id", "tipo", "embed", "legenda_pt", "legenda_en", "link"))// colunas join
); 

 //$conexao, $arquivo, $pai, $filho, $tabela, $colunas, $condicao, $numerar_itens, $join
xml($conexao, "../../teste.xml","projeto","","projetos" ,array('id','nome_pt'),"WHERE id='1'", false, $join);
*/


function xml_projeto_completo( $conexao, $id ){  // problema de atualização: se mudar lat da cidade depois de gerar esse xml, o valor novo não aparece 
	
	$dados = sql_select( $conexao, "projetos", "*", "", "id=".$id, false );
	
	$cond_dados 	= "id='".$id."'";
	$cond_projetos	= multiple_where( $dados['relacionados'], "id" ); 
	$cond_cliente 	= verifica_null( $dados['cliente'], "id='".$dados['cliente']."'"); 
	$cond_categoria = verifica_null( $dados['categoria'], "id='".$dados['categoria']."'" );
	$cond_marcadores= multiple_where( $dados['marcadores'], "id" ); 
	$cond_cidade 	= verifica_null( $dados['cidade'], "id='".$dados['cidade']."'" );
	$cond_arquivos	= "id_projeto='".$id."'";
	
	$arquivo 	=	"../../projetos/projeto".$id."/dados.xml";
	$tabelas 	= 	array(	'projetos','projetos','clientes','categorias','marcadores','cidades','arquivos');
	$condicoes	=	array(	$cond_dados, $cond_projetos, $cond_cliente, $cond_categoria, $cond_marcadores, $cond_cidade, $cond_arquivos );
	$pais	  	= 	array(	'dados','relacionados','clientes','categorias','marcadores','cidades','arquivos');	
	$filhos  	= 	array(	false,'projeto','cliente','categoria','marcador','cidade','arquivo');	
	$colunas 	= 	array(	array('id','codigo','sublogo','nome_pt','nome_en','texto_pt','texto_en','creditos_pt','creditos_en',
								  'subtitulo_pt','subtitulo_en','cidade','data','categoria','marcadores','cliente','hex_topo',
								  'relacionados','lb_arquivos','layout_itens','layout_larguras'), //projeto principal						  
							array('id','sublogo','nome_pt','nome_en','categoria'), //relacionados
							array('id','nome','site'), //clientes
							array('id','nome_pt','nome_en','hex'), //categorias
							array('id','nome_pt','nome_en'), // marcadores
							array('id','nome_pt','nome_en','lat','lng'), // cidades 
							array('id','tipo','embed','legenda_pt','legenda_en','link') // arquivos 
					);
	
	xml( $conexao, $arquivo, $tabelas, $condicoes, $pais, $filhos, $colunas );
	
}

function xml_projeto_ANTIGO2( $conexao, $id ){
	$arquivo="../../projetos/projeto".$id."/dados.xml";
	$colunas = array(	'id','codigo','destaque','publicado_pt','publicado_en','sublogo',
						'nome_pt','nome_en','subtitulo_pt','subtitulo_en','cidade','data',
						'categoria','marcadores','cliente','hex_topo','hex_nome','hex_base',
						'texto_pt','texto_en','creditos_pt','creditos_en','relacionados',
						'lb_arquivos','layout_itens','layout_larguras');
	$join = array(
		array(	"arquivos", // table to join / pai
			  	"arquivoo",  // filho
 				"id_projeto", // label id ex:id_projeto
			    array("id", "tipo", "embed", "legenda_pt", "legenda_en", "link"))// colunas join
	); 
	xml( $conexao, $arquivo, "dados", "", "projetos", $colunas, "WHERE id='".$id."'", false, $join);
	xml_bd($conexao);
}		

 ////////////// xml ANTIGOS //////////////

function xml_join( $conexao, $arquivo, $pai, $filho, $tabela, $colunas, $condicao, $numerar_itens, $join ){
	
	//exemplo xml($conexao, "../../teste.xml","projeto","","projetos" ,array('id','nome_pt'),"WHERE id='1'", false, false);
	//$numerar_itens: boolean - insere o id do item na tag 
	 
	$itens = chama_colunas($colunas);//array com itens a serem selecionados
	 
	$sql = "SELECT ".$itens." FROM ".$tabela." ".$condicao.";";
	$consulta = $conexao->query($sql);  
	$nreg = mysqli_num_rows($consulta); 
	  
	// Abre / cria o arquivo xml com permisso para escrever 
	$xml = fopen($arquivo, "w+");
	chmod($arquivo,0644);
 
	//Escreve o cabealho e o primeiro n do xml 
	fwrite($xml, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n"); 
	fwrite($xml, "<".$pai.">\r\n");	 		
 
 	//cria conteudo
	$nrolls=count($colunas);
	$conteudo="";
	for($i=0; $i<$nreg; $i++) { 
		 
		if(isset($filho) && !empty($filho)){
			$id_filho = mysqli_result($consulta,$i,"id"); 
				if($numerar_itens) $conteudo .= "\t<".$filho.$id_filho.">\r\n";
				else $conteudo .= "\t<".$filho.">\r\n";  
			}  
			
			for($c=0;$c<$nrolls;$c++){
				$lb=$colunas[$c]; 
				if( cdata($lb) ){
					$conteudo .= "\t\t<".$lb."><![CDATA[".mysqli_result($consulta,$i,$lb)."]]></".$lb.">\r\n"; 
				}else{
					$conteudo .= "\t\t<".$lb.">".mysqli_result($consulta,$i,$lb)."</".$lb.">\r\n"; 
				} 
			}
		
			////////// join
		
			if($join){ 
				
				$id = mysqli_result($consulta,$i,'id'); 
				$n_join = count($join);
				
				for($t=0; $t<$n_join; $t++){
					
					$itens_join = chama_colunas( $join[$t][3] );
					
					$sql_join="SELECT ".$itens_join." FROM ".$join[$t][0]." WHERE ".$join[$t][2]."='".$id."';";
					$consulta_join = $conexao->query($sql_join);
					$nreg_join = mysqli_num_rows($consulta_join); 
					
					$conteudo .= "\t\t<".$join[$t][0].">\r\n"; 
					
					for($j=0; $j<$nreg_join; $j++){ // para cada resultado
						
						if( !empty($join[$t][1])){
							$conteudo .= "\t\t\t<".$join[$t][1].">\r\n";
						}
						
						for($cj=0; $cj<count($join[$t][3]); $cj++){ // para cada coluna no resultado 
							
							$lb_join = $join[$t][3][$cj]; 
							
							if( cdata($lb_join) ){
								$conteudo .= "\t\t\t\t<".$lb_join."><![CDATA[".mysqli_result($consulta_join,$j,$lb_join)."]]></".$lb_join.">\r\n";  
							}else{
								$conteudo .= "\t\t\t\t<".$lb_join.">".mysqli_result($consulta_join,$j,$lb_join)."</".$lb_join.">\r\n"; 
							} 
						}  
					   
						if( !empty($join[$t][1])){					
							$conteudo .= "\t\t\t</".$join[$t][1].">\r\n"; 
						} 
					}
					
					$conteudo .= "\t\t</".$join[$t][0].">\r\n"; 
				}
				
			}
		
			////////// /join
		 
	 		if(isset($filho) && !empty($filho)){ 
				if($numerar_itens) $conteudo .= "\t</".$filho.$id_filho.">\r\n";
				else $conteudo .= "\t</".$filho.">\r\n";
			}
	    }		
		
	  //Escrevendo no xml
	  fwrite($xml, $conteudo);
 
	//Finalizando com a ltima tag 
	fwrite($xml, "</".$pai.">");
	
	//Fechando o arquivo 
	fclose($xml); 		
} 	


 function xml_projeto_ANTIGO($id){ 
	
	$colunas = array("id","publicado","titulo","lat","lng","zoom","sobre");
	$itens = chama_colunas($colunas);
			
	$arq_xml="../../projetos/projeto".$id."/dados.xml";
	
	$sql="SELECT ".$itens." FROM projetos WHERE id=".$id.";";
	$consulta=mysql_query($sql) or die(mysql_error());
	$ok=mysql_query($sql) or die(mysql_error());
	 
	// Abre / cria o arquivo xml com permisso para escrever 
	$xml = fopen($arq_xml, "w+");
	chmod($arq_xml,0644);
 
	//Escreve o cabealho e o primeiro n do xml 
	fwrite($xml, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n"); 
	fwrite($xml, "<projeto>\r\n");
	fwrite($xml, "\t<dados>\r\n");
 
 	//cria conteudo
	$nrolls=count($colunas);
	$conteudo="";
		
		for($c=0;$c<$nrolls;$c++){
			$lb=$colunas[$c];
			$conteudo .= "\t\t<".$lb."><![CDATA[".mysqli_result($consulta,0,$lb)."]]></".$lb.">\r\n";
		}
				
	  //Escrevendo no xml
	  fwrite($xml, $conteudo);
 
	//Finalizando com a ltima tag 
	fwrite($xml, "\t</dados>\r\n");
	
	 /*
	// arquivos 
	fwrite($xml, "\t<arquivos>\r\n");
	$colunas_arq = array("id","id_projeto","file","embed","autoplay");
	$nrolls_arq=count($colunas_arq);
	
	$sql_arq="SELECT * FROM arquivos WHERE id_projeto='".$id."'";
	$consult_arq=mysql_query($sql_arq) or die(mysql_error());
	while($result=mysql_fetch_assoc($consult_arq)){
		
		//cria conteudo
		$conteudo_arq="";
		$conteudo_arq.="\t\t<arquivo>\r\n";
			
			for($a=0;$a<$nrolls_arq;$a++){
				$lb_arq=$colunas_arq[$a];
				$conteudo_arq.= "\t\t\t<".$lb_arq."><![CDATA[".$result[$lb_arq]."]]></".$lb_arq.">\r\n"; 
			}
			
		$conteudo_arq.="\t\t</arquivo>\r\n";
		 //Escrevendo no xml
	  	fwrite($xml, $conteudo_arq);
	}	
	fwrite($xml, "\t</arquivos>\r\n");  
	*/
	 
	fwrite($xml, "</projeto>\r\n");
	//Fechando o arquivo 
	fclose($xml); 
	
	xml_projetos();
}
 


?>