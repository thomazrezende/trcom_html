<?php
require_once("../../../_control/acesso.php");
require_once("../../../_control/seguranca.php");
require_once("_tr/mysql.php");
require_once("_tr/html.php"); 
require_once("_tr/string.php"); 
require_once("_menus.php");
 
verif_log(); 
$conexao = conectar();

head("CATEGORIAS"); 
require_once("_tr/paleta.php"); 
require_once("_tr/paleta_cores_TRCOM.php"); 
?>
<body>   
	
		<?php menu($menu_arr, $lg_arr, "_layout/logo_admin.png", 3, true); ?>
	 
    <div id="cont">
        <div id="dados">
        
            <?php

			mensagem();
			navega(array("CATEGORIAS"));
			
			$categorias = sql_select($conexao, "categorias","*","id","",true );  
			
			form1("novo", "", "php/categoria_insere.php", "post"); 
				
				titulo("mt0","&darr; NOVA CATEGORIA (nome)",true);
				input(lg("nome"), "input", lg("nome"), "text", "", "", false);
				submit("INSERIR");
			
			form2();

			form1("novo", "", "php/categorias_altera.php", "post"); 
			ul1("itens",false); 
			
			$usadas = "";

			for($i=0; $i<count($categorias); $i++){  

				$id = $categorias[$i]["id"];
				$tb =  '_layout/ico_categ.png';
				$lb = "CATEGORIA ".$id;
				$lb_ext = img( "", "item_band", "_layout/".lg("bandeira").".jpg", true, false);
				$lb_ext .= input("", "item_input input2", lg("nome").$id, 'text', $categorias[$i][lg("nome")], lg(''), true);
				$lb_ext .= "<span style='margin-left:10px'>COR</span> ";
				$lb_ext .= input( "hex".$id, "item_input _layout", "hex".$id, 'text', $categorias[$i]["hex"], '#',  true);
				$link = false;

				$bts = array( array( "del", "php/categoria_remove.php?id=".$id )); 

				item('item'.$id, $tb, $lb, $lb_ext, $link, $bts, false);
				
				$usadas .= $categorias[$i]["id"] . '|' . $categorias[$i]["hex"];
				if($i<count($categorias)-1) $usadas .= ',';
			
			} 
			
			input('usadas', "input", 'usadas', "hidden", $usadas, "", false);

			ul2();  
	
			submit("GRAVAR");
			
			form2(); 

			?> 
			
			
			
			
			
        </div> <!--dados--> 
        
    </div> <!--cont-->

</body>
</html>
