/* 
	TRCOM V3.1
	TRCOM Rezende - 2015-07-31 
*/ 

window.onload = function (){ 	
	  
	// vars  
	var idiomas = ["_pt", "_en"]; 
	 
	var page_y = 0; 
	var layout = -1; 
	var limite_w0 = 360; 
	var limite_w1 = 640; 
	var limite_w2 = 940; 
	var win_w; 
	var win_h; 
	var doc_h; 
	var lg = idiomas[0]; // _pt 
	var nlg = 0; // _pt
	var tela_at = 0;
	var projeto_aberto = false; // indica menu de projeto aberto
	var tl_at = -1; // timeline atual
	var skill_at = -1; 
	
	var n_proj = [null,0,0,0];
	
	var i;
	var a;
	var h;
	var itm;
	var itm2;
	var itm3;
	var itm4;
	var lb;
	
	var filtro_at = 0;
	
	var branco = "#fff";
	var claro = "#faf8f7";
	var cinza1 = "#edeae8"; // claro+
	var cinza2 = "#e0dddc"; // claro
	var chumbo = "#41444d";
	var chumbo2 = "#4c4f58";// -escuro
	
	var cores = [null,"#9ab394","#8fa6b3","#a196b3"]; 
	  
	/* elementos */ 
	var cl_tx = document.getElementById("cl_tx");
	
	var header = document.getElementById("header"); 
	
	var seta_topo = document.getElementById("seta_topo");
	seta_topo.fechada = true;
	
	var menu = document.getElementById("menu"); 
	var w_menu = 236; 
	var menu_ico = document.getElementById("menu_ico"); 
	var menu_ico_path = document.getElementById("menu_ico_path"); 
	var menu_x = document.getElementById("menu_x"); 
	var menu_x_path = document.getElementById("menu_x_path");  
	
	var menu_bts = document.getElementById("menu_bts");
	var idioma = document.getElementById("idioma");
	var bt_pt = document.getElementById("bt_pt");
	var bt_en = document.getElementById("bt_en");
	var menu_filtro1 = document.getElementById("menu_filtro1");
	var menu_filtro2 = document.getElementById("menu_filtro2");
	var menu_filtro3 = document.getElementById("menu_filtro3");
	menu_filtro1.lb = document.getElementById("menu_filtro1_lb");
	menu_filtro2.lb = document.getElementById("menu_filtro2_lb");
	menu_filtro3.lb = document.getElementById("menu_filtro3_lb");
	menu_filtro1.fechar = document.getElementById("menu_filtro1_fechar");
	menu_filtro2.fechar = document.getElementById("menu_filtro2_fechar");
	menu_filtro3.fechar = document.getElementById("menu_filtro3_fechar");
	menu_filtro1.path = document.getElementById("menu_filtro1_path");
	menu_filtro2.path = document.getElementById("menu_filtro2_path");
	menu_filtro3.path = document.getElementById("menu_filtro3_path"); 
	
	var suportes = document.getElementById("suportes");
	var suporte1 = document.getElementById("suporte1");
	var suporte2 = document.getElementById("suporte2");
	var suporte3 = document.getElementById("suporte3");
	suporte1.lb = document.getElementById("suporte1_lb");
	suporte2.lb = document.getElementById("suporte2_lb");
	suporte3.lb = document.getElementById("suporte3_lb");
	suporte1.path = document.getElementById("suporte1_path");
	suporte2.path = document.getElementById("suporte2_path");
	suporte3.path = document.getElementById("suporte3_path"); 
	
	var contato = document.getElementById("contato");
	var contato_bts = document.getElementById("contato_bts");  
	var contato_lb = document.getElementById("contato_lb");  
	
	var logo = document.getElementById("logo");
	var trcom = document.getElementById("trcom");
	var logo_linhas = document.getElementById("logo_linhas");
	var logo_path = document.getElementById("logo_path");
	var logo_svg = document.getElementById("logo_svg");
	var logo_mais = document.getElementById("logo_mais");
	var logo_mais_path = document.getElementById("logo_mais_path");
	var logo_legenda = document.getElementById("logo_legenda");
	var leg_lb;
	var leg1;
	var leg2; 
	
	var seta_iniciar = document.getElementById("seta_iniciar");
	var ciclo_iniciar = true;
	var ciclo_seta_iniciar;
	
	var periodo_total = new Date() - new Date(2004,00,01); 
	var periodo_proj;
	logo.projetos = [];
	logo.suportes = [null,[],[],[]];
	logo.linhas = [];
	var circ;
	var centro; 
	var circ2;
	var linha;
	
	var filtros = document.getElementById("filtros"); 
	var filtro1 = document.getElementById("filtro1");
	var filtro2 = document.getElementById("filtro2");
	var filtro3 = document.getElementById("filtro3"); 
	filtro1.path = document.getElementById("filtro1_path");
	filtro2.path = document.getElementById("filtro2_path");
	filtro3.path = document.getElementById("filtro3_path"); 
	filtro1.lb = document.getElementById("filtro1_lb");
	filtro2.lb = document.getElementById("filtro2_lb");
	filtro3.lb = document.getElementById("filtro3_lb");
	filtro1.fechar = document.getElementById("filtro1_fechar");
	filtro2.fechar = document.getElementById("filtro2_fechar");
	filtro3.fechar = document.getElementById("filtro3_fechar");    
	
	var telas = document.getElementById("telas");
	
	var anc_projetos = document.getElementById("anc_projetos");
	var anc_clientes = document.getElementById("anc_clientes");
	var anc_parceiros = document.getElementById("anc_parceiros");
	var anc_sobre = document.getElementById("anc_sobre");
	
	var ancora_proj_bt1 = document.getElementById("ancora_proj_bt1");
	var ancora_proj_bt2 = document.getElementById("ancora_proj_bt2");
	var ancora_proj_bt3 = document.getElementById("ancora_proj_bt3");
	
	var portfolio = document.getElementById("portfolio");
	portfolio.projetos = [];
	
	var projetos = document.getElementById("projetos");
	var proj_atual;
	projetos.projetos = []; 
	
	var clientes = document.getElementById("clientes");
	clientes.projetos = []; 
	
	var parceiros = document.getElementById("parceiros");
	parceiros.projetos = []; 
	
	var sobre = document.getElementById("sobre");
	sobre.projetos = []; 
	
	var img_TRCOM_lb = document.getElementById("img_TRCOM_lb");  
	var sobre_tx = document.getElementById("sobre_tx");  
	var noticias = document.getElementById("noticias"); 
	var cargos = document.getElementById("cargos");  
	var sobre_habilidades = document.getElementById("sobre_habilidades");  
	var skills_num = document.getElementById("skills_num"); 
	 
	var timeline = document.getElementById("timeline");
	var timeline_wrap = document.getElementById("timeline_wrap");
	var tl_mais = document.getElementById("tl_mais");
	var tl_mais_img = document.getElementById("tl_mais_img");
	var tl_mais_dados = document.getElementById("tl_mais_dados");
	var tl_mais_fechar = document.getElementById("tl_mais_fechar");
	var tl_mais_url = document.getElementById("tl_mais_url");
	var tl_mais_data = document.getElementById("tl_mais_data");
	var tl_mais_titulo = document.getElementById("tl_mais_titulo");
	var tl_mais_sub = document.getElementById("tl_mais_sub"); 
	
	var projeto = document.getElementById("projeto"); 
	var proj_conteudo = document.getElementById("proj_conteudo");
	
	var bt_voltar = document.getElementById("bt_voltar");  
	var bt_voltar2 = document.getElementById("bt_voltar2"); 
	var bt_voltar2_path = document.getElementById("bt_voltar2_path");   
	var bt_url = document.getElementById("bt_url");   
	var filtro_lb = document.getElementById("filtro_lb"); 
	
	var proj_topo = document.getElementById("proj_topo");
	var proj_aba = document.getElementById("proj_aba");
	$(proj_aba).hide();
	
	var proj_dados = document.getElementById("proj_dados");
	var proj_dados_titulo = document.getElementById("proj_dados_titulo");
	var proj_dados_subtitulo = document.getElementById("proj_dados_subtitulo");
	var proj_dados1 = document.getElementById("proj_dados1");
	var proj_dados2 = document.getElementById("proj_dados2");
	var proj_mais = document.getElementById("proj_mais");
	var proj_titulo = document.getElementById("proj_titulo");
	var proj_subtitulo = document.getElementById("proj_subtitulo");
	var proj_suporte_lb;
	
	var rodape = document.getElementById("rodape");
	var	tx_obrigado = document.getElementById("tx_obrigado");
	var tx_versao = document.getElementById("tx_versao");
	var tx_atualizado = document.getElementById("tx_atualizado");  
	
	
	/* FUNCOES */  
	
	 
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};
	
	var dur; // duracao das transicoes;
			
	if( isMobile.any() ){
	   mobile = true;
	   dur = 0;
	  // cl_tx.innerHTML = "mobile"; 
	}else{
		dur = 250;
	   mobile = false;
	  // cl_tx.innerHTML = "desktop"; 
	}  
	
	ancora_proj_bt1.onclick = function(){
		if(!this.trava){
			
			$(portfolio).fadeIn(dur);
			$(projetos).hide();
			rolar_tela(anc_projetos, 500);
			
			this.trava = true;
			ancora_proj_bt2.trava = false;
			ancora_proj_bt2.style.opacity = .3;
			this.style.opacity = 1;
			
						
			itm = document.getElementById("bt1_lb");
			itm.innerHTML = "PROJETOS : DESTAQUES"; // LG!
				
			$(ancora_proj_bt3).show();
		} 
	}
	
	ancora_proj_bt2.onclick = function(){
		if(!this.trava){ 
			
			$(projetos).fadeIn(dur);
			$(portfolio).hide();
			rolar_tela(anc_projetos, 500);
			
			this.trava = true;
			ancora_proj_bt1.trava = false;
			ancora_proj_bt1.style.opacity = .3;
			this.style.opacity = 1;
			
			
			itm = document.getElementById("bt1_lb");
			itm.innerHTML = "PROJETOS : TODOS"; // LG!
			
			$(ancora_proj_bt3).hide();
		}
	}
	
	ancora_proj_bt3.onclick = function(){
			
		$(projetos).fadeIn(dur);
		$(portfolio).hide();
		rolar_tela(anc_projetos, 500);
		
		ancora_proj_bt2.trava = true;
		ancora_proj_bt1.trava = false;
		ancora_proj_bt1.style.opacity = .3;
		ancora_proj_bt2.style.opacity = 1; 
		
		itm = document.getElementById("bt1_lb");
		itm.innerHTML = "PROJETOS : TODOS"; // LG!
		
		$(ancora_proj_bt3).hide();
	
	}
	
	
	/* BTS menu */  
	menu_x.onclick = function(){
		fechar_menu(0);
	}
	 
	menu_ico.onclick = function(){ 
		abrir_menu();
	} 
	
	seta_topo.onclick = function(){
		rolar_tela(0,500);	
	}
	  
	function abrir_menu(){
		$(menu_x).show();	 
		$(menu_ico).hide(); 
		$(menu).animate( { left:0 }, dur ,"easeInOutQuart", function() { 
			menu.aberto = true;  
		});  
	}
	
	function fechar_menu(){ 
		menu.aberto = false;  
		$(menu_ico).show();
		$(menu_x).hide();  
		$(menu).animate( { left:w_menu*-1 }, dur ,"easeInOutQuart");  
	}
	
	function bt_modo(alvo,on){
	
		if(on){
			alvo.style.backgroundColor = branco;
			alvo.style.color = chumbo2;
		}else{
			alvo.style.backgroundColor = chumbo2;
			alvo.style.color = claro;
		}
		
	}
	
	/* BTS IDIOMA!!!!!!!!!!!!!!!!!!!!!!!!
	
	bt_pt.onclick = function(){
		mudar_idioma (0);
	}
	
	bt_en.onclick = function(){
		mudar_idioma (1);
	}
	
	BTS IDIOMA!!!!!!!!!!!!!!!!!!!!!!!! */ 
	
	bt_modo(bt_pt,true);
	
	bt_en.onclick = function(){
		alert("SOON");
	}	
	
	function mudar_idioma (n){
		
		nlg = n;
		lg = idiomas[n];
		
		cl(">IDIOMA : " + lg);  
		
		if(n == 0){
			
		}else{
		
		}
		
		// versao
		
		// timeline
		
		// footer
		
		// home
		
		// sobre
		sobre_tx.innerHTML = ponteiro_dados(xml_TRCOM,"tx_sobre"+lg);
		img_TRCOM_lb.innerHTML = ponteiro_dados(xml_TRCOM,"img_lb" + lg).toUpperCase();
		
		// menu
		
	} 	  
	 
	function verifica_proj(){
		
		if(location.hash.indexOf("projeto") > 0){		
			proj_atual = Number(location.hash.split("projeto")[1]); 
			
			xml_proj_request.open("GET", "projetos/projeto" + proj_atual + "/dados.xml", true);  
			xml_proj_request.send(null); 
	 	
		}else{ 
			
			proj_atual = ""; 
				
			projeto.style.position = "absolute"; 
			projeto.style.top = (page_y_bk - page_y + win_h/2)  + "px";  
								
			$(telas).show();
			$(header).show();
			$(rodape).show();
			
			if(proj_dados.aberto){ 
				fechar_proj_dados(-84); 
			}
			
			projeto_aberto = false;
			rolar_tela( page_y_bk ); 
			
			fora = page_y_bk + win_h/2;
			
			$(painel_projeto).animate({top:-84},dur,"easeInQuart"); 
			$(projeto).animate({top:fora},dur,"easeInQuart", function(){
				$(projeto).hide();
				$(painel_projeto).hide();
				proj_conteudo.innerHTML = "";
				resize();	
			});	 
		} 
	} 
	
	$(window).hashchange( function(event){ 
		verifica_proj(); 
	}); 
	
	function skill_bolas(alvo, cor){ 
		for(var b=0; b<alvo.bolas.length; b++){
			$(alvo.bolas[b]).animate( {backgroundColor: cor}, dur);
		} 
	} 
	
	function resize(){   
				
		win_w = $( window ).width();
		win_h = $( window ).height();  
		w_menu = win_w/4;
		if(w_menu < 236) w_menu = 236;
		
		if(!menu.aberto) menu.style.left = -1*w_menu + "px"; 
		menu_bt.style.left = w_menu + 20 + "px";  
		
		//mobile vert
		if(win_w < limite_w0 && layout != 0){ 
			layout = 0;
			document.body.className = "L0";  
		} 
		
		//mobile hoz
		if(win_w >= limite_w0 && win_w < limite_w1 && layout != 1){ 
			layout = 1;
			document.body.className = "L1";
		} 
		
		// 640 -> 10000
		if(win_w >= limite_w1 && win_w <= limite_w2 && layout != 2){
			layout = 2;				
			document.body.className = "L2";
		}
		 
		// 10000 +
		if(win_w > limite_w2 && layout != 3){
			layout = 3;		
			document.body.className = "L3"; 
		}
		
		//logo
		if(layout <= 1){  
			logo_svg.style.left = win_w/2 - 750 + "px";
			logo_svg.style.top = $( header ).height()/2 - 750 + "px";
		}else{
			logo_svg.style.left = win_w/2 - 1000 + "px";
			logo_svg.style.top = $( header ).height()/2 - 1000 + "px";
		}  
		
		cl_tx.innerHTML = "L" + layout;  
	}
	
	window.onresize = resize; 
 
	var dados_contato = [	[ "linked", "LinkedIn", "http://br.linkedin.com/pub/TRCOM-rezende/2b/7aa/71a" ],
							[ "vimeo", "Vimeo", "https://vimeo.com/TRCOMrezende"],
							[ "insta", "Instagram", "http://instagram.com/TRCOM_rezende"],
							[ "fbook", "Facebook", "https://www.facebook.com/pages/TRCOM/302555887385?ref=hl"],
							[ "email", "TRCOM.rezende@gmail.com", "mailto:TRCOM.rezende@gmail.com"] ]; 
							
	
	for(i=0; i<dados_contato.length; i++){
		
		itm = document.getElementById(dados_contato[i][0]);
		itm.lb = dados_contato[i][1];
		itm.url = dados_contato[i][2];
		itm.ID = i; 
		 
		if(i == 4) itm.email = true; 
		 
		 itm.onclick = function(){  
			get_url(this); 
		}   
	} 
	
	function get_url(alvo){ 
		if( alvo.email ){
			document.location.href = alvo.url;
		}else{
			window.open(alvo.url);		
		}
	}
	
	contato_lb.email = true;
	contato_lb.url = dados_contato[4][2];
	contato_lb.onclick = function(){
		get_url(this);
	}
	
	function rolar_tela(para,d){ 
		$(document.body).scrollTo(para, 0, {duration:d, easing:"easeInOutQuart"}  ); 
	}
	
	var _page_y = 0;
	
	function mostrar_painel_projeto(){
		painel_projeto.escondido = false;
		$(proj_aba).fadeOut(dur);
		$(painel_projeto).animate( { top:0 }, dur,"easeInOutQuart");
	}	
	
	function verifica_scroll(){  
		
		_page_y = page_y; 
		page_y = $(window).scrollTop() + win_h/2;   
		
		if( projeto_aberto  ){
			if( _page_y < page_y - 10 && !painel_projeto.escondido && page_y > win_h/2+84 ){ 
				
				painel_projeto.escondido = true;
				$(proj_aba).fadeIn(dur); 
				$(painel_projeto).animate( { top:-65 }, dur,"easeInOutQuart"); 
				 
			}
			
			if( (_page_y > page_y + 30 && painel_projeto.escondido) || page_y == win_h/2 ){
				mostrar_painel_projeto();
			} 
		}
		
		if(menu.aberto) fechar_menu();	
		
		if( page_y > 1.5*win_h - 1 && seta_topo.fechada ){ 
			seta_topo.fechada = false;	
			$(seta_topo).animate( { height:44 },dur/2);
		}
		
		if( page_y < 1.5*win_h - 1 && !seta_topo.fechada ){
			seta_topo.fechada = true;
			$(seta_topo).animate( { height:0 },dur/2 );
		}
		
		//TELAS
		//topo
		if( page_y < $(anc_projetos).offset().top && tela_at != 0 ){
			mudar_tela(0);
		}
		
		//projetos 
		if( page_y > $(anc_projetos).offset().top && page_y < $(clientes).offset().top && tela_at != 1 ){
			mudar_tela(1); 
			if(ciclo_iniciar) clear_ciclo_iniciar();
		}
		
		//clientes 
		if( page_y > $(clientes).offset().top && page_y < $(parceiros).offset().top && tela_at != 2 ){
			mudar_tela(2);
		}	
		
		//parceiros 
		if( page_y > $(parceiros).offset().top && page_y < $(sobre).offset().top && tela_at != 3 ){
			mudar_tela(3);
		}	
		
		//sobre 
		if( page_y > $(sobre).offset().top && page_y < $(rodape).offset().top && tela_at != 4){
			mudar_tela(4);
		}	
		
		//sobre 
		if( page_y > $(rodape).offset().top && tela_at != 5){
			mudar_tela(5);
		}				
		
	}   
	
	window.onscroll = verifica_scroll;

		
	function mudar_tela(para){
	
		tela_at = para;
		for(i=1; i<=n_bts; i++){  
			itm = document.getElementById("bt" + i);
			if(itm.tela == tela_at){
				bt_modo(itm,true);
			}else{
				bt_modo(itm,false);	
			}
		}
		
	}   

	function cl(alvo){
		if(alvo){
			console.log(">>>>" + alvo);
		}else{
			console.log(">>>> vc esta aqui");
		}
	} 
	 
	var meses = [ null,
				["JAN","JANEIRO"],
				["FEV","FEVEREIRO"],
				["MAR","MARÇO"],
				["ABR","ABRIL"],
				["MAI","MAIO"],
				["JUN","JUNHO"],
				["JUL","JULHO"],
				["AGO","AGOSTO"],
				["SET","SETEMBRO"],
				["OUT","OUTUBRO"],
				["NOV","NOVEMBRO"],
				["DEZ","DEZEMBRO"]];

	function faz_data(data){ 
		
		if(data == "HOJE"){ 
			return "HOJE";	 // LG!
		}else{
			var _data = data.split("-"); 
			
			var mes = Number( _data[1] );
			var ano = Number( _data[0] );
			
			if(mes && ano)	return meses[mes][nlg] + " " + ano;
			
		}
		
	}		
	
	function fill(alvo,cor){
		alvo.setAttribute("fill",cor);
	}
	
	function raio(alvo,val){
		alvo.setAttribute("r",val);
	} 
	 
	function stroke(alvo,cor){
		alvo.setAttribute("stroke",cor);
	}
	
	/* NAVEGADOR */
	
	var paginas = [ null, 
					["projetos","projects",anc_projetos],
					["clientes","clients",anc_clientes],
					["parceiros","partners",anc_parceiros],
					["sobre","about",anc_sobre],
					["contato","contact",rodape]];  
						
	var h_menu = paginas.length * 33;
	var n_bts = paginas.length-1;
	 
	for(i=1; i<=n_bts; i++){  
		//menu 
		itm = document.createElement( "li" );
		itm.tela = i;
		itm.ancora = paginas[i][2];
		itm.id = "bt" + i;	
		
		itm4 = document.createElement("div");
		itm4.className = "menu_lb";
		itm.appendChild(itm4);
				
		itm2 = document.createElement( "span" );
		itm2.className = "menu_id";
		itm2.innerHTML = "0" + i;  
		itm4.appendChild(itm2);
		
		itm3 = document.createElement( "span" ); 
		itm3.innerHTML = paginas[i][nlg].toUpperCase(); 
		itm3.id = "bt"+i+"_lb"; 
		itm4.appendChild(itm3);
		
		itm.onclick = function(){  
			rolar_tela( $(this.ancora).offset().top , 500 );
			fechar_menu();
		};  
		
		menu_bts.insertBefore(itm, menu_filtro1 );  
	} 
	 
	
	function get(lb) {   
		var id = window.location.href.split("?"+lb+"=")[1];
		if(id) return id; 
		else return null;
	} 
	
	 
	/* filtros */ 
	
	var filtro_lbs = [null,["INTERATIVO","INTERACTIVE"],["V&Iacute;DEO","MOTION"],["IMPRESSO","PRINT"]]; 
	 
	
	for(i=1; i<=3; i++){
		
		itm = document.getElementById( "filtro" + i );
		itm.ID = i;
		itm.style.width = "55px";
				
		itm.lb.innerHTML = filtro_lbs[i][nlg];
		itm.style.color = cores[i];
		
		stroke( itm.path, cores[i] ); 
		stroke( itm.fechar, cores[i] ); 
		
		itm.onclick = filtrar; 
		
		//menu 
		itm2 = document.getElementById("menu_filtro" + i );
		itm2.ID = i;
		itm2.lb.innerHTML = filtro_lbs[i][nlg];
		itm2.style.backgroundColor = cores[i];
		
		itm2.onclick = filtrar; 
		
		//projeto
		itm3 = document.getElementById("suporte" + i ); 
		itm3.lb.innerHTML = filtro_lbs[i][nlg];
		itm3.lb.style.color = cores[i];
		stroke(itm3.path, cores[i]);
		
	} 
	
	/* FUNCS */  
	
	// seta iniciar 
	ciclo_seta_iniciar = setInterval(function(){
		seta_iniciar.style.bottom = "50px";
		seta_iniciar.style.opacity = 0;
		$(seta_iniciar).animate( { bottom:"20px", opacity:1 }, 500, "easeOutQuart" );
	}, 1500);
	
	seta_iniciar.onclick = function(){
		rolar_tela(anc_projetos, 500);
		clear_ciclo_iniciar();
		ciclo_iniciar = false;
	}
	
	function clear_ciclo_iniciar(){
		$(seta_iniciar).hide();
		clearInterval(ciclo_seta_iniciar);
	}
	
	
	var rgb; 
	  
	function filtrar(){   
		
		skill_at = -1;  
		
		if(menu.aberto) fechar_menu();
		
		if(filtro_at != this.ID){ // ligar    
			
			$(menu_bt).animate( {backgroundColor: cores[this.ID]}, dur);
			$(logo_mais).animate( {backgroundColor: cores[this.ID]}, dur);
							
			for(i=1; i<=3; i++){ 
				itm2 = document.getElementById("filtro" + i ); 
				itm3 = document.getElementById("menu_filtro" + i ); 
				
				if(itm2.ID != this.ID) { 
					itm3.style.backgroundColor = chumbo2;
					itm3.style.color = cores[itm3.ID];
					stroke(itm3.path, cores[itm3.ID]);
					itm3.fechar.style.display = "none";
					
					$(itm2).animate( {  width:55, opacity:.2 },dur, "easeInOutQuart"); 
					$(itm2.path).animate( { svgStroke:branco}, dur, "easeInOutQuart");
					
				}else{ 
					itm3.style.backgroundColor = cores[this.ID];
					itm3.style.color = branco;
					stroke(itm3.path, branco );
					itm3.fechar.style.display = "block";
					
					$(itm2).animate( { width:180, opacity:1  },dur, "easeInOutQuart"); 
					$(itm2.path).animate( { svgStroke:cores[this.ID]}, dur, "easeInOutQuart");   
										
				}
			}  
			
			filtro_at = this.ID;
			
			// filtrar projetos   
			//logo 
			for(i=0; i<logo.projetos.length; i++){ 
				itm = logo.projetos[i];   
				if(itm.suporte == filtro_at){ 
					$(itm).show();
				}else{  	
					$(itm).hide();
				}
			}   
			
			for(i=0; i<logo.linhas.length; i++){ 
				itm = logo.linhas[i];   
				if(itm.suporte == filtro_at){ 
					$(itm).show();
				}else{  	
					$(itm).hide();
				}
			}  
			
			//portfolio 
			for(i=0; i<portfolio.projetos.length; i++){ 
				itm = portfolio.projetos[i];  
				if(itm.suporte == filtro_at){   
					 
					itm.titulo.style.backgroundColor = cores[itm.suporte]; 
					itm.style.paddingTop = "";
					itm.style.borderColor = ""; 
					
				}else{    
					
					itm.titulo.style.backgroundColor = cinza2; 
					itm.style.paddingTop = 0;
					itm.style.borderColor="#faf8f7";
					
				}   
			} 
			
			//projetos 
			for(i=0; i<projetos.projetos.length; i++){ 
				itm = projetos.projetos[i];   
				if(itm.suporte == filtro_at){
					itm.img.className = "";
					itm.img.style.opacity = 1;   
				}else{  
					itm.img.className = "desaturate";
					itm.img.style.opacity = .1;   
				}
			} 
			
			//clientes 
			for(i=0; i<clientes.projetos.length; i++){ 
				itm = clientes.projetos[i];   
				if(itm.suporte == filtro_at){
					itm.img.className = "";
					itm.img.style.opacity = 1;   
				}else{  
					itm.img.className = "desaturate";
					itm.img.style.opacity = .1;   
				}
			} 
			
			//parceiros 
			for(i=0; i<parceiros.projetos.length; i++){ 
				itm = parceiros.projetos[i];   
				if(itm.suporte == filtro_at){
					itm.img.className = "";
					itm.img.style.opacity = 1;   
				}else{  
					itm.img.className = "desaturate";
					itm.img.style.opacity = .1;   
				}
			} 
			
			//sobre
			for(i=0; i<sobre.projetos.length; i++){ 
				itm = sobre.projetos[i];   
				if(itm.suporte != filtro_at){
					itm.style.backgroundColor = cinza1; 
				}else{ 
					itm.style.backgroundColor = cores[itm.suporte]; 
				}
			}
			
			for(i=1; i<=12; i++){
				skill = document.getElementById("skill"+i);
				
				if(skill.suporte != filtro_at){
					skill_bolas(skill, cinza2);
					$(skill).animate({ color: cinza2 },dur);
				}else{ 
					skill_bolas(skill, cores[skill.suporte]);
					$(skill).animate({ color: cores[skill.suporte] },dur);
				}
			}
			
		
		}else{  ///////////////// DESLIGAR	 
			
			filtro_at = 0;  
			
			$(menu_bt).animate( {backgroundColor:chumbo2}, dur);
			$(logo_mais).animate( {backgroundColor: chumbo2}, dur); 
			 
			for(i=1; i<=3; i++){ 
				itm2 = document.getElementById("filtro" + i ); 
				itm3 = document.getElementById("menu_filtro" + i ); 
				
				$(itm2).animate( { width:55, opacity:1  },dur, "easeInOutQuart"); 
				$(itm2.path).animate( { svgStroke:cores[itm2.ID]}, dur, "easeInOutQuart");  
			 
				itm3.style.backgroundColor = cores[itm3.ID];
				itm3.style.color = branco;
				stroke(itm3.path, branco );
				itm3.fechar.style.display = "none";
			}   
			
			//logo   
			for(i=0; i<logo.projetos.length; i++){ 
				itm = logo.projetos[i];   
				$(itm).show();
			} 
			
			for(i=0; i<logo.linhas.length; i++){ 
				itm = logo.linhas[i];   
				$(itm).show();
			} 
			 
			// portfolio
			for(i=0; i<portfolio.projetos.length; i++){ 
				itm = portfolio.projetos[i];
				itm.titulo.style.backgroundColor = cores[itm.suporte]; 
				itm.style.paddingTop = "";
				itm.style.borderColor = ""; 
			}  
			
			//projetos
			for(i=0; i<projetos.projetos.length; i++){ 
				itm = projetos.projetos[i];   
				itm.img.className = "";
				itm.img.style.opacity = 1; 
			} 
			
			//clientes
			for(i=0; i<clientes.projetos.length; i++){ 
				itm = clientes.projetos[i];   
				itm.img.className = "";
				itm.img.style.opacity = 1; 
			} 
			
			//parceiros
			for(i=0; i<parceiros.projetos.length; i++){ 
				itm = parceiros.projetos[i];   
				itm.img.className = "";
				itm.img.style.opacity = 1; 
			} 
			
			//sobre
			for(i=0; i<sobre.projetos.length; i++){ 
				itm = sobre.projetos[i];   
				itm.style.backgroundColor = cores[itm.suporte]; 
			} 
			
			for(i=1; i<=12; i++){ 
				skill = document.getElementById("skill"+i); 
				$(skill).animate({ color: cores[skill.suporte] },dur);
				skill_bolas(skill, cores[skill.suporte]);
			}  
		}   		
	}  
	
	function sorte_sinal(){ 
		var sorte = Math.random()*2; 
		if(sorte < 1) return -1 ;
		else return 1;			
	}  
	
	function verifica_x( n ){
		
		if(n > 1000 && n < 1200) n += 300*Math.random();
		if(n < 1000 && n > 300) n -= 300*Math.random();;
		
		return n;
	}
	 
	function gerar_logo(){ 
		
		for(i=0; i<logo.projetos.length; i++){ 
			
			circ = logo.projetos[i]; 
			
			circ.posx = Math.round( 1000 + win_w/1.5 * Math.random() * sorte_sinal() )+.5 ;
			circ.posy = Math.round( 1000 + win_h/2 * Math.random() * sorte_sinal() )+.5;
			
			$(circ).animate( {svgCx:circ.posx, svgCy:circ.posy  }, 2*dur, "easeInOutQuart");
			$(circ.centro).animate( { svgCx:circ.posx, svgCy:circ.posy  }, 2*dur, "easeInOutQuart");
		  
		} 
		
		for(i=0; i<logo.linhas.length; i++){	  
			linha = logo.linhas[i]; 
			$(linha).animate( { svgX1:linha.circ.posx, svgY1:linha.circ.posy, svgX2:linha.circ2.posx, svgY2:linha.circ2.posy  }, 2*dur, "easeInOutQuart");
		
		}
		
	} // GERAR_LOGO 

	function desordenar_logo(){
		
		logo.ordenado = false;
		
		$(trcom).fadeIn(2*dur);	
		$(leg1).fadeOut(2*dur);
		$(leg2).fadeOut(2*dur);
		if(ciclo_iniciar) $(seta_iniciar).fadeIn(2*dur);	
		
		$(logo_mais_path).animate( { svgTransform:"rotate(45 22 22)"}, 2*dur ,"easeInOutQuart");	
		
		$(filtros).animate( { top:"55%"}, 2*dur ,"easeInOutQuart");	
		
		gerar_logo();	
		
	}

	function ordenar_logo(){
		
		rolar_tela(0,0);
		
		fechar_menu(); 
		
		$(trcom).fadeOut(2*dur);	
		if(ciclo_iniciar) $(seta_iniciar).fadeOut(2*dur);	
		
		$(logo_mais_path).animate( { svgTransform:"rotate(0 22 22)"}, 2*dur ,"easeInOutQuart", function(){
			logo.ordenado = true;
		});
		
		var graf_h = win_h / 6;
		var graf_w =  win_w/1.25 ;
		var graf_topo = (1000 - graf_h*2 -10); 
		
		$(filtros).animate( { top:win_h/2 + graf_h*2 - 50 }, 2*dur ,"easeInOutQuart");	
		
		//legendas
		leg1.setAttributeNS(null, "transform", "translate("+ 900 +" "+ graf_topo + ")" );
		leg2.setAttributeNS(null, "transform", "translate("+ 1100 +" "+ graf_topo + ")" );
		
		leg2.setAttributeNS(null, "fill", "#000");
		
		$(leg1).fadeIn(2*dur);
		$(leg2).fadeIn(2*dur); 
		
		for(a=1; a<=3; a++){
			
			//projetos
			for(i=0; i<logo.suportes[a].length; i++){
				itm = logo.suportes[a][i]; 
				itm2 = null; 
				
				if(i==0){
					itm.posx = Math.round(1000 - graf_w/2) + .5;	
				} else{ 
					itm2 = logo.suportes[a][i-1];
					itm.posx =  itm2.posx + graf_w/(logo.suportes[a].length-1);
				} 
				
				itm.posy = Math.round(1000 - graf_h*(4-a) + graf_h*2 ) + .5; 
			}
			
			// ajuste fino 
			for(i=0; i<logo.suportes[a].length; i++){
				itm = logo.suportes[a][i];
				itm.posx = Math.round(itm.posx) + .5;
				$(itm).animate( { svgCx:itm.posx, svgCy:itm.posy }, 2*dur, "easeInOutQuart");
				$(itm.centro).animate( { svgCx:itm.posx, svgCy:itm.posy  }, 2*dur, "easeInOutQuart");
			} 
			
		} 
		
		//linhas
		for(i=0; i<logo.linhas.length; i++){ 
			itm = logo.linhas[i];
			$(itm).animate( { svgX1:itm.circ.posx, svgY1:itm.circ.posy, svgX2:itm.circ2.posx, svgY2:itm.circ2.posy }, 2*dur, "easeInOutQuart"); 
		}
			
	}
	  
	////////////////////////////////////////////////////////////////// XML DADOS //////////////////////////////////////////////////////////////////
	 
 	
	function ponteiro_lista(xml,i,lb){ //  ponteiro que retorna conteúdo da tag com index = i
		if(xml[i].getElementsByTagName(lb)[0].firstChild){ // se a tag estiver vazia, o firstChild = null da bug no retorno da proxima linha
			return xml[i].getElementsByTagName(lb)[0].firstChild.nodeValue;  
		}
	}  
	
	function ponteiro_dados(xml,lb){ //  ponteiro que retorna conteúdo da tag
		if(xml.getElementsByTagName(lb)[0].firstChild){ 
			return xml.getElementsByTagName(lb)[0].firstChild.nodeValue;  
		}
	} 
	
	function ponteiro_dados_lista(xml,lb_lista,id_bd,lb){ //  ponteiro que retorna conteúdo da tag com index = i
		
		var lista = xml.getElementsByTagName(lb_lista); 
	
		for(var i=0; i<lista.length; i++){ 
			var itm = lista[i]; 
			var itm_id = itm.getElementsByTagName("id")[0].firstChild.nodeValue;
			
			if( itm_id == id_bd){
				return itm.getElementsByTagName(lb)[0].firstChild.nodeValue;
			}
		} 
		
		return false;
		
	} 
	
	
	function xml2arr(_xml, obj_lb, atts){ //  funcao que converte xml em arr assoc com objetos
		//atts: array com identificadores das variaveis
				
		//converter xml em array associativo
		var arr = [];
		var id;
		var obj;
		var xml = _xml.getElementsByTagName(obj_lb); 
		
		//montar objetos e inserir no array
		for(var i=0; i<xml.length; i++){ 
				
			obj = {};
			id = ponteiro_lista(xml,i,"id");
			
			for(var a=0; a<atts.length; a++){  
				obj[atts[a]] = ponteiro_lista(xml,i,atts[a]);
			} 
			 
			//para que ambos funcionem (associativo e index):
			// inserir o obj duas vezes:  
			arr.push(obj);  // 1o com push (soma index); 
			arr[obj_lb + id] = obj; // 2o com string (não soma index); 
		}
		
		return arr; 
	}  
	
	var rand = Math.random() * 1000; 
	
	var xml_TRCOM_request;		
	var xml_TRCOM; 
	
	var xml_clientes_request;		
	var xml_clientes;
	
	var xml_projetos_request;		
	var xml_projetos;
	var projetos_arr;  
	
	var xml_timeline_request;		
	var xml_timeline; 
	var timeline_arr;  
	
	var xml_proj_request;		
	var xml_proj; 
	
	if(window.XMLHttpRequest){ 
		xml_TRCOM_request = new XMLHttpRequest();
		xml_clientes_request = new XMLHttpRequest();
		xml_projetos_request = new XMLHttpRequest();
		xml_timeline_request = new XMLHttpRequest();
		xml_proj_request = new XMLHttpRequest();
	}else if(window.ActiveXObject){ 
		xml_TRCOM_request = new ActiveXObject("Microsoft.XMLHTTP");
		xml_clientes_request = new ActiveXObject("Microsoft.XMLHTTP");
		xml_projetos_request = new ActiveXObject("Microsoft.XMLHTTP");
		xml_timeline_request = new ActiveXObject("Microsoft.XMLHTTP");
		xml_proj_request = new ActiveXObject("Microsoft.XMLHTTP");
	} 
	
	// xml TRCOM 
	
	xml_TRCOM_request.onreadystatechange = function(){  
		if(this.readyState === 4){  
			xml_TRCOM = this.responseXML;
			
		 	// reel
			var reel = document.createElement("div");
			reel.id = "reel";
			reel.innerHTML = ponteiro_dados(xml_TRCOM,"reel");
			//portfolio.appendChild(reel);
			
			tx_atualizado.innerHTML = " + " + faz_data(ponteiro_dados(xml_TRCOM,"atualizado")); 
			 
			// xml 2/4 : timeline	
			xml_timeline_request.open("GET", "xml/timeline.xml?rand="+rand, true);
			xml_timeline_request.send(null); 
		}
	}   
	
	// xml timeline 
	xml_timeline_request.onreadystatechange = function(){  
		if(this.readyState === 4){  
			xml_timeline = this.responseXML;  
			
			timeline_arr = xml2arr ( xml_timeline, "evento", [	"id",
																	"titulo_pt",
																	"titulo_en",
																	"sub_pt",
																	"sub_en",																	
																	"data_ini",																
																	"data_fim",																
																	"id_projeto",		
																	"url"]);
			
			
			
			
		 	// TIMELINE 
			var hoje = new Date();
			var fim_do_ano = new Date(hoje.getFullYear(),11,31);
			var a1997 = new Date(1997,00,1);
			var ano;
			var ano_projs;
			var titulo;
			var subtitulo;
			var ponto;
			var periodo;
			var duracao;
			var posicao;
			var data_ini;
			var data_fim;
			var periodo_livre = new Date(1997,00,1);
			
			for(i=1997; i<=hoje.getFullYear(); i++){ 
				ano = document.createElement("div");
				ano.className = "tl_ano"; 
				ano.innerHTML = i;
				
				ano_projs = document.createElement("div");
				ano_projs.className = "tl_ano_projs";
				ano_projs.id = "ano_"+i;
				ano.appendChild(ano_projs);
				
				if( i == hoje.getFullYear() ){
					ano.style.borderRight = 0;	
				}
				
				timeline.appendChild(ano); 
			}  
			
			var tl_borda = document.createElement("div");
			tl_borda.className = "tl_borda";
			
			timeline.appendChild(tl_borda);
			
			var tl_legenda = document.createElement("div");
			tl_legenda.id = "tl_legenda";
			
			var tl_tx = document.createElement("div");
			tl_tx.id = "tl_tx_noticias";
			tl_tx.innerHTML = "NOVO CLIENTE";
			tl_tx.style.top = "75px";
			tl_legenda.appendChild(tl_tx);
			
			tl_tx = document.createElement("div");
			tl_tx.id = "tl_tx_noticias";
			tl_tx.innerHTML = "PROJETOS";
			tl_tx.style.top = "100px";
			tl_legenda.appendChild(tl_tx); 
			
			tl_tx = document.createElement("div");
			tl_tx.id = "tl_tx_noticias";
			tl_tx.innerHTML = "NOTICIAS";
			tl_tx.style.top = "123px";
			tl_legenda.appendChild(tl_tx);  
			
			tl_tx = document.createElement("div");
			tl_tx.id = "tl_tx_noticias";
			tl_tx.innerHTML = "CARGOS";
			tl_tx.style.top = "150px";
			tl_legenda.appendChild(tl_tx);
						
			timeline_wrap.appendChild(tl_legenda);   
			
			// Eventos   
			for(i=0; i<timeline_arr.length; i++){
				
				itm = document.createElement("div");
				itm.ID = i;
				itm.id = "tl" + i; 
				itm.id_bd = timeline_arr[i]["id"];
				itm.titulo_pt = timeline_arr[i]["titulo_pt"];
				itm.titulo_en = timeline_arr[i]["titulo_en"];
				itm.sub_pt = timeline_arr[i]["sub_pt"];
				itm.sub_en = timeline_arr[i]["sub_en"];
				itm.id_projeto = Number( timeline_arr[i]["id_projeto"] );
				itm.url = timeline_arr[i]["url"];
				
				itm.data_ini_st = timeline_arr[i]["data_ini"];
				
				if( timeline_arr[i]["data_fim"] == "0000-00-00" ){
					itm.data_fim_st = "HOJE"; 
					data_fim = [new Date().getFullYear(), new Date().getMonth(), new Date().getDate()];
				}else{
					itm.data_fim_st = timeline_arr[i]["data_fim"];
					data_fim = timeline_arr[i]["data_fim"].split("-");
				} 
				
				itm.data_fim = new Date(data_fim[0],data_fim[1]-1,data_fim[2]);  
				
				if(timeline_arr[i]["data_ini"] != "0000-00-00"){ // periodo 
					
					itm.tipo = "cargo";
					data_ini = timeline_arr[i]["data_ini"].split("-");
					itm.data_ini = new Date(data_ini[0], data_ini[1]-1, data_ini[2]);
					
					posicao = duracao_meses( a1997, itm.data_ini );   
					
					itm.className = "periodo";
					
					duracao = duracao_meses( itm.data_ini, itm.data_fim ); 
					itm.style.width = 100/12*duracao + "px";
					
					titulo = document.createElement("span");
					titulo.className = "tl_titulo";
					titulo.innerHTML = itm[ "titulo" + lg];
					
					subtitulo = document.createElement("span");
					subtitulo.className = "tl_subtitulo";
					subtitulo.innerHTML = itm["sub" + lg].toUpperCase();
					
					itm.appendChild(titulo);
					itm.appendChild(subtitulo); 
					
				}else{  // noticia
				
					itm.tipo = "noticia";
					itm.className = "ponto";  
					posicao = duracao_meses( a1997, itm.data_fim );   
					
				} 
				
				itm.style.left = 100/12 * posicao + "px";
				itm.pos_x = 100/12 * posicao;
			
				timeline.appendChild(itm); 
			
				itm.onclick = function(){  
					
					if(tl_at == this.ID){
						
						tl_at = -1; 
						$(tl_mais).fadeOut(dur/2);	
							
					}else{ 
					
						tl_at = this.ID; 
										
						if(this.tipo == "cargo"){
							
							tl_mais_data.innerHTML = faz_data(this.data_ini_st) + "&nbsp; &rarr; &nbsp; " + faz_data(this.data_fim_st);
						}else{
							tl_mais_data.innerHTML = faz_data(this.data_fim_st);
						}
						
						if(this.url != ""){
							$(tl_mais_url).show();
							tl_mais_url.url = this.url;
						}else{							
							$(tl_mais_url).hide();
						}
												
						if(this.id_projeto > 0){
							tl_mais_img.src = "projetos/projeto" + this.id_projeto + "/tb_cor.jpg";
						}else{
							tl_mais_img.src = "TRCOM/tl" + this.id_bd +  ".jpg";
						}
						
						tl_mais_titulo.innerHTML = this["titulo"+lg];
						tl_mais_sub.innerHTML = this["sub"+lg]; 
						
						$(tl_mais).hide();
						$(tl_mais).fadeIn(dur/2);
						
					} 
				} 
			}   
			
			
			// skills   
			var skill;
			var skills = 	[null,
							["Photoshop", 5],
							["illustrator", 5],
							["InDesign",2],
							["After Effects", 5],
							["Premiere",4],
							["Flash",5],
							["HTML 5",3],
							["CSS",5],
							["Javascript",5],
							["ActionScript 3",4],
							["PHP",5],							
							["MySQL", 1]
							];
			
			for(i=1; i<=12; i++){   
				
				skill = document.createElement("div");
				skill.id = "skill" + i;
				skill.ID = i;
				skill.className = "skill";
				skill.bolas = [];
				
				var skill_lb = document.createElement("span");
				skill_lb.className = "skill_lb";
				skill_lb.innerHTML = skills[i][0].toUpperCase();  
				skill.appendChild(skill_lb);
				
				if( i<4 ){
					skill.suporte = 3;
					skills3.appendChild(skill);
					skill.style.color = cores[3]; 
				}
				
				if( i>=4 && i<7 ){
					skill.suporte = 2;
					skills2.appendChild(skill);
					skill.style.color = cores[2];
				}
				
				if( i>=7 ){					
					skill.suporte = 1;
					skills1.appendChild(skill);
					skill.style.color = cores[1];
				} 
				
				for(var b=1; b<=5; b++){
				
					var bola = document.createElement("span");
					bola.className = "skill_bola"; 
					
					skill.appendChild(bola);
					
					if( b > skills[i][1] ){  
						bola.style.background = cinza2;
					}else{
						bola.style.background = cores[skill.suporte];
						skill.bolas.push(bola); 
					}  
				} 
				
			} 
			
			// xml 3/4 : clientes	
			xml_clientes_request.open("GET", "xml/clientes.xml?rand="+rand, true);
			xml_clientes_request.send(null); 
		}
	}    
	
	
	function duracao_meses(data_ini,data_fim){ 
		return (data_fim.getFullYear() - data_ini.getFullYear())*12 + (data_fim.getMonth() - data_ini.getMonth()); 	
	}	  
	
	tl_mais_fechar.onclick = function(){
		tl_at = -1;
		$(tl_mais).fadeOut(dur/2);	
	}
	
	tl_mais_url.onclick = function(){
		window.open(this.url);	
	}
	
	
	// xml clientes 
	xml_clientes_request.onreadystatechange = function(){  
		if(this.readyState === 4){  
			xml_clientes = this.responseXML;     
			
			clientes_arr = xml2arr ( xml_clientes, "cliente", [	"id",
																"cliente_pt",
																"cliente_en",
																"site",
																"categ_cliente",
																"categ_parceiro",
																"ultima_data"]);
			
			// xml 4/4 : projetos	
			xml_projetos_request.open("GET", "xml/projetos.xml?rand="+rand, true);
			xml_projetos_request.send(null);
			 
		}
	}  
	
	//xml proj  
	var proj_id;
	var proj_portif;
	var proj_public;
	var proj_suporte; 
	var proj_data; 
	var proj_url; 
	var proj_nome;
	var proj_dados_pt;
	var proj_sb;
	var proj_ano;
	var proj_cliente;
	var proj_parceiro;
	var ano;
	var tl_proj;
	var tl_ano;
	var tl_cliente;
	var tl_clientes = [];
	var tl_anos_arr = [];
	
	var relac_id;
	var relac_public;
	var relac_cliente;
	var relac_parceiro;
	
	xml_projetos_request.onreadystatechange = function(){  
		if(this.readyState === 4){ 
			
			xml_projetos = this.responseXML;  
			
			projetos_arr = xml2arr(xml_projetos, "projeto", 
													["id",
													"id_cliente",
													"id_parceiro", 
													"id_suporte",
													"dd_portfolio",
													"projeto_pt",
													"projeto_en",
													"publicado_pt",
													"publicado_en",
													"data",
													"display"]);  
				
		 
		 
		 	// LISTA DE PROJETOS
			
			var ano_at = 0;	 
			
			for(i=0; i<projetos_arr.length; i++){	
				
				proj_id = projetos_arr[i]["id"];
				proj_portif = projetos_arr[i]["dd_portfolio"];
				proj_public = projetos_arr[i]["publicado"+lg]; // LG!!!!
				proj_suporte = projetos_arr[i]["id_suporte"];
				proj_ano = Number(projetos_arr[i]["data"].split("-")[0]);
				proj_cliente = projetos_arr[i]["id_cliente"];
				proj_parceiro = projetos_arr[i]["id_parceiro"];
				 
				itm = document.getElementById("filtro" + proj_suporte); // pega filtro do projeto  
				
				if(proj_public == 1){ //publicado 
					 
					n_proj[Number(proj_suporte)] ++;
					
					// PORTFOLIO 
					if(proj_portif == 1){   
						port_cel( i, portfolio ); 
					} 
					
					// PROJETOS 
					if(proj_ano != ano_at ){
											
						if(ano_at != 0){					
												
							//projetos
							ano = document.createElement("div");
							ano.className = "ano";
							ano.innerHTML = proj_ano; 
							projetos.appendChild(ano);  
						
						}						
						
						ano_at = proj_ano;
						
					}
					
					proj_cel(i,projetos,"proj_cel"); 
					 
					// TIMELINE
					tl_proj = document.createElement("div");
					tl_proj.className = "tl_proj";
					
					if(proj_portif == 1){
						tl_proj.className += " tl_port";	
					}
					
					$(tl_proj).css({ backgroundColor:cores[proj_suporte] });
					tl_proj.suporte = proj_suporte;
					tl_proj.ID = proj_id;
					
					tl_proj.onclick = function(){
						chamar_projeto(this.ID);	
					}
					
					tl_ano = document.getElementById("ano_" + proj_ano);
					if(!tl_ano.lft) tl_ano.lft = 0; 
					tl_ano.appendChild(tl_proj);
					sobre.projetos.push(tl_proj);
					
					tl_ano.lft += 4;
					tl_ano.style.left = (100-tl_ano.lft)/2 + "px";
					 
					if( proj_cliente > 0 ){
						
						// clientes
						if( tl_clientes.indexOf(proj_cliente) < 0 ){ 
							tl_clientes.push(proj_cliente); 
							tl_cliente = document.createElement("div");
							tl_cliente.className = "tl_cliente";
							tl_proj.appendChild(tl_cliente); 
						}   	
						
						if(!clientes_arr["cliente" + proj_cliente]["n_projetos"]){
							clientes_arr["cliente" + proj_cliente]["n_projetos"] = 1;
						}else{
							clientes_arr["cliente" + proj_cliente]["n_projetos"] ++;
						}
						
						// indica projetos publicados no clientes arr 
						if(!clientes_arr["cliente" + proj_cliente]["projetos_cliente"]){
							clientes_arr["cliente" + proj_cliente]["projetos_cliente"] = [proj_id];
						}else{
							clientes_arr["cliente" + proj_cliente]["projetos_cliente"].push(proj_id);
						}
						
					}
					
					if( proj_parceiro > 0 ){
						
						if(!clientes_arr["cliente" + proj_parceiro]["n_projetos"]){
							clientes_arr["cliente" + proj_parceiro]["n_projetos"] = 1;
						}else{
							clientes_arr["cliente" + proj_parceiro]["n_projetos"] ++;
						}
						
						if( !clientes_arr["cliente" + proj_parceiro]["projetos_parceiro"]){
							clientes_arr["cliente" + proj_parceiro]["projetos_parceiro"] = [proj_id];
						}else{
							clientes_arr["cliente" + proj_parceiro]["projetos_parceiro"].push(proj_id);
						} 
					}					
				}  
			}  
			   
			// monta LOGO  
			
			for(i=0; i<projetos_arr.length; i++){	
			
				proj_public = projetos_arr[i]["publicado" + lg];  
				proj_suporte = projetos_arr[i]["id_suporte"];
				proj_cliente = projetos_arr[i]["id_cliente"];
				proj_portif = projetos_arr[i]["dd_portfolio"]; 
				proj_data = projetos_arr[i]["data"].split("-");
				
				if(proj_public == 1){ // publicado 
					
					periodo_proj = new Date(proj_data[0], proj_data[1]-1, proj_data[2]) - new Date(2004,00,01)  ; 
					 
					circ = document.createElementNS("http://www.w3.org/2000/svg", "circle");  
					circ.suporte = proj_suporte;
					circ.cliente = proj_cliente;
					circ.setAttributeNS(null, "fill", cores[proj_suporte] );  
					if(proj_portif == 1){
						circ.setAttributeNS(null, "fill-opacity", ".3"); 
					}else{
						circ.setAttributeNS(null, "fill-opacity", ".1"); 
					}
					circ.cr = 2 + periodo_proj/periodo_total * 25;
					circ.setAttributeNS(null, "r", circ.cr);
					circ.posx = 1000;
					circ.posy = 1000;
					circ.setAttributeNS(null, "cx", 1000);
					circ.setAttributeNS(null, "cy", 1000);
					circ.id = "circ" + i;	  
					 
					centro = document.createElementNS("http://www.w3.org/2000/svg", "circle");   
					centro.setAttributeNS(null, "stroke", "none" );  
					centro.setAttributeNS(null, "fill", cores[proj_suporte] ); 
					centro.setAttributeNS(null, "cx", 1000 );
					centro.setAttributeNS(null, "cy", 1000 );
					centro.setAttributeNS(null, "r", 1 );
					 
					circ.centro = centro;
					
					logo_path.appendChild(circ);
					logo_path.appendChild(centro);
					logo.projetos.push(circ);
					logo.suportes[proj_suporte].push(circ);
					
				}
				
			}
			
			//linhas
			for(a=1; a<=3; a++){
				
				for(i=0; i<logo.suportes[a].length-1; i++){	
						
					circ = logo.suportes[a][i];
					circ2 = logo.suportes[a][i+1];
						
					linha = document.createElementNS("http://www.w3.org/2000/svg", "line");
					linha.setAttributeNS(null, "stroke", cores[a] );
					linha.setAttributeNS(null, "stroke-width", 1 ); 
					linha.setAttributeNS(null, "stroke-opacity", .1 );  
					linha.setAttributeNS(null, "x1", circ.posx );  
					linha.setAttributeNS(null, "y1", circ.posy );   
					linha.setAttributeNS(null, "x2", circ2.posx );  
					linha.setAttributeNS(null, "y2", circ2.posy );
					linha.suporte = a;
					
					linha.circ = circ;
					linha.circ2 = circ2;
					
					logo_linhas.appendChild(linha);
					logo.linhas.push(linha);
				}
				
			}		
				
			logo.suportes[1].reverse();
			logo.suportes[2].reverse();
			logo.suportes[3].reverse();		 
			
			logo.onclick = function(){ 
				if(!logo.ordenado){
					gerar_logo();
				}else{
					desordenar_logo();	
				}
			 } 
			 
			 logo.ordenado = false;
			 
			 logo_mais.onclick = function(){ 
				if(logo.ordenado){
					desordenar_logo();					
				}else{
					ordenar_logo(); 
				} 
			 } 
			 
			// legenda_logo
			
			//LEG1
			 
			leg1 = document.createElementNS("http://www.w3.org/2000/svg", "g"); 
			leg1.style.display = "none"; 
			 
			circ = document.createElementNS("http://www.w3.org/2000/svg", "circle");   
			circ.setAttributeNS(null, "fill", branco );  
			circ.setAttributeNS(null, "fill-opacity", ".1");  
			circ.setAttributeNS(null, "r", 5); 
			circ.setAttributeNS(null, "cx", -10);
			circ.setAttributeNS(null, "cy", 0);
			
			leg1.appendChild(circ);
			   
			circ = document.createElementNS("http://www.w3.org/2000/svg", "circle");   
			circ.setAttributeNS(null, "fill", branco );  
			circ.setAttributeNS(null, "fill-opacity", ".3");  
			circ.setAttributeNS(null, "r", 5); 
			circ.setAttributeNS(null, "cx", 10);
			circ.setAttributeNS(null, "cy", 0); 
			 
			leg1.appendChild(circ); 
			
			leg_lb = document.createElementNS("http://www.w3.org/2000/svg", "text"); 
			leg_lb.setAttributeNS(null, "fill", branco );
			leg_lb.setAttributeNS(null, "x", -25 );
			leg_lb.setAttributeNS(null, "y", 4 );
			leg_lb.setAttributeNS(null, "font-size", 10 );
			leg_lb.setAttributeNS(null, "text-anchor", "end");
			leg_lb.textContent = "PROJETOS";
			
			leg1.appendChild(leg_lb);
			
			leg_lb = document.createElementNS("http://www.w3.org/2000/svg", "text"); 
			leg_lb.setAttributeNS(null, "fill", branco );
			leg_lb.setAttributeNS(null, "x", 25 );
			leg_lb.setAttributeNS(null, "y", 4 );
			leg_lb.setAttributeNS(null, "font-size", 10 );
			leg_lb.setAttributeNS(null, "style", "font-family: Arial, georgia, times, serif; color:#fff; backgrond-color:#000; width:200px; height:100px; z-index:100" );
			leg_lb.setAttributeNS(null, "text-anchor", "start");
			leg_lb.textContent = "DESTAQUES";
			
			leg1.appendChild(leg_lb);  
			logo_legenda.appendChild(leg1);
			 
			//LEG2
			 
			leg2 = document.createElementNS("http://www.w3.org/2000/svg", "g");  
			leg2.style.display = "none";
			 
			circ = document.createElementNS("http://www.w3.org/2000/svg", "circle");   
			circ.setAttributeNS(null, "fill", "none" );  
			circ.setAttributeNS(null, "stroke", branco); 
			circ.setAttributeNS(null, "stroke-width", 1); 
			circ.setAttributeNS(null, "stroke-opacity", .25); 
			circ.setAttributeNS(null, "r", 3); 
			circ.setAttributeNS(null, "cx", -34);
			circ.setAttributeNS(null, "cy", 0);
			
			leg2.appendChild(circ);
			   
			circ = document.createElementNS("http://www.w3.org/2000/svg", "circle");   
			circ.setAttributeNS(null, "fill", "none" );  
			circ.setAttributeNS(null, "stroke", branco); 
			circ.setAttributeNS(null, "stroke-width", 1); 
			circ.setAttributeNS(null, "stroke-opacity", .25); 
			circ.setAttributeNS(null, "r", 25); 
			circ.setAttributeNS(null, "cx", 7);
			circ.setAttributeNS(null, "cy", 0); 
			 
			leg2.appendChild(circ);
			
			leg_lb = document.createElementNS("http://www.w3.org/2000/svg", "text"); 
			leg_lb.setAttributeNS(null, "fill", branco );
			leg_lb.setAttributeNS(null, "x", -45 );
			leg_lb.setAttributeNS(null, "y", 4 );
			leg_lb.setAttributeNS(null, "font-size", 10 );
			leg_lb.setAttributeNS(null, "text-anchor", "end");
			leg_lb.textContent = "2004";
			
			leg2.appendChild(leg_lb);
			
			leg_lb = document.createElementNS("http://www.w3.org/2000/svg", "text"); 
			leg_lb.setAttributeNS(null, "fill", branco );
			leg_lb.setAttributeNS(null, "x", 45 );
			leg_lb.setAttributeNS(null, "y", 4 );
			leg_lb.setAttributeNS(null, "font-size", 10 );
			leg_lb.setAttributeNS(null, "text-anchor", "start");
			leg_lb.textContent = new Date().getFullYear(); 
			
			leg2.appendChild(leg_lb); 
			
			logo_legenda.appendChild(leg2); 
			 
			//lista clientes/parceiros 
			
			ordenar(clientes_arr,"n_projetos");
			clientes_arr.reverse(); 
			
			var cliente_logo; 
			var cliente_cel; 
			var clientes_lista = [];
			var parceiros_lista = [];
			var a;
			var cliente_at = null;
			var parceiro_at = null;
			
			for(i=0; i<clientes_arr.length; i++){  
				
				if( clientes_arr[i]["projetos_cliente"] ){
					
					cliente_cel = document.createElement("div");
					cliente_cel.ID = clientes_arr[i]["id"];
					cliente_cel.id = "cliente" + clientes_arr[i]["id"];
					cliente_cel.className = "cliente_cel";
					
					cliente_logo = new Image();
					cliente_logo.src = "clientes/cliente" + clientes_arr[i]["id"] + ".png";
					cliente_cel.appendChild(cliente_logo);
					cliente_logo.style.opacity = .8;
					cliente_cel.img = cliente_logo;
					
					clientes.appendChild(cliente_cel);
					clientes_lista.push(cliente_cel);
					
					//projetos_cliente 
					for(a=0; a<clientes_arr[i]["projetos_cliente"].length; a++){ 
						proj_cel( "projeto" + clientes_arr[i]["projetos_cliente"][a], clientes, "cliente_cel" ); 
					}
					
					cliente_cel.onclick = function(){
						
						if(cliente_at != this){
							cliente_at = this;
						}else{
							cliente_at = null
						}
						
						for(i=0; i<clientes_lista.length; i++){  
							itm = clientes_lista[i];
							
							if(cliente_at){
								
								if(itm != cliente_at){
									itm.img.style.opacity=.1;
									itm.style.backgroundColor="";
								}else{
									itm.img.style.opacity=.8;
									itm.style.backgroundColor=branco;
								} 
								
							}else{ 
								itm.style.backgroundColor="";	
								itm.img.style.opacity=.8;
							}
							
							
						} 
						
						
						for(i=0; i<clientes.projetos.length; i++){  
							itm = clientes.projetos[i];
							
							if( cliente_at && itm.cliente == cliente_at.ID ){
								$(itm).fadeIn(dur);	
							}else{
								$(itm).hide();
							}
						}
						
						rolar_tela( $(this).offset().top - 50, dur );
						
					}
				}
				
				if( clientes_arr[i]["projetos_parceiro"] ){ 
					
					cliente_cel = document.createElement("div");
					cliente_cel.ID = clientes_arr[i]["id"];
					cliente_cel.id = "cliente" + clientes_arr[i]["id"];
					cliente_cel.className = "cliente_cel";
					
					cliente_logo = new Image();
					cliente_logo.src = "clientes/cliente" + clientes_arr[i]["id"] + ".png";
					cliente_cel.appendChild(cliente_logo);
					cliente_logo.style.opacity = .8;
					cliente_cel.img = cliente_logo;
					
					parceiros.appendChild(cliente_cel); 
					parceiros_lista.push(cliente_cel);
					
					//projetos_parceiro
					for(a=0; a<clientes_arr[i]["projetos_parceiro"].length; a++){ 
						proj_cel( "projeto" + clientes_arr[i]["projetos_parceiro"][a], parceiros, "cliente_cel" ); 
					}
					
					cliente_cel.onclick = function(){
						
						if(parceiro_at != this){
							parceiro_at = this;
						}else{
							parceiro_at = null
						}  
						
						for(i=0; i<parceiros_lista.length; i++){  
							itm = parceiros_lista[i];
							
							if(parceiro_at){
								
								if(itm != parceiro_at){
									itm.img.style.opacity=.1;
									itm.style.backgroundColor="";
								}else{
									itm.img.style.opacity=.8;
									itm.style.backgroundColor=branco;
								} 
								
							}else{ 
								itm.style.backgroundColor="";	
								itm.img.style.opacity=.8;
							} 
							
						}  
						 
						
						for(i=0; i<parceiros.projetos.length; i++){  
							itm = parceiros.projetos[i];
							
							if(parceiro_at && itm.parceiro == parceiro_at.ID){
								$(itm).fadeIn(dur);	
							}else{
								$(itm).hide();
							}
						}
						
						rolar_tela( $(this).offset().top - 50 ,dur);
						
					} 
				} 
			}  
			
			// layout inicial  
			
			 document.getElementById("bt1_lb").innerHTML = "PROJETOS : DESTAQUES"; // LG!
			
			mudar_idioma(0); 
			resize(); 
			verifica_scroll();
			gerar_logo();
			timeline.scrollLeft = timeline.scrollWidth;  
			verifica_proj();  
			fechar_menu();
		}
	}    
	
	// cont fucntions 
	
	function ordenar(alvo,criterio){    
		alvo.sort(function (a, b) {
			if (a[criterio] > b[criterio])
			  return 1;
			if (a[criterio] < b[criterio])
			  return -1;
			if(a[criterio] == b[criterio]){  
				return 0;
			} 
		}); 
	} 
	
	
	 
	function port_cel(i){ 
	
		var id_bd;
		var suporte;
		var cliente_id;
		var data;
		var nome_lb;
		var banners = [];
		var banner;
		var display_cel1;
		
		id_bd = projetos_arr[i]["id"];
		suporte = projetos_arr[i]["id_suporte"];
		cliente_id = projetos_arr[i]["id_cliente"];
		parceiro_id = projetos_arr[i]["id_parceiro"];
		data = faz_data( projetos_arr[i]["data"] );
		nome_lb = projetos_arr[i]["projeto"+lg].toUpperCase(); 
		banners = projetos_arr[i]["display"].split(","); 
		
		var modulo;
		var clear;
		var pos;   
		
		var port_cel  = document.createElement("div");
		port_cel.className = "port_cel";
		port_cel.ID = id_bd;
		port_cel.suporte = suporte;  
		port_cel.banners = []; 
		
		port_cel.ban_at = 0; // banner atual 
		
		var seta_dir = document.createElement("div");
		seta_dir.className = "seta_banner";
		seta_dir.style.right = "0";
		seta_dir.cel = port_cel;
		seta_dir.innerHTML = "<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" enable-background=\"new 0 0 50 50\" xml:space=\"preserve\"><g transform=\"rotate( -90, 25, 25 )\" stroke=\"#fff\"><polyline fill=\"none\" stroke-width=\"2.4\" stroke-linecap=\"square\" stroke-linejoin=\"square\" stroke-miterlimit=\"10\" points=\"15,23 25,30 35,23\"/></g></svg>";
		
		var seta_dir_bg = document.createElement("div"); 
		seta_dir.appendChild(seta_dir_bg);
		port_cel.appendChild(seta_dir);
		
		// && 
		seta_dir.onclick = function(){
			if( this.cel.ban_at + 1 < this.cel.banners.length ){
				this.cel.ban_at += 1;
				$(this.cel.banners[this.cel.ban_at]).animate( {left:"0%"}, dur, "easeOutQuart"); 
				this.oposta.style.opacity = 1;
			
				if( this.cel.ban_at == this.cel.banners.length - 1 ){
					this.style.opacity = .3;
				} 
			} 
		}
		
		var seta_esq = document.createElement("div");
		seta_esq.className = "seta_banner";
		seta_esq.style.left = "0";
		seta_esq.cel = port_cel;
		seta_esq.innerHTML = "<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" enable-background=\"new 0 0 50 50\" xml:space=\"preserve\"><g transform=\"rotate( 90, 25, 25 )\" stroke=\"#fff\"><polyline fill=\"none\" stroke-width=\"2.4\" stroke-linecap=\"square\" stroke-linejoin=\"square\" stroke-miterlimit=\"10\" points=\"15,23 25,30 35,23\"/></g></svg>";
		seta_esq.style.opacity = .3;
		
		var seta_esq_bg = document.createElement("div");
		seta_esq.appendChild(seta_esq_bg);
		port_cel.appendChild(seta_esq); 
		
		seta_esq.onclick = function(){
			if( this.cel.ban_at - 1 >= 0 ){
				this.cel.ban_at -= 1;
				$(this.cel.banners[this.cel.ban_at + 1]).animate( {left:"100%"}, dur, "easeInQuart");
				this.oposta.style.opacity = 1;
				
				if( this.cel.ban_at == 0 ){
					this.style.opacity = .3;
				} 
			}
		}
		
		seta_dir.oposta = seta_esq;
		seta_esq.oposta = seta_dir;
		
		for(i=0; i<banners.length; i++){  
			banner = new Image();
			banner.src = "projetos/projeto" + id_bd + "/" + banners[i] + ".jpg"; 
			banner.ID = id_bd;
			port_cel.banners.push(banner);
			port_cel.appendChild(banner);
			
			banner.onclick = function(){ 
				chamar_projeto(this.ID);
			}
			
			if(i==0){
				banner.style.left = "0%";
			}else{				
				banner.style.left = "100%";
			}
		} 
		
		var port_cel_titulo = document.createElement("div");
		port_cel_titulo.className = "titulo";
		port_cel_titulo.style.backgroundColor = cores[suporte];
		port_cel_titulo.innerHTML = nome_lb;
		
		if(cliente_id  > 0 ){
			port_cel_titulo.innerHTML += " _ ";
			port_cel_titulo.innerHTML += clientes_arr["cliente" + cliente_id]["cliente_pt"].toUpperCase();
		}
		
		if(parceiro_id  > 0 ){
			if(cliente_id  > 0 ) port_cel_titulo.innerHTML += " / ";
			else port_cel_titulo.innerHTML += " _ ";
			port_cel_titulo.innerHTML += clientes_arr["cliente" + parceiro_id]["cliente_pt"].toUpperCase();
		} 
		
		port_cel_titulo.innerHTML += " _ ";
		port_cel_titulo.innerHTML += data.substring(4,8);
		port_cel_titulo.ID = id_bd;   
		
		port_cel_titulo.onclick = function(){
			chamar_projeto(this.ID) 
		}
		 
		port_cel.titulo = port_cel_titulo;  
		
		portfolio.projetos.push(port_cel);
		portfolio.appendChild(port_cel); 
		portfolio.appendChild(port_cel_titulo);
		  
	} 
	
	function proj_cel(i,destino,cls){
		
		var id_bd = projetos_arr[i]["id"];
		var suporte = projetos_arr[i]["id_suporte"];
		var cliente = projetos_arr[i]["id_cliente"];
		var parceiro = projetos_arr[i]["id_parceiro"];
		
		var projeto = document.createElement("div");
		projeto.id_bd = id_bd;
		projeto.ID = id_bd;
		projeto.id = "proj" + id_bd;
		projeto.suporte = suporte;
		projeto.cliente = cliente;
		projeto.parceiro = parceiro;
		projeto.style.backgroundColor = claro;
		projeto.className = cls;
		
		var projeto_img1 = new Image();
		projeto_img1.src = "projetos/projeto" + id_bd + "/tb_cor.jpg";
		projeto.appendChild(projeto_img1);
		projeto.img = projeto_img1; 
		
		destino.appendChild(projeto);
		destino.projetos.push(projeto);
		
		if(destino == clientes || destino == parceiros){
			$(projeto).hide();	
		} 
		
		projeto.onclick = function (){
			chamar_projeto(this.id_bd);
		} 
		
	}  
	
	/* PROJETO */
	 
	var fora = 0;
	var page_y_bk = 0;
	var h_dados = 0;
	
	var display;
	var itm_lb;
	var itm_id;
	var proj_id;
	
	//carrega xml projeto
	
	xml_proj_request.onreadystatechange = function(){   
		
		if(this.readyState === 4){ // ponteiro_dados(xml_proj,"tx_sobre" + lg );  
			
			proj_dados.aberto = false;
			proj_mais_path.setAttribute("transform", 'rotate( 0, 25, 25 )');
			
			//dados
			
			xml_proj = this.responseXML;
			
			proj_id = ponteiro_dados(xml_proj,"id");
			proj_cliente = ponteiro_dados(xml_proj,"id_cliente");
			proj_parceiro = ponteiro_dados(xml_proj,"id_parceiro");
			proj_suporte = ponteiro_dados(xml_proj,"id_suporte");
			proj_dados_pt = ponteiro_dados( xml_proj, "tx_info_pt" );
			proj_data = ponteiro_dados(xml_proj,"data");
			proj_url = ponteiro_dados(xml_proj,"url");
			proj_nome = ponteiro_dados(xml_proj,"projeto" + lg); 
			proj_sb = ponteiro_dados(xml_proj,"sb_layout").split(",");  
			
			stroke(bt_voltar2_path,cores[proj_suporte]);
			$(bt_voltar2).hide();
			
			if(proj_url != ""){ 
				bt_url.url = proj_url; 
				bt_url.style.cursor = ""; 
				bt_url.onclick = function (){
					get_url(this,0);		
				};
				bt_url.style.opacity = 1;
			}else{
				bt_url.style.cursor = "default"; 
				bt_url.onclick = null;
				bt_url.style.opacity = .3;
			}
			
			proj_titulo.innerHTML = proj_nome; 
			proj_dados_titulo.innerHTML = proj_nome; 
			proj_subtitulo.innerHTML = ""; 
			proj_dados_subtitulo.innerHTML = ""; 
			
			if(proj_cliente > 0){
				proj_subtitulo.innerHTML += clientes_arr["cliente" + proj_cliente]["cliente" + lg].toUpperCase();
				proj_dados_subtitulo.innerHTML += clientes_arr["cliente" + proj_cliente]["cliente" + lg].toUpperCase();
			}
			
			if(proj_parceiro > 0){ 
				if(proj_cliente  > 0 ){
					 proj_subtitulo.innerHTML += " / "; 
					 proj_dados_subtitulo.innerHTML += " / "; 
				}
				proj_subtitulo.innerHTML += clientes_arr["cliente" + proj_parceiro]["cliente" + lg].toUpperCase();	
				proj_dados_subtitulo.innerHTML += clientes_arr["cliente" + proj_parceiro]["cliente" + lg].toUpperCase();	
			} 
			
			
			proj_subtitulo.innerHTML += " _ " + faz_data( proj_data ).toUpperCase();	
			proj_dados_subtitulo.innerHTML += " _ " + faz_data( proj_data ).toUpperCase();	
			
			proj_dados1.innerHTML = ponteiro_dados( xml_proj, "tx_info" + lg );  
			proj_dados2.innerHTML = ponteiro_dados( xml_proj, "tx_cred" + lg ); 
			
			proj_conteudo.innerHTML = ""; 
			bt_voltar.style.background = cores[ proj_suporte ];
			painel_projeto.style.background = cores[ proj_suporte ];
			
			stroke(proj_mais_path, cores[ proj_suporte ]);
			
			for(i=1; i<=3; i++){ 
				if(i != proj_suporte){
					$("#suporte"+i).hide();	
				}else{
					$("#suporte"+i).show();
				}
			}
			
			//movimento 
			$(painel_projeto).animate({top:0}, dur*1.2, "easeOutQuart", function (){  
				
				projeto_aberto = true;
				$(bt_voltar2).show();
				
				//ARQUIVOS
				//story board
				if( proj_sb.length > 1 ){ 
					for(i=0; i<proj_sb.length; i++){
						
						itm3 = new Image();
						itm3.src = "projetos/projeto" + proj_id + "/" + proj_sb[i] + ".jpg";
						itm3.className = "sb"; 
						proj_conteudo.appendChild(itm3); 
						
						if(proj_sb.length == 3 || proj_sb.length == 6 ) itm3.style.width = "33.3%";
						if(proj_sb.length == 5) itm3.style.width = "20%"; 
						
					} 
				}
				
				
				// layout (carregado ao final da animação);
				
				var layout = ponteiro_dados( xml_proj,"layout" ).split(",");  
				
				for(i=0; i<layout.length; i++){
					
					var itm_arr = layout[i].split("/");
					
					itm_lb = itm_arr[0].substring( 0,3 ); 
					itm_id = itm_arr[0].substring( 3, layout[i].length );
					itm_cls = itm_arr[1];
					
					switch( itm_lb ){
					
						case "ban": 
							itm2 = document.createElement("div");
							itm2.className = "arquivo " + itm_cls;
							
							itm = new Image();
							itm.src = "projetos/projeto" + proj_id + "/ban" + itm_id + ".jpg";
							itm2.appendChild(itm);
							
							proj_conteudo.appendChild(itm2); 
							 
						break;  
					
						case "img": 
							itm2 = document.createElement("div");
							itm2.className = "arquivo " + itm_cls;
							
							itm = new Image();
							itm.src = "projetos/projeto" + proj_id + "/img" + itm_id + "g.jpg";
							itm2.appendChild(itm);
							
							proj_conteudo.appendChild(itm2); 
							 
						break;  
						
						case "emb":
							itm = document.createElement("div");
							itm.className = "arquivo " + itm_cls;
							itm.innerHTML = ponteiro_dados_lista(xml_proj,"arquivo",itm_id,"tx_embed");
							proj_conteudo.appendChild(itm); 
						break;	
						 
					}     
				}    
				
				$(proj_conteudo).hide();
				$(proj_conteudo).fadeIn(dur);
				 
			}); 
			
			fora = page_y + win_h/2 + "px";
			page_y_bk = page_y - win_h/2;
			
			projeto.style.top = fora;
			
			$(projeto).show();
			$(painel_projeto).show();
			$(projeto).animate({top:page_y_bk}, dur*1.2,"easeOutQuart", function(){  
				$(telas).hide();
				$(header).hide();
				$(rodape).hide();
				projeto.style.position = "relative";
				projeto.style.top = 0;
				projeto_aberto = true;
				rolar_tela(0,0);
			}); 
		}
	}
	 
	function legenda(alvo,tx){
		itm2 = document.createElement("div");
		itm2.className = "legenda";
		itm2.innerHTML = tx;
		alvo.appendChild(itm2);	
	}
	 
	function chamar_projeto(ID){ 
		location.hash = "/projeto" + ID;	// projeto
	}  
	
	function fechar_projeto(){  
		location.hash = "";	 
	}				 	 
	
	function fechar_proj_dados(){ 
		
		$(proj_titulo).animate( {opacity:1}, dur);
		$(proj_subtitulo).animate( {opacity:1}, dur);
		
		$(proj_mais_path).animate({svgTransform: 'rotate( 0, 25, 25 )'},dur,"easeInOutQuart");
		
		proj_dados.aberto = false;  
		  
		$(proj_dados).animate({height:0 },dur,"easeInOutQuart");
		
	}
	
	function abrir_proj_dados(){  
		
		$(proj_titulo).animate( {opacity:0}, dur);
		$(proj_subtitulo).animate( {opacity:0}, dur);
		
		var h_dados = $(proj_dados1).outerHeight() + $(proj_dados2).outerHeight() + 120;	
		
		rolar_tela(0, 500);
		
		$(proj_mais_path).animate({svgTransform: 'rotate( 180, 25, 25 )'},dur,"easeInOutQuart");
		
		proj_dados.aberto = true; 
	 		
		$(proj_dados).animate({height:h_dados},dur,"easeInOutQuart");  
		
	}   
	
	bt_voltar.onclick = fechar_projeto; 
	bt_voltar2.onclick = fechar_projeto; 
	
	suportes.onclick = function(){ 
		if(proj_dados.aberto){
			fechar_proj_dados(0);
		}else{
			abrir_proj_dados();	
		} 
	}
	
	proj_topo.onclick = function(){ 
		if(!painel_projeto.escondido){
		
			if(proj_dados.aberto){
				fechar_proj_dados(0);
			}else{
				abrir_proj_dados();	
			}
		}
	} 
	
	painel_projeto.onclick = function(){ 
		if(this.escondido){
			mostrar_painel_projeto();
		} 
	}
	
	
	/* INICIAR XML */
	
	// xml 1/4 : TRCOM	
	xml_TRCOM_request.open("GET", "xml/TRCOM.xml?rand="+rand, true);
	xml_TRCOM_request.send(null);  
	
	
}
	
