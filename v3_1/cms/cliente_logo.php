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
require_once("_tr/up_file_form.php");

$id = $_SESSION['id_cliente'];
$cliente = sql_select( $conexao, "clientes", "*", "", "id=".$id, false );  

?>

<body>
	
	<?php
	
		div1( "container", "", "", "", false ); 
			
			topo($lg_arr);
			
			div1( "navega", "", "", "", false ); 
				menu( $menu_arr, 'clientes.php' ); 
				barra( "","", $cliente['cliente'.lg()], false, 'clientes.php', false );  
				submenu( $submenu_clientes, 'cliente_logo.php' ); 
			div2();

			div1( "conteudo", "", "", "", false );
	
				up_file_form("_logo", "arquivo", "php/cliente_logo_up.php", "arquivo", false, true, "jpg,gif,png");  
				preview("../clientes/cliente".$id.".png", "img");
				
			bt_topo();
			div2(); 

		div2(); 
		  
		mensagem(); 
		tr_js(); 

	?>

</body>
</html>
