<?php
		
		
		$lg_arr = array( 			array("pt-br","_pt"),
									array("en","_en"));    
		
		$menu_arr = array(			array("thomaz","thomaz_dados.php"),
									array("clientes","clientes.php"),
									array("projetos","projetos.php")); 

   		$submenu_thomaz = array(	array("dados","thomaz_dados.php"), 
									array("timeline","thomaz_timeline.php"),
									array("senha","thomaz_senha.php"));  

		$submenu_clientes = array(	array("dados","cliente_dados.php"),  
									array("logo","cliente_logo.php"));
		
		$submenu_projeto = array( 	array("dados","projeto_dados.php"),
									array("thumb","projeto_tb.php"),
									array("display","projeto_display.php"),
									array("arquivos","projeto_arquivos.php"),
									array("layout","projeto_layout.php"),
									array("relacionados","projeto_relacionados.php"), 
									array("story board","projeto_sb.php"));		 
   		 

		/*
		$menu_arr = array(			array(	"1|thomaz|thomaz_dados.php", 
										  	array(	"1.1|dados|thomaz_dados.php",
													"1.2|timeline|thomaz_timeline.php",
													"1.3|senha|thomaz_senha.php")),						  			
									array(	"2|projetos|projetos.php", 
											array(	"2.1|dados|projeto_dados.php",
													"2.2|thumb|projeto_tb.php",
													"2.3|display|projeto_display.php",
													"2.4|arquivos|projeto_arquivos.php", 
													array(	"2.4.1|arquivo dados|arquivo_dados.php",
															"2.4.2|arquivo imagem|arquivo_img.php"),
													"2.5|layout|projeto_layout.php",
													"2.6|relacionados|projeto_relacionados.php",
													"2.7|story board|projeto_sb.php", 
													"2.8|preview|../projeto.php")),						  
									array( 	"3|destaques|destaques.php" ), 
									array( 	"4|clientes|clientes.php" ));   
		 */

