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

head("PROJETO".$id."_MINIATURA");  
require_once("_tr/up_file_form.php");  
?>

<body>
    
	<?php menu($menu_arr, $lg_arr, "_layout/logo_admin.png", 7, true); ?>
	 
    <div id="cont">
      	<div id="dados">
			
			<?php 
			
			//SQL
			$dados = sql_select($conexao,"projetos","*","","id=".$id,false);
			
			mensagem();
			navega( array( array("PROJETOS","projetos.php"), $id.". ".$dados['codigo']." - ".$dados[lg('nome')])); 

			submenu( $submenu_projeto, 3);
 
			titulo("","&darr; MINIATURA (350 x 350 px)", false);
			up_file_form("_tb", "arquivo", "php/projeto_tb_up.php", "arquivo", false, true, "jpg,gif,png"); 

			preview("../projetos/projeto".$id."/tb.jpg", "img");
			
			?>
        
			<script type="text/javascript"> 
				
				// variavel para o bt_voltar no preview
				sessionStorage.setItem('voltar_para','cms/projeto_tb.php');
				
			</script>	
			
        </div> <!--dados-->  
    </div> <!--cont-->  

</body>
</html>
