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

head("PROJETO".$id."_ARQUIVOS"); 
require_once("_tr/up_file_form.php");
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

			submenu( $submenu_projeto, 4);
			
			titulo("","&darr; INSERIR IMAGENS (largura ideal: 900px | jpg, gif, png)",false);
			up_file_form("_imagens", "", "php/projeto_imagens_up.php", "imagens[]", true, true, "jpg,jpeg,gif,png,bmp"); 
 			
			titulo("","&darr; INSERIR V&Iacute;DEO (c&oacute;digo embed)",false);
			up_emb_form("php/projeto_embed_up.php", "embed"); 
 
			$lista = array();

			if(count($arquivos) > 0){
				
				titulo("","ARQUIVOS",false);

				for($i=0; $i<count($arquivos); $i++){

					$id_img = $arquivos[$i]['id'];
					$tipo = $arquivos[$i]['tipo']; 
					
					array_push($lista, $id_img);
					
					if($arquivos[$i]['tipo'] == 'img'){
						$tb = verifica_tb("../projetos/projeto".$id."/TRCOM_".$dados["lb_arquivos"]."_".$id_img."_tb.jpg","_layout/ico_img.png");
						$lb = "TRCOM_".$dados["lb_arquivos"]."_".$id_img.".jpg";
					} 
					else{
						if( $arquivos[$i]['lb_embed'] == "" ) $lb = "VÍDEO";
						else $lb = $arquivos[$i]['lb_embed'];
						
						$tb = "_layout/ico_emb.png";
					} 
						
					$lb_ext = "";
					$link = array("projeto_arquivo.php?tipo=".$tipo."&id=".$id_img, false);

					$bts = array (	array( "del", "php/projeto_arquivo_remove.php?ids=".$id_img ),
								  	array( "checkbox" )
								 ); 

					item('item'.$id_img, $tb, caps($id_img.". ".$lb), $lb_ext, $link, $bts, false); 

				}
			} 
			 
			input( "lista", "input", "lista", "hidden", join(',',$lista), "", "" );

			?>
			
			<script type="text/javascript">
				
				// variavel para o bt_voltar no preview
				sessionStorage.setItem('voltar_para','cms/projeto_arquivos.php');
				
				var lista = document.getElementById('lista').value.split(','); 
				var dados = document.getElementById('dados'); 
				var i;
				var cb;
				var lista_confirm;
				
				var multi_del = document.createElement('div');
				multi_del.className = 'multi_del';
				multi_del.innerHTML = 'REMOVER ARQUIVOS SELECIONADOS';
				multi_del.style.display = 'none';
				
				multi_del.onclick = function(){ 
					lista_confirm = lista_del.join(); 
					excluir( "itens: [" + lista_confirm + "]" , 'php/projeto_arquivo_remove.php?ids=' + lista_confirm); 
				}
				
				dados.appendChild(multi_del);
				
				var lista_del = [];
				
				for(i=0; i<lista.length; i++){
					
					cb = document.getElementById('checkbox_item' + lista[i]);
					cb.ID = lista[i];
					cb.ativo = false;
					console.log(cb);
					
					cb.onclick = function(){
						 
						if(this.ativo) {
							this.ativo = false;
						}else{
							this.ativo = true;
						}
						
						lista_del = [];
						
						for(i=0; i<lista.length; i++){ 
							cb = document.getElementById('checkbox_item' + lista[i]);
							if(cb.ativo){
								cb.className = 'btp bt_checkbox on';
								lista_del.push(cb.ID);
							}else{
								cb.className = 'btp bt_checkbox';
							}
						} 
						
						if(lista_del.length > 0){
							multi_del.style.display = 'block';
						}else{
							multi_del.style.display = 'none';
						}						
					}  
				}
				
			
			</script>
        
        </div> <!--dados-->  
    </div> <!--cont-->  

</body>
</html>
