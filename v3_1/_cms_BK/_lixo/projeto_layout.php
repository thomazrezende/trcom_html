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

head("PROJETO".$id."_LAYOUT"); 
require_once("_tr/sortable_layout.php");
?>

<body>
    
	<?php menu($menu_arr, $lg_arr, "_layout/logo_admin.png", 7, true); ?>
	 
    <div id="cont">
      	<div id="dados">
			
			<?php
				
			//SQL
			$arquivos = sql_select($conexao,"arquivos","*","","id_projeto=".$id,true);
			$dados = sql_select($conexao,"projetos","*","","id=".$id,false);

			mensagem();
			navega( array( array("PROJETOS","projetos.php"), $id.". ".$dados['codigo']." - ".$dados[lg('nome')])); 

			submenu( $submenu_projeto, 5 );  

			div1('mini_layout','',"","",false);
			form1("altera", "mt0", "php/projeto_layout_altera.php", "post"); 

				input("layout_itens", "input", "layout_itens", "hidden", $dados["layout_itens"],"","" ); 
				input("layout_larguras", "input", "layout_larguras", "hidden", $dados["layout_larguras"],"","" ); 
				
				submit('GRAVAR');

				if(count($arquivos) > 0){

					div1("itens",'sortable itens_layout mt20',"","",false);

					for($i=0; $i<count($arquivos); $i++){

						$id_arquivo = $arquivos[$i]['id'];
						$tipo = $arquivos[$i]['tipo'];

						if($tipo=="img") {
							div1(	'item'.$id_arquivo,
								 	'',
								 	"background-image:url(../projetos/projeto".$id."/TRCOM_".$dados["lb_arquivos"]."_".$id_arquivo."_p.jpg)",
								 	"",
								 	true);
						} 

						if($tipo=="emb"){
							div1(	'item'.$id_arquivo,
								 	'',
								 	"background-image:url(_layout/embed_tb.jpg)",
									 (!empty($arquivos[$i]['lb_embed']))?(caps($arquivos[$i]['lb_embed'])):("V&Iacute;DEO".$id_arquivo),
									 true);
						 }
					}
					
					div2();
					clear();

				} 

				submit('GRAVAR');
				form2();

				div2(); 

				
			?>
			
			<script type="text/javascript"> 
				
				// variavel para o bt_voltar no preview
				sessionStorage.setItem('voltar_para','cms/projeto_layout.php');
				
			</script>	
        
        </div> <!--dados-->  
    </div> <!--cont-->  

</body>
</html>
