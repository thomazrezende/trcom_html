<?php
require_once("../../../_control/acesso.php");
require_once("../../../_control/seguranca.php");
require_once("_tr/mysql.php");
require_once("_tr/html.php"); 
require_once("_tr/string.php"); 
require_once("_menus.php");
 
verif_log(); 
$conexao = conectar();

head("CLIENTES"); 
?>
<body>   
	
		<?php menu($menu_arr, $lg_arr, "_layout/logo_admin.png", 5, true); ?>
	 
    <div id="cont">
        <div id="dados">
        
            <?php

			mensagem();
			navega(array("CLIENTES"));
			
			$clientes = sql_select($conexao, "clientes","*","nome","",true );  
			
			form1("novo", "", "php/cliente_insere.php", "post"); 
				
				titulo("mt0","&darr; NOVO CLIENTE (nome)",false);
				input("nome", "input", "nome", "text", "", "", false);
				submit("INSERIR");
			
			form2();
			
			titulo("","CLIENTES",false);
			
			ul1("itens",'');
			
			for($i=0; $i<count($clientes); $i++){  
				
				$id = $clientes[$i]["id"];
				$tb = verifica_tb("../clientes/cliente".$id."/logo.jpg",'_layout/ico_client.png');
				$lb = $id." _ ".$clientes[$i]["nome"];
				$lb_ext = "";
				$link = array("cliente.php?id=".$id, false);

				$bts = array( array( "del", "php/cliente_remove.php?id=".$id )); 

				item('item'.$id, $tb, $lb, $lb_ext, $link, $bts, false);
				
			}
			
			ul2(); 
			clear();
			
			?> 
			
			
        </div> <!--dados--> 
        
    </div> <!--cont-->

</body>
</html>
