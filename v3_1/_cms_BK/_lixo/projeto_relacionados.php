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

head("PROJETO".$id."_DADOS");     
require_once("_editor/tiny_mce.php"); 
?>

<body>
    
	<?php menu($menu_arr, $lg_arr, "_layout/logo_admin.png", 7, true); ?>
	 
    <div id="cont">
      	<div id="dados">
			
			<?php
	
			//SQL
			$dados = sql_select($conexao,"projetos","*","","id=".$id,false);
			($dados[lg("publicado")] == "1")?($public = true):($public = false);
			($dados["destaque"] == "1")?($destaque = true):($destaque = false);
 			
			mensagem();
			navega( array( array("PROJETOS","projetos.php"), $id.". ".$dados['codigo']." - ".$dados[lg('nome')])); 
			
			submenu( $submenu_projeto, 6);
			
			$projetos_bd = array();
			$projetos = sql_select($conexao,"projetos","*","id DESC","",true);
			
			form1("novo","","php/projeto_relacionados_altera.php","post"); 
				
				titulo("","PROJETOS RELACIONADOS",false);
				ul1("itens",'');
				
				for($i=0; $i<count($projetos); $i++){
					$id_projeto = $projetos[$i]["id"];  
					
					if( $id_projeto != $id ){
						array_push($projetos_bd, $id_projeto);
						$lb_arquivos = $projetos[$i]["lb_arquivos"];
						$tb = verifica_tb("../projetos/projeto".$id_projeto."/tbp.jpg","_layout/ico_compass.png");
						$lb = $projetos[$i]["codigo"]." - ".$projetos[$i][lg("nome")];
						$lb_ext = "";
						$link = array('',false); 
						$bts = false; 
						item('item'.$id_projeto, $tb, caps($id_projeto.". ".$lb), $lb_ext, $link, $bts, false);
					}
				}  

				ul2();

				submit("GRAVAR");  
				
				input("projetos_bd", "input", "projetos_bd", "hidden", implode(",",$projetos_bd), "", "");
				input("relacionados", "input", "relacionados", "hidden", $dados['relacionados'], "", "");

			form2();  
			
			?>
			
			<script type="text/javascript">
			
				window.onload = function(){ 
					
					// variavel para o bt_voltar no preview
					sessionStorage.setItem('voltar_para','cms/projeto_relacionados.php'); 
					
					$('#mensagem').delay(2000).fadeOut(1000);
					
					var i;
					var projeto;
					
					var projetos_bd = document.getElementById('projetos_bd').value.split(',');
					var relacionados = document.getElementById('relacionados');
					var relacionados_arr = [];
					
					if(relacionados.value != '') relacionados_arr = relacionados.value.split(',');
					
					for(i=0; i<projetos_bd.length; i++){
						
						projeto = document.getElementById('item'+projetos_bd[i]);
						projeto.ID = projetos_bd[i];
						
						if(relacionados_arr.indexOf(projetos_bd[i]) >= 0){
							projeto.on = true;
							projeto.style.background = '#88ba80';
							projeto.style.color = '#fff';
						}else{
							projeto.on = false;
						}
						
						projeto.onclick = function(){
							if(this.on){
								this.on = false;
								this.style.background = '';
								this.style.color = '';
							}else{
								this.on = true;
								this.style.background = '#88ba80';
								this.style.color = '#fff';
							}
							
							atualizar_relacionados();
						}						
					}
					
					function atualizar_relacionados(){
						relacionados_arr = [];
						for(i=0; i<projetos_bd.length; i++){
							projeto = document.getElementById('item'+projetos_bd[i]);
							if(projeto.on){
								relacionados_arr.push(projeto.ID);
							}
						}
						relacionados.value = relacionados_arr;
					}	
					
					atualizar_relacionados();
					
				}	
			
			</script>
        
        </div> <!--dados-->  
    </div> <!--cont-->  

</body>
</html>
