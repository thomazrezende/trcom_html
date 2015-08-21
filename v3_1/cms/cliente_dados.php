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

$id = $_SESSION['id_cliente'];
$cliente = sql_select( $conexao, "clientes", "*", "", "id=".$id, false ); 

//print $id;

?>

<body>   
	
		<?php  
	
		div1( "container", "", "", "", false ); 
			topo($lg_arr);
			
			div1( "navega", "", "", "", false ); 
				menu( $menu_arr, 'clientes.php' ); 
				barra( "","", $cliente['cliente'.lg()], false, 'clientes.php', false );  
				submenu( $submenu_clientes, 'cliente_dados.php' ); 
			div2();

			div1( "conteudo", "", "", "", false );  
	
				form1("", "", "php/thomaz_timeline_dados_altera.php", "post");  

					input( "cliente".lg(), "", "cliente".lg(), "text",  $cliente["cliente".lg()], "NOME", false, true ); 
					input( "site", "", "site", "text",  $cliente["site"], "SITE", false, false ); 
					
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
