<?php
require_once("../../../_control/acesso.php");
require_once("../../../_control/seguranca.php");
require_once("_menus.php");
require_once("_tr/mysql.php");
require_once("_tr/html.php"); 
require_once("_tr/string.php"); 

verif_log();
$conexao = conectar();

head("TRCOM_DADOS");  
require_once("_editor/tiny_mce.php");
require_once("_tr/up_file_form.php"); 

$dados = sql_select($conexao, "thomaz", "*", "", "", false);  

?>

<body>  
	<div id="container">  
           
           <?php 
 
				bt_voltar( "lista","thomaz_senha.php" );  
				submenu( $submenu_projeto, 1 );
				
				div1( "conteudo", "", "", "", false );

					form1("altera", "", "php/dados_altera.php", "post");  

						input("email", "", "email", "text", $dados["email"], "E-MAIL", false, false );  
						input("cel", "", "cel", "text", $dados["cel"], "CELULAR", false, false );
						text("tx_sobre".lg(), "", "tx_sobre".lg(), "SOBRE", $dados["tx_sobre".lg()], true); 
						text("tx_cv".lg(), "", "tx_cv".lg(), "CV", $dados["tx_cv".lg()], true); 
						
						bt_gravar("GRAVAR");

					form2();  
 				
				div2();

				mensagem();  

				// MENU
				menu( $menu_arr, $lg_arr, 1 ); 

            ?> 
        
       
    </div> <!--container--> 
</body>
</html>
