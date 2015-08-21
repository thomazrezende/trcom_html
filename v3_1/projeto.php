<?php 
require_once("../_control/acesso.php");
require_once("../_control/seguranca.php");
require_once("cms/_tr/mysql.php");
require_once("cms/_tr/html.php");

$id = $_GET['id'];  
$conexao = conectar(); 

$dados = sql_select( $conexao, "projetos", "*", "", "id='".$id."'", false);

?>
<!doctype html>
<html>
	<head> 
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

		<title>TRCOM ARQUITETOS :: <?php print $dados['nome_pt']; ?></title>
		
		<meta name="title" content="TRCOM ARQUITETOS :: <?php print $dados['codigo']; ?>" />
		<meta name="description" content="<?php print $dados[lg('subtitulo')]; ?>" />
		<meta name="Author" lang="pt" content="TRCOM Rezende" />
		<meta name="Date-Creation-yyyymmdd" content="2015-04-27" lang="pt" />
		<meta name="revisit-after" content="7 Days" />
		<meta name="copyright" content="TRCOM ARQUITETOS" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
 
		<meta property="og:title" content="TRCOM ARQUITETOS">
		<meta property="og:url" content="http://www.TRCOM.com.br/projeto.php?id=<?php print $id ?>">
		<meta property="og:description" content="<?php print $dados[lg('subtitulo')]; ?>">
		<meta property="og:image" content="http://www.TRCOM.com.br/logo_TRCOM_arquitetos.jpg" />
		<meta property="og:image:type" content="image/jpg">
		<meta property="og:image:width" content="350">
		<meta property="og:image:height" content="350">
		<meta property="og:image" content="http://www.TRCOM.com.br/logo_TRCOM_arquitetos.jpg" />
		<meta property="og:image:type" content="image/jpg">
		<meta property="og:image:width" content="900">
		<meta property="og:image:height" content="450">

		<link rel="shortcut icon" href="_layout/fav_icon.png" type="ico" />
		<link rel="image_src" href="http://www.TRCOM.com.br/logo_TRCOM_arquitetos.jpg" />  

		<script type="text/javascript" src="_tools/jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src="_tools/jquery.easing.js"></script>
		<script type="text/javascript" src="_tools/jquery.form.js"></script>
		<script type="text/javascript" src="_tools/jquery.svg.js"></script> 
		<script type="text/javascript" src="_tools/Vague.js"></script>
		<script type="text/javascript" src="_tools/jquery.svganim.min.js"></script>
		<script type="text/javascript" src="_tools/jquery.touchSwipe.js"></script>
		<script type="text/javascript" src="_tools/jquery.scrollTo-min.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.3&sensor=false"></script>
		<script type="text/javascript" src="_tools/markerwithlabel.js"></script>
		<script type="text/javascript" src="TRCOM_projeto.js" charset="UTF-8"></script> 

		<link rel="stylesheet" type="text/css" href="_tools/reset.css"> 
		<link rel="stylesheet" type="text/css" href="TRCOM.css">
	</head>
	<body>
		
		<div id="cortina_fade"></div>
		
		<input type="hidden" id="projeto_id" value="<?php print $id ?>"/>
		
		<div class="bt" id="voltar_bt">
			<svg  viewBox="0 0 46 46">					
				<rect fill='#fff' x="0" y="1" width="45" height="45"></rect>
				<g id='voltar_svg' fill='#222'>
					<polygon display="inline" points="30.5,17 29,15.5 22.5,22 16,15.5 14.5,17 21,23.5 14.5,30 16,31.5 22.5,25 29,31.5 30.5,30 24,23.5"/>
				</g>
			</svg>
		</div>   
		
		<div id="container">
			
			<header id="header" class="cel_destaque h50">
				<div id="sublogo" class="logo_in"> 
					<svg viewBox="0 0 210 210">
						<g fill='#fff' id="logo_svg">
							<rect x="101.6" y="40.2" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 184.6295 165.4844)"  width="50" height="8.6"/>
							<rect x="80.9" y="19.5" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 113.9382 136.2048)"  width="8.6" height="50"/>
							<rect x="-1.9" y="60.9" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 85.4854 95.0091)"  width="50" height="8.6"/>
							<rect x="18.8" y="-1.2" transform="matrix(0.7072 -0.707 0.707 0.7072 -10.074 23.2777)"  width="8.6" height="50"/>
							<rect x="18.8" y="81.6" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 114.7662 165.6981)"  width="8.6" height="50"/>
							<rect x="-1.9" y="143.7" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 144.0464 236.3879)"  width="50" height="8.6"/>
							<rect x="199" y="34.2"  width="8.6" height="50"/>
							<rect x="149.1" y="25.6"  width="50" height="8.6"/>
						</g>	
					</svg>
				</div>   
					
				<div class="cortina"></div>
			</header>
			
			<div id="dados"> 
				<div id="dados_topo">
					<div id="projeto_nome">
						<span id="projeto_nome_lb" class="dados_lb"></span><br>
						<span id="projeto_sub" class="dados_sublb"></span> 
					</div>
				</div>		
			</div>			 
			
			<div id='dados_tx'> 
				<div id="textos_cel">
					<div class="texto" id="descricao"></div>
					<div class="texto" id="creditos"></div> 
				</div>
			</div>
			
			<div id="info_bt">
				<svg  viewBox="0 0 46 46">
					<circle cx="24" cy="23" r="20" fill="#f0f0f0"/>
					<g id='info_bt_mais' fill='#f00'>
						<rect id='info_bt_v' x="23" y="17" width="2" height="12"/>
						<rect x="18" y="22" width="12" height="2"/>
					</g>
				</svg>
			</div>
			
			<div id="arquivos" class="conteudo"></div> 
			
			<div class="clear"></div>
			
			<div class='titulo' id="mapa_titulo">LOCALIZAÇÃO</div>
			<div id="mapa" class="h75"></div>
			
			<div class='titulo' id="relacionados_titulo">PROJETOS RELACIONADOS</div>			
			<div id="relacionados" class="lista_projetos"></div>  	
									
			<div class="clear"></div>
			
			<footer>
				<div id="seta_topo">
					<svg viewBox="0 0 46 46">
						<path id='seta_topo_path' d="M11.2,30L24,17.2L21.8,15L9,27.8L11.2,30z M39,27.8L26.2,15L24,17.2L36.8,30L39,27.8z M33,7.5l-18,0l0,3.1h18L33,7.5z"/>
					</svg>
				</div>
			</footer> 
			
		</div>

		<!-- GOOGLE ANALYTICS -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); 
		  ga('create', 'UA-62479677-1', 'auto');
		  ga('send', 'pageview'); 
		</script>
		
	</body>
</html>
