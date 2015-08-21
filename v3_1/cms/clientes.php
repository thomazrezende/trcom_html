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
  
$clientes = sql_select( $conexao, "clientes", "*", "cliente".lg(), "", true ); 

?>
<body>  
    
	 <?php  
	
		div1( "container", "", "", "", false );
			
			topo($lg_arr);
			
			div1( "navega", "", "", "", false );
				menu( $menu_arr, 'clientes.php' );
			div2();

			div1( "conteudo", "", "", "", false );
				
				form1("", "", "php/cliente_insere.php", "post");  
					input("titulo".lg(), "", "titulo".lg(), "text", "", "NOVO CLIENTE (nome)", false, true ); 
					submit("bt_mais","btg","INSERIR");  
				form2();

				ul1("","lista");
			
					for($i=0; $i<count($clientes); $i++){  

						$id = $clientes[$i]["id"];
						$lb = caps($clientes[$i]["cliente".lg()]);
						$lb_extra = '';
						$html_ext = '';
						$tb = verifica_tb('../clientes/cliente'.$id.'.png', '_layout/tb_generica.png');
						$link = array( "php/escolhe_cliente.php?id=".$id, "_self" );
						$bts = array( 	array( "del", "php/cliente_remove.php?id=".$id ));

						item( 'tl'.$id, $tb, $lb, $lb_extra, $html_ext, $link, $bts, false );
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
