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
require_once("_editor/tiny_mce.php");     

$id = $_GET['id'];	
$evento = sql_select( $conexao, "timeline", "*", "", "id=".$id, false );
$projetos_opt = array();
$projetos = sql_select( $conexao, "projetos", "*", "", "", true );

?>
<body>  
	
	 <?php  
	
		div1( "container", "", "", "", false ); 
			topo($lg_arr);
			
			div1( "navega", "", "", "", false ); 
				menu( $menu_arr, 'thomaz_dados.php' ); 
				submenu( $submenu_thomaz, 'thomaz_timeline.php' ); 
				barra( "","", $evento['titulo'.lg()], false, 'thomaz_timeline.php', false );  
			div2();

			div1( "conteudo", "", "", "", false ); 
				
				form1("", "", "php/thomaz_timeline_dados_altera.php", "post");  
					
					input("titulo".lg(), "", "titulo".lg(), "text",  $evento["titulo".lg()], "TÍTULO", false, true);
					input("subtitulo".lg(), "", "subtitulo".lg(), "text",  $evento["sub".lg()], "SUBTÍTULO", false, true);
					input("titulo".lg(), "", "titulo".lg(), "text",  verifica_data($evento["data_ini"]), "DATA INICIAL", false, false);
					input("titulo".lg(), "", "titulo".lg(), "text",  verifica_data($evento["data_fim"]), "DATA FINAL", false, false); 
					input("url", "", "url", "text",  $evento["url"], "URL", false, false);

					for($i=0; $i<count($projetos); $i++){
						array_push( $projetos_opt, array( $projetos[$i]["projeto".lg()], $projetos[$i]["id"] ));
					}

					select( "id_projeto", "", "id_projeto", "", false, $projetos_opt, array( $evento['id_projeto']), array('PROJETO',0)); 
					gravar("GRAVAR");  
				
				form2();
				
			bt_topo();  
			div2();  
		div2(); 
		
		mensagem(); 
		tr_js();
	
	 ?>  
	
</body>
</html>
