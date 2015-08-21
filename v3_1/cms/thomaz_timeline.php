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

$timeline = sql_select( $conexao, "timeline", "*", "data_fim DESC", "", true );   

?>	
<body>  
    
	 <?php  
	
		div1( "container", "", "", "", false );
			
			topo($lg_arr);
			
			div1( "navega", "", "", "", false ); 
				menu( $menu_arr, 'thomaz_dados.php' ); 
				submenu( $submenu_thomaz, 'thomaz_timeline.php' );  
			div2();  

			div1( "conteudo", "", "", "", false ); 
				
				form1("", "", "php/timeline_insere.php", "post"); 
					
					input("titulo".lg(), "", "titulo".lg(), "text", "", "NOVO REGISTRO (T&Iacute;TULO)", false, false ); 
					submit("bt_mais","btg","INSERIR"); 

				form2();

				ul1("","lista");
			
					for($i=0; $i<count($timeline); $i++){  

						$id = $timeline[$i]["id"];
						$data = " [".$timeline[$i]["data_fim"]."]";
						if( $timeline[$i]["data_ini"] != "0000-00-00" ) $data = " [".$timeline[$i]["data_ini"]." &rarr; ".$timeline[$i]["data_fim"]."]"; 
						$lb = caps($timeline[$i]["titulo".lg()]);
						$html_ext = '';
						$link = array( "thomaz_timeline_dados.php?id=".$id, "_self" );
						$bts = array( 	array( "del", "php/timeline_remove.php?id=".$id ));

						item( 'tl'.$id, false, $lb, $data, $html_ext, $link, $bts, false );
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
