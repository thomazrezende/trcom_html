<?php
require_once("../../../_control/acesso.php");
require_once("../../../_control/seguranca.php");
require_once("_menus.php");
require_once("_tr/mysql.php");
require_once("_tr/html.php"); 
require_once("_tr/string.php"); 

verif_log();
$conexao = conectar();

head("CMS TRCOM");  
require_once("_editor/tiny_mce.php");
require_once("_tr/up_file_form.php"); 

$id = $_SESSION['id'];
$dados = sql_select($conexao, "projetos", "*", "", "id='".$id."'", false);  
$clientes = sql_select($conexao, "clientes", "*", "", "", true);    

$clientes_opt = array(); 
for($i=0; $i<count($clientes); $i++){
	array_push( $clientes_opt, array( $clientes[$i]["cliente".lg()], $clientes[$i]["id"] ));
}

?>

<body>
	 
	
	 <?php  
	
		div1( "container", "", "", "", false );
			
			topo($lg_arr);  
			
			div1( "navega", "", "", "", false ); 
				menu( $menu_arr, 'projetos.php' ); 
				$tb = verifica_tb( '../projetos/projeto'.$id.'/tbp.jpg', false); 
				barra( "","bg".$dados["id_suporte"], $dados['projeto'.lg()], $tb, 'projetos.php', 'preview.php' ); 
				submenu( $submenu_projeto, 'projeto_dados.php' );  
			div2();

			$public = false;
			$destaque = false;

			if ($dados["publicado".lg()] == "1") $public = true;
			if ($dados["dd_portfolio"] == "1") $destaque = true; 

			$suportes = array( 
						array("INTERATIVO",1),
						array("V&Iacute;DEO",2),
						array("IMPRESSO",3));

			$cls = "bg".$dados["id_suporte"];  

			div1( "conteudo", "", "", "", false );  
				form1("altera", "", "php/projeto_dados_altera.php", "post");  

					checkbox("publicado".lg(), "publicado".lg(), 1, caps("publicado"), "", $public, true); 
					checkbox("dd_portfolio", "dd_portfolio", 1, "PORTFOLIO", "", $destaque, false);
 					
					input("projeto".lg(), "", "projeto".lg(), "text", $dados["projeto".lg()], "TÍTULO", false, true );

					select("id_cliente", "", "id_cliente", "", false, $clientes_opt, array($dados["id_cliente"]), array("[CLIENTE]",0) ); 
					select("id_parceiro", "", "id_parceiro", "", false, $clientes_opt, array($dados["id_parceiro"]), array("[PARCEIRO]",0) );  
					select("suporte", "", "id_suporte", "", false, $suportes, array($dados["id_suporte"]), array("[SUPORTE]",0) );
					
					input("data", "", "data", "text", verifica_data($dados["data"]), "DATA", false, false );
					input("url", "", "url", "text", $dados["url"], "URL", false, false );    

					text("tx_info".lg(), "", "tx_info".lg(), "INFO", $dados["tx_info".lg()], true);  
					text("tx_cred".lg(), "", "tx_cred".lg(), "CRÉDITOS", $dados["tx_cred".lg()], true);  

					gravar("GRAVAR"); 

				form2(); 
				
			bt_topo();  
			div2();  
		div2(); 
		
		mensagem(); 
		tr_js();
	
	?>	
	
	 <!--select suporte-->
	<script type="text/javascript" language="javascript"> 
			
		var suporte = document.getElementById("suporte");
		if(suporte.selectedIndex > 0) suporte.className = 'select bg' + suporte.selectedIndex;
		else suporte.className = 'select';
		
		suporte.onchange = function(){ 
			if(this.selectedIndex > 0) this.className = 'select bg' + this.selectedIndex;
			else this.className = 'select';
		}
	 
	</script>
	
</body>
</html>
