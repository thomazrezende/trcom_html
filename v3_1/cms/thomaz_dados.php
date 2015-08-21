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
require_once("_tr/up_file_form.php"); 

$dados = sql_select($conexao, "thomaz", "*", "", "", false);  

?>

<body> 
	
    <?php  
	
		div1( "container", "", "", "", false );
			
			topo($lg_arr);
			
			div1( "navega", "", "", "", false ); 
				menu( $menu_arr, 'thomaz_dados.php' );   
				submenu( $submenu_thomaz, 'thomaz_dados.php' );  
			div2();

			div1( "conteudo", "", "", "", false );  
				form1("altera", "", "php/dados_altera.php", "post");  
					input("email", "", "email", "text", $dados["email"], "E-MAIL", false, false );  
					input("cel", "", "cel", "text", $dados["cel"], "CELULAR", false, false );
					text("tx_sobre".lg(), "", "tx_sobre".lg(), "SOBRE", $dados["tx_sobre".lg()], true); 
					text("tx_cv".lg(), "", "tx_cv".lg(), "CV", $dados["tx_cv".lg()], true); 
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
