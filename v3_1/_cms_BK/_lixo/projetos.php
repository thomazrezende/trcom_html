<?php
require_once("../../../_control/acesso.php");
require_once("../../../_control/seguranca.php");
require_once("_tr/mysql.php");
require_once("_tr/html.php"); 
require_once("_tr/string.php"); 
require_once("_menus.php");
 
verif_log(); 
$conexao = conectar();

head("PROJETOS"); 
?>
<body>   
	
		<?php menu($menu_arr, $lg_arr, "_layout/logo_admin.png", 7, true); ?>
	 
    <div id="cont">
        <div id="dados">
        
            <?php

			mensagem();	
			navega(array("PROJETOS"));
			
			$projetos = sql_select($conexao,"projetos","*","id DESC","",true);
			$categorias = sql_select($conexao,"categorias","*","id DESC","",true);   
			
			$hex_categ = '#000';
			$nome_categ = '';

			form1("novo", "", "php/projeto_insere.php", "post"); 
					
				titulo("mt0","&darr; NOVO PROJETO (nome)", true);
				input(lg('nome'), "input", lg('nome'),"text", "","", "");
				submit("INSERIR");
			 
			form2();
			titulo("","PUBLICADOS",true);   

			ul1("itens",'');
			
			for($i=0; $i<count($projetos); $i++){ 
			
				if($projetos[$i][lg("publicado")] == "1"){ 
					
						
					for($c=0; $c<count($categorias); $c++){
						if($categorias[$c]['id'] == $projetos[$i]['categoria']){							
							$hex_categ = $categorias[$c]['hex'];
							$nome_categ = $categorias[$c][lg('nome')];
							break;
						}
					}
					
					$ano = explode("-", $projetos[$i]["data"]);
					
					$id = $projetos[$i]["id"];
					$lb_arquivos = $projetos[$i]["lb_arquivos"];
					$tb = verifica_tb("../projetos/projeto".$id."/tbp.jpg","_layout/ico_compass.png");
					$lb = $projetos[$i]["codigo"];
					$lb_ext = " :: ".$projetos[$i][lg("nome")]; 
					$lb_ext .= " :: <span style='font-wheigth:bold; color:".$hex_categ."'>".$nome_categ."</span>";
					$lb_ext .= " ".$ano[0];
					$link = array("php/escolhe_projeto.php?id=".$id, false);
					
					$destaque = false;
					if($projetos[$i]["destaque"] == 1) $destaque = true;
					
					$bts = array (	array( "del", "php/projeto_remove.php?id=".$id ),
									array( "destaque", "php/projeto_destaque_altera.php?id=".$id, $destaque )); 
				
					item('item'.$id, $tb, caps($id.". ".$lb), $lb_ext, $link, $bts, false);
				}
			}
			
			ul2();
			clear();
			titulo("","N&Atilde;O PUBLICADOS ",true); 
			
			ul1("lista_off",'');

			for($i=0; $i<count($projetos); $i++){ 
				
				if($projetos[$i][lg("publicado")] == "0"){
					
					for($c=0; $c<count($categorias); $c++){
						if($categorias[$c]['id'] == $projetos[$i]['categoria']){							
							$hex_categ = $categorias[$c]['hex'];
							$nome_categ = $categorias[$c][lg('nome')];
							break;
						}
					}
					
					$ano = explode("-", $projetos[$i]["data"]);
					
					$id = $projetos[$i]["id"];
					$lb_arquivos = $projetos[$i]["lb_arquivos"];
					$tb = verifica_tb("../projetos/projeto".$id."/tbp.jpg","_layout/ico_compass.png");
					$lb = $projetos[$i]["codigo"];
					$lb_ext = " : ".$projetos[$i][lg("nome")]; 
					$lb_ext .= " &ndash; <span style='font-wheigth:bold; color:".$hex_categ."'>".$nome_categ."</span>";
					$lb_ext .= " ".$ano[0];
					$link = array("php/escolhe_projeto.php?id=".$id, false);
					
					$bts = array (array( "del", "php/projeto_remove.php?id=".$id )); 
				
					item($id, $tb, caps($id.". ".$lb), $lb_ext, $link, $bts, false);
				}
			}  
			
			ul2(); 
			
			?> 
			
        </div> <!--dados--> 
        
    </div> <!--cont-->

</body>
</html>
