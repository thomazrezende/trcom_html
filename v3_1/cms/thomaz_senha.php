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

$dados = sql_select($conexao, "thomaz", "*", "", "", false);  

?>
<body>  
	
	
	 <?php  
	
		div1( "container", "", "", "", false );
			
			topo($lg_arr);
			
			div1( "navega", "", "", "", false ); 
				menu( $menu_arr, 'thomaz_dados.php' );  
				submenu( $submenu_thomaz, 'thomaz_senha.php' );  
			div2();

			div1( "conteudo", "", "", "", false ); 

				form1("senha", "", "php/thomaz_senha_altera.php", "post");
	
					input("senha_atual", "", "senha_atual", "password", "", "SENHA ATUAL", false, false );
					input("senha_nova", "", "senha_nova", "password", "", "SENHA NOVA", false, false );
					input("senha_confirma", "", "senha_confirma", "password", "", "CONFIRME A SENHA NOVA", false, false ); 
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
