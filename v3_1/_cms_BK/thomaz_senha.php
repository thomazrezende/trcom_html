<?php
require_once("../../../_control/acesso.php");
require_once("../../../_control/seguranca.php");
require_once("_tr/mysql.php");
require_once("_tr/html.php"); 
require_once("_tr/string.php"); 
require_once("_menus.php");
 
verif_log(); 
$conexao = conectar();

head("TRCOM_SENHA");    
require_once("_editor/tiny_mce.php");

$dados = sql_select($conexao,"dados", "*", "", "", false); 

?>
<body>  
    
	<?php menu($menu_arr, $lg_arr, "_layout/logo_admin.png", 1, true); ?>
	 
    <div id="cont">  
 	
        <div id="dados"> 
           
            <?php
 
				mensagem();
				navega(array("TRCOM"));

				submenu($submenu_dados, 2);
			
				form1("senha", "", "php/senha_altera.php", "post");
             
					titulo("mt0","SENHA ATUAL",false);
					input("senha_atual", "input", "senha_atual", "password", "", "", false);
					
					titulo("","SENHA NOVA",false);
					input("senha_nova", "input", "senha_nova", "password", "", "", false);
					
					titulo("","CONFIRME A SENHA NOVA",false);
					input("senha_confirma", "input", "senha_confirma", "password", "", "", false);
					
					submit("GRAVAR"); 
				
				form2();
            ?>
        
        </div> <!--dados--> 
        
    </div> <!--cont-->

</body>
</html>
