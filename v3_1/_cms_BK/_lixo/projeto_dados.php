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
 
			//dados 
	
			//SQL
			$dados = sql_select($conexao,"projetos","*","","id=".$id,false);   
			($dados[lg("publicado")] == "1")?($public = true):($public = false);
			($dados["destaque"] == "1")?($destaque = true):($destaque = false);
 			
			mensagem();
			navega( array( array("PROJETOS","projetos.php"), $id.". ".$dados['codigo']." - ".$dados[lg('nome')])); 

			submenu( $submenu_projeto, 1);

			$marcadores = sql_select($conexao,"marcadores","*",lg('nome'),"",true);   
			$marcadores_arr = "";
			for($i=0; $i<count($marcadores); $i++){	
				$marcadores_arr .= $marcadores[$i]["id"]."|".$marcadores[$i][lg("nome")];
				if($i<count($marcadores) - 1) $marcadores_arr .= ",";
			}

			$cidades = sql_select($conexao,"cidades","*",lg('nome'),"",true); 
			$cidades_arr = array();
			for($i=0; $i<count($cidades); $i++){
				array_push( $cidades_arr, array( $cidades[$i]['id'], $cidades[$i][lg('nome')]));
			}

			$categorias = sql_select($conexao,"categorias","*",lg('nome'),"",true);   
			$categorias_arr = array();
			$cores = "";
			for($i=0; $i<count($categorias); $i++){
				array_push( $categorias_arr, array($categorias[$i]['id'], $categorias[$i][lg('nome')]));
				$cores .= $categorias[$i]['hex'];
				if($i<count($categorias) - 1) $cores .= ",";
			} 

			$clientes = sql_select($conexao,"clientes","*","nome","",true);   
			$clientes_arr = array();
			for($i=0; $i<count($clientes); $i++){
				array_push( $clientes_arr, array($clientes[$i]['id'], $clientes[$i]['nome']));
			} 
			
			// para evitar erros, o lb arquivos so pode ser modificado 
			//se não houver imagens associadas ao projeto
			$arquivos = sql_select($conexao,"arquivos","*","","",true);
			$possui_arquivo = false;
			for($i=0; $i<count($arquivos); $i++){
				if($arquivos[$i]['id_projeto'] == $id && $arquivos[$i]['tipo'] == 'img') {
					$possui_arquivo = true;
					break;
				}
			} 
			
			
			form1("altera", "", "php/projeto_dados_altera.php", "post");
				
				submit("GRAVAR"); 

				titulo("","", false);
				checkbox(lg("publicado"), lg("publicado"), 1, caps("publicado"), "", $public, true);

				titulo("mt0","", false);
				checkbox("destaque", "destaque", 1, caps("destaque"), "", $destaque, false); 
 				
				titulo("","C&Oacute;DIGO", false);
				input("codigo", "input", "codigo", "text", $dados["codigo"],"","" ); 
				
				titulo("","NOME", true);
				input(lg("nome"), "input", lg("nome"), "text", $dados[lg("nome")],"","" );

				titulo("","SUBT&Iacute;TULO", true);
				input(lg("subtitulo"), "input", lg("subtitulo"), "text", $dados[lg("subtitulo")],"","" );
				
				titulo("","DATA (aaaa-mm-dd)", false);
				input("data", "input", "data", "text", $dados["data"], "", "");
				
				titulo("","PREFIXO ARQUIVOS".obs_right('(Sem espaços ou caracteres especiais. Fica inativo quando há imagens associadas ao projeto)'), false);
				if($possui_arquivo){
					div1("","input off","",$dados["lb_arquivos"],true);
					input("lb_arquivos", "input", "lb_arquivos", "hidden", $dados["lb_arquivos"],"","" ); 
				}else{
					input("lb_arquivos", "input", "lb_arquivos", "text", $dados["lb_arquivos"],"","" ); 
				}

				titulo("", "CIDADE", false);
				select( "cidade", "cidade", "", false, $cidades_arr, array($dados['cidade']), array(0,'+'));

				titulo("","CATEGORIA", false);
				select( "categoria", "categoria", "", false, $categorias_arr, array($dados['categoria']), false); 
				input("cores", "input", "cores", "hidden", $cores,"","" );  
				
				titulo("","CLIENTE", false);
				select( "cliente", "cliente", "", false, $clientes_arr, array($dados['cliente']), array(0,'+'));
				
				titulo("", "MARCADORES", false);
				div1("tags","","","",true);
				input("marcadores_arr", "input", "marcadores_arr", "hidden", $marcadores_arr, "", "");  
				input("marcadores", "input", "marcadores", "hidden", $dados["marcadores"],"","" );  
				
				titulo("","DESCRI&Ccedil;&Atilde;O", true);
				text( lg("texto"), 'text', lg("texto"), $dados[lg("texto")], true);

				titulo("","CR&Eacute;DITOS", true);
				text( lg("creditos"), 'text', lg("creditos"), $dados[lg("creditos")], true);	 

				submit("GRAVAR"); 
						
			form2();  
			
			?>
			
			<script type="text/javascript">
			
				window.onload = function(){
					
					// variavel para o bt_voltar no preview
					sessionStorage.setItem('voltar_para','cms/projeto_dados.php')
					
					$('#mensagem').delay(2000).fadeOut(1000);   
					
					var i;
					var m;
					var tag_id;
					var tag_lb;
					var tag;
					
					var tags = document.getElementById('tags');
					var marcadores = document.getElementById('marcadores');
					var marcadores_arr = document.getElementById('marcadores_arr').value.split(',');
					var marcadores_bd = [];
					
					if(document.getElementById('marcadores').value != ''){
						marcadores_bd = document.getElementById('marcadores').value.split(',');
					}
					
					for(i=0; i<marcadores_arr.length; i++){
						
						tag_id = marcadores_arr[i].split('|')[0];
						tag_lb = marcadores_arr[i].split('|')[1];
						
						tag = document.createElement('div');
						tag.id = 'tag'+i;
						tag.className = 'tag';
						tag.ID = tag_id;
						tag.innerHTML = tag_lb;
						tag.on = false;
						
						if(marcadores_bd.indexOf(tag_id) >= 0){
							tag.className += " on";
							tag.on = true;
						}
						
						tag.onclick = function(){
							if(this.on){
								this.on = false;
								this.className = 'tag';
							}else{
								this.on = true;
								this.className = 'tag on';
							}
							
							marcadores_bd = [];
							for(m=0; m<marcadores_arr.length; m++){
								tag = document.getElementById('tag' + m);
								if(tag.on) marcadores_bd.push(tag.ID);
							}
							
							marcadores.value = marcadores_bd;
						}
						
						tags.appendChild(tag);
					}
					
					// categoria
					var categoria = document.getElementById('categoria');
					var cores = document.getElementById('cores').value.split(',');
					
					categoria.style.backgroundColor = cores[categoria.selectedIndex];
					
					categoria.onchange = function(){
						this.style.backgroundColor = cores[this.selectedIndex];
					}
					
				}	
			
			</script>
        
        </div> <!--dados-->  
    </div> <!--cont-->  

</body>
</html>
