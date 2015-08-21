<?php
require_once("../../../_control/acesso.php");
require_once("../../../_control/seguranca.php");
require_once("_tr/mysql.php");
require_once("_tr/html.php"); 
require_once("_tr/string.php"); 
require_once("_menus.php");

verif_log(); 
$conexao = conectar();

$id = $_SESSION["id"]; 
$id_arquivo = $_GET["id"]; 
$tipo_arquivo = $_GET["tipo"]; 

head("PROJETO".$id."_ARQUIVOS"); 
require_once("_tr/up_file_form.php");
?>

<body>
    
	<?php menu($menu_arr, $lg_arr, "_layout/logo_admin.png", 7, true); ?>
	 
    <div id="cont">
      	<div id="dados">
			
			<?php	
				
			//SQL
			$dados = sql_select($conexao,"projetos","codigo, lb_arquivos","","id=".$id,false);
			$arquivo = sql_select($conexao,"arquivos","*","","id=".$id_arquivo,false);

			mensagem();
			navega( array( array("PROJETOS","projetos.php"), array($id.". ".caps($dados['codigo'])." / ARQUIVOS","projeto_arquivos.php"), "ARQUIVO ".$id_arquivo)); 
 			
			if($tipo_arquivo == "img"){
				
				form1("altera", "", "php/projeto_imagem_altera.php?id=".$id_arquivo, "post");  
					 
					titulo("mt0","LEGENDA", true);
					input(lg("legenda"), "input", lg("legenda"), "text", $arquivo[lg("legenda")],"","" ); 
				
					titulo("","link", false);
					input("link", "input", "link", "text", $arquivo["link"],"","" ); 
 
					submit("GRAVAR"); 
				
				form2();
				
				hr();
				
				titulo("","&darr; SUBSTITUIR IMAGEM (largura ideal: 900px | jpg, gif, png)",false);
				up_file_form("_imagem", "", "php/projeto_imagem_up.php?id=".$id_arquivo, "imagem", false, true, "jpg,jpeg,gif,png,bmp");  
				
				preview("../projetos/projeto".$id."/TRCOM_".$dados["lb_arquivos"]."_".$id_arquivo."_g.jpg", "img");
			}

			if($tipo_arquivo == "emb"){
				
				form1("altera", "", "php/projeto_embed_altera.php?id=".$id_arquivo, "post");  
					 
					titulo("mt0","LABEL (uso interno)", false);
					input("lb_embed", "input", "lb_embed", "text", $arquivo["lb_embed"],"","" ); 
				
					titulo("","CÓDIGO EMBED", false);
					text("embed", "text", "embed", $arquivo["embed"],"","" ); 
				
					submit("GRAVAR"); 
				
				form2();
				
				preview($arquivo["embed"], "emb");
				
			}
			

			?>
        
        </div> <!--dados-->  
    </div> <!--cont-->  

</body>
</html>
