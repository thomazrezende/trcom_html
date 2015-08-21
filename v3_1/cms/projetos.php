<?php 
require_once("../../../_control/acesso.php");
require_once("../../../_control/seguranca.php");
require_once("_menus.php");
require_once("_tr/mysql.php");
require_once("_tr/html.php"); 
require_once("_tr/string.php"); 

verif_log();
$conexao = conectar();

head("CMS TRCOM");  
  
$projetos = sql_select( $conexao,"projetos","*","id DESC","",true);

?>
<body>  
	
	
	 <?php  
	
		div1( "container", "", "", "", false );
			
			topo($lg_arr);
			
			div1( "navega", "", "", "", false );
				menu( $menu_arr, 'projetos.php' );
			div2();

			div1( "conteudo", "", "", "", false );
				
				form1("", "", "php/projeto_insere.php", "post");  
					input("titulo".lg(), "", "titulo".lg(), "text", "", "NOVO PROJETO (título)", false, true ); 
					submit("bt_mais","btg","INSERIR");  
				form2();

				ul1("","lista");
			
					for($i=0; $i<count($projetos); $i++){  
						
						if($projetos[$i]["publicado".lg()] == "1"){ 
						
							$id = $projetos[$i]["id"];
							$lb = caps($projetos[$i]["projeto".lg()]);
							$lb_extra = "";
							$html_ext = item_suporte("bg".$projetos[$i]["id_suporte"]);
							$tb = verifica_tb('../projetos/projeto'.$id.'/tbp.jpg', '_layout/tb_generica.png'); 
							$link = array( "php/escolhe_projeto.php?id=".$id, "_self" );   
							$bts = array( 	array( "del", "php/projeto_remove.php?id=".$id ),
											array( "destaque", "php/projeto_destaque_altera.php?id=".$id, $projetos[$i]["dd_portfolio"] )); 

							item( 'projeto'.$id, $tb, $lb, $lb_extra, $html_ext, $link, $bts, false );
						}
					} 

					titulo('mt30', "NÃO PUBLICADOS", false);

					for($i=0; $i<count($projetos); $i++){  
						
						if($projetos[$i]["publicado".lg()] == "0"){ 
						
							$id = $projetos[$i]["id"];
							$lb = caps($projetos[$i]["projeto".lg()]);
							$lb_extra = '';
							$html_ext = item_suporte("bg".$projetos[$i]["id_suporte"]);
							$tb = verifica_tb('../projetos/projeto'.$id.'/tbp.jpg', '_layout/tb_generica.png');
							$link = array( "php/escolhe_projeto.php?id=".$id, "_self" );   
							$bts = array( 	array( "del", "php/projeto_remove.php?id=".$id ),
											array( "destaque", "php/projeto_destaque_altera.php?id=".$id, $projetos[$i]["dd_portfolio"] )); 

							item( 'projeto'.$id, $tb, $lb, $lb_extra, $html_ext, $link, $bts, false );
						}
					} 

				ul2();

			bt_topo();  
			div2();  
		div2(); 
		
		mensagem(); 
		tr_js();

	?>  
	

</body>
</html>
