<?php
require_once("../../../_control/acesso.php");
require_once("../../../_control/seguranca.php");
require_once("_tr/mysql.php");
require_once("_tr/html.php"); 
require_once("_tr/string.php"); 
require_once("_menus.php");

verif_log(); 
$conexao = conectar();

head("CLIENTES : ".$_GET["id"]);  
require_once("_tr/up_file_form.php");  
?>

<body>  
    
	<?php menu($menu_arr, $lg_arr, "_layout/logo_admin.png", 5, true); ?>
	 
    <div id="cont">
      	<div id="dados">
			
			<?php

			$id = $_GET["id"];
			
			//SQL
			$dados = sql_select($conexao,"clientes","*","","id=".$id,false);
			
			mensagem();	 
			navega(array(array("CLIENTES","clientes.php"), $id.". ".$dados["nome"] ));  

			form1("altera", "", "php/cliente_altera.php?id=".$id, "post");    
				titulo("","NOME", false);
				input("nome", "input", "nome", "text", $dados["nome"],"","",false); 
				
				titulo("","SITE", false);
				input("site", "input", "site", "text", $dados["site"],"","",false); 

				submit("GRAVAR");
			form2();

			hr();
			
			titulo("","&darr; LOGO (350 x 350px)", false);
			up_file_form("_logo", "arquivo", "php/cliente_logo_up.php?id=".$id, "arquivo", false, true, "jpg,gif,png"); 

			preview("../clientes/cliente".$id."/logo.jpg", "img");
			
			?>
        
        </div> <!--dados-->  
    </div> <!--cont-->  

</body>
</html>
