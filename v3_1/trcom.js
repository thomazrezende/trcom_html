/* 
	TRCOM V3.1
	TRCOM Rezende - 2015-07-31 
*/ 

window.onload = function (){   
	
	// VARS //
	
	var i,
		a, 
		tema,
		tela,
		session,
		lg;   
	
	var page_y, 
		win_w,
		win_h,
		wn,
		timer_scroll,
		trava = false, 
		mobile, 
		bt_event,
		projeto,
		suporte,
		marcador;
	
	var dur = 250, // default duration for animations
		in_out = "easeInOutQuart",
		_out = "easeOutQuart",
		in_ = "easeInQuart";  
	
	var w_imgs = ["_p", "_m", "_g"];  
	
	var root = location.origin;
	var path = location.pathname.split('/');  
	
	for(i=0; i<path.length-1; i++){
		root += path[i] + '/';
	}  
	
	console.log( "ROOT: " + root ); 
	
	// OBJETOS //
	
	var dbody = document.body;
	var container = document.getElementById('container'); 
	
	var header = document.getElementById('header'); 
	var footer = document.getElementById('footer');   
	  
	var preload_list = [];
	   
	var tb,		
		cel_preloader,
		img;  
	
	var lgs = [
		{lg:"_pt", lb:"PORTUGU&Ecirc;S"},
		{lg:"_en", lb:"ENGLISH"}		
	];
	
	lg = "_pt";
	
	var telas = [
		{ id:1, _pt:'destaques', _en:'highlights', a:'destaques'},
		{ id:2, _pt:'projetos', _en:'projects', a:'projetos'},
		{ id:3, _pt:'clientes', _en:'clients', a:'clientes'},
		{ id:4, _pt:'sobre', _en:'about', a:'sobre'},
		{ id:5, _pt:'contato', _en:'contact', a:'contato'}		
	];  
	
	var labels = {  
		relacionados:{ _pt:"PROJETOS RELACIONADOS", _en:"RELATED PROJECTS" }, 
		contato:{ _pt:"ENTRE EM CONTATO", _en:"CONTACT US" },
		nome:{ _pt:"NOME", _en:"NAME" },
		msg:{ _pt:"MENSAGEM", _en:"MESSAGE" },
		enviar:{ _pt:"ENVIAR", _en:"SEND" },
		enviada:{ _pt:"MENSAGEM ENVIADA", _en:"MESSAGE SENT" },
		erro:{ _pt:"HOUVE UM ERRO. POR FAVOR TENTE NOVAMENTE", _en:"ERROR. PLEASE TRY AGAIN." }
	};
	
	// window size // 
	
	function resize(){
		
		win_w = $( window ).width();
		win_h = $( window ).height(); 
		
		if( win_w <= 700 ){
			wn = 1;
			if(win_w < win_h) dbody.className = "w1v";
			else dbody.className = "w1h";		
		}else{
			wn = 2;
			if(win_w < win_h) dbody.className = "w2v";
			else dbody.className = "w2h";	
		} 
				
		//trace.innerHTML = wn;		
	}  
	
	window.onresize = resize;
	resize();
	
	// mobile //
	
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

	if( isMobile.any() ){
		mobile = true;  
		bt_event = 'touchstart';
	}else{ 
	    mobile = false;  
		bt_event = 'click';
	} 
	
	console.log( "MOBILE: " + mobile );  
	
	/* MENU */     
	
	$(menu_bt).on(bt_event,function(){
		abrir_menu();
	}); 
	
	$(menu_x).on(bt_event,function(){	
		fechar_menu();
	}); 
	
	function abrir_menu(){
	
	}
	
	function fechar_menu(){
	
	}
	
	// XML //
	
	var myRequest;
	var xml;
	var bd;

	if(window.XMLHttpRequest){ 
		myRequest = new XMLHttpRequest();
	}else if(window.ActiveXObject){ 
		myRequest = new ActiveXObject("Microsoft.XMLHTTP");
	} 
	
	myRequest.onreadystatechange = function(){
		if(this.readyState === 4){
			xml = this.responseXML;
			bd = xml2arr(
				xml, 'bd',[
					['dados',false,['email','sobre_pt','sobre_en','instagram','facebook','endereco','telefone','layout_equipe']],
					['projetos','projeto', ['id','codigo','destaque','publicado_pt','publicado_en','sublogo','nome_pt','nome_en','subtitulo_pt','subtitulo_en','cidade','data','categoria','marcadores','cliente','hex_topo','hex_logo','hex_nome','hex_base']],
					['clientes','cliente', ['id','nome','site']],
					['categorias','categoria', ['id','nome_pt','nome_en','hex']],
					['marcadores','marcador', ['id','nome_pt','nome_en']],
					['cidades','cidade', ['id','nome_pt','nome_en','lat','lng']],
					['temas','tema', ['id','hex_topo','hex_logo','hex_titulo','hex_base','hex_subtitulo','hex_subtitulo_bg']]
				]); 
			
			console.log('///////////// BD /////////////');
			console.log(bd);
			
			/////////////////// CONTATO ///////////////////
			
			contato_arr = [
				{itm: 'contato_email', link:"mailto:" + bd.dados.email, target:"_self"},
				{itm: 'contato_instagram', link:bd.dados.instagram, target:"_blank"},
				{itm: 'contato_facebook', link:bd.dados.facebook, target:"_blank"}
			];
			
			var contato_itm;
			
			for(i=0; i<contato_arr.length; i++){
				contato_itm = document.getElementById(contato_arr[i].itm);
				contato_itm.link = contato_arr[i].link;
				contato_itm.target = contato_arr[i].target;
				
				$(contato_itm).on(bt_event,function(){ 
					if(this.target == "_blank") window.open(this.link, this.target);
					else document.location.href = this.link;
				}); 
			}
			
			/////////////////// HOME ///////////////////
			
			 
				// preload    
				
				cel_preloader = document.createElement('div');
				cel_preloader.className = 'cel_preloader ring1';  
				
				destaques = document.getElementById('destaques');  
				 
				/* DESTAQUES */
				 
				
				var destaque,
					destaques,
					destaque_bg,	
					destaque_nome,
					destaque_dados, 
					destaque_subtitulo,
					destaque_des,
					cortina,
					cliente,
					br;
				   
				for(i=0; i<bd.projetos.length; i++){
					
					projeto = bd.projetos[i];
					categoria = bd.categorias["categoria" + projeto.categoria]; 
					cliente = bd.clientes["cliente" + projeto.cliente];
					
					if( projeto["publicado" + lg] == 1 && projeto.destaque == 1 ){  
						
						destaque = document.createElement('div');
						destaque.className = 'cel_destaque h100';
						destaque.ID = projeto.id;    
						  
						
						cel_preloader = document.createElement('div');
						cel_preloader.className = 'cel_preloader ring1';
						destaque.preloader = cel_preloader;						
						destaque.appendChild ( cel_preloader );  
						
						cortina = document.createElement('div');
						cortina.className = 'cortina';
						destaque.appendChild(cortina);
						
						$(destaque).on('click',function(){
							chamar_projeto(this.ID);
						}); 
						
						destaque_dados = document.createElement('div');
						destaque_dados.className = 'dados';
						
						destaque_nome = document.createElement('span');
						destaque_nome.className = 'dados_lb'; 
						destaque_nome.innerHTML = projeto["nome"+lg];
						destaque_dados.appendChild(destaque_nome);  
							
						destaque_subtitulo = document.createElement('span');
						destaque_subtitulo.className = 'dados_sublb';
						destaque_subtitulo.innerHTML = "<span class='versalete'>" + categoria['nome'+lg] + ' / ' + projeto.data.split('-')[0] + "</span>"; 
						 
						destaque_dados.appendChild(destaque_subtitulo);  
						 
						destaque.appendChild(destaque_dados);    
						destaques.appendChild(destaque); 
						destaques_lista.push(destaque);
					}				
				} 
				
				// preload images 
				$(cortina_fade).fadeOut(dur);  
				
				preload_at = 0; 
				preload_imgs();
				
			
			/////////////////// PROJETOS ///////////////////
			
				   
				preload_list = []; 
					
				for( a=0; a<bd.projetos.length; a++ ){
					
					projeto = bd.projetos[a];
					
					if( projeto['publicado' + lg] == 1 ){   
						
						// thumb
						tb = document.createElement('div');
						tb.ID = projeto.id;
						tb.categoria = projeto.categoria; 
						tb.marcadores = projeto.marcadores.split(',');
						tb.className = 'cel_projeto'; 
						
						cel_preloader = document.createElement('div');
						cel_preloader.className = 'cel_preloader ring2';
						tb.preloader = cel_preloader;						
						tb.appendChild ( cel_preloader ); 
						
						tb.source = 'projetos/projeto' + projeto.id + '/tb.jpg';
						preload_list.push(tb);
						
						cortina = document.createElement('div');
						cortina.className = 'cel_projeto_cortina';
						$(cortina).hide();
						tb.cortina = cortina;
						tb.appendChild(cortina);
						
						tb.onclick = function(){ 
							chamar_projeto(this.ID,'projetos.html');
						}
						
						projetos.appendChild(tb);
						projetos_lista.push(tb);						
					}
				} 
				
				//preload 
				 
				preload_at = 0;
				preload_imgs();   
				
				// iniciar  
			
				
				$(cortina_fade).fadeOut(dur);  
			
			
			
			/////////////////// SOBRE ///////////////////
			
			 
				
			
			
			
			/////////////////// OBRAS ///////////////////
			
		
			
			
			
			/////////////////// INICIAR ///////////////////
			
			// iniciar layout
			resize(); 
			
			
		}
	}

 	// FUNCS // 
	
	function preload_imgs( ){
		img = preload_list[ preload_at ];
		pre_img = new Image();
		pre_img.src = img.source;
		pre_img.onload = function(){
			$(img).css({backgroundImage:'url(' + img.source + ')'});
			$(img.preloader).fadeOut(dur);
			preload_at ++;
			if(preload_at < preload_list.length ){
				preload_imgs();
			}
		}
	} 
	  

	// iniciar    
	 
	
	function chamar_projeto(ID){ 
		document.location.href = 'projeto.php?id=' + ID;
	}
	  
	
	// WINDOW // 
	
	function verifica_scroll(){ 
		
		page_y = $(window).scrollTop(); 
		
		  
		
	} 
	
	if( tela == 0 && mobile ) { 
		$(window).swipe( {
			swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
				if(direction == 'down' && destaque_atual > 0 ){
					destaque_atual --;
					centralizar_destaque(); 
				}
				if(direction == 'up' && destaque_atual < destaques_lista.length - 1 ) {
					destaque_atual ++;
					centralizar_destaque(); 
				}
			}
		});
	} 

	window.onscroll = verifica_scroll;
		
	function centralizar_destaque(){ 
		if(!trava){
			trava = true;
			rolar_tela(destaques_lista[destaque_atual]);
			clearTimeout(timer_scroll);	
			timer_scroll = setTimeout(function(){
				trava = false;
				tema_destaque();
			},dur);
		}
	} 
	
	function rolar_tela(para){
		$(dbody).stop(true).scrollTo(para, {duration:dur, esaing:in_out, axis:'y'});
	}


	// XML // 
	
	function clean(node){
	  for(var n = 0; n < node.childNodes.length; n ++){
		var child = node.childNodes[n];
		if( child.nodeType === 8 || (child.nodeType === 3 && !/\S/.test(child.nodeValue))){
		  node.removeChild(child);
		  n --;
		}else if(child.nodeType === 1){
		  clean(child);
		}
	  }
	}
	
	function xml2arr(_xml, root, tabelas){  
		var t,c,a,l,tabela,listar,atts,lista,item,att,obj,xml; 
		
		clean(_xml); 
		xml = _xml.getElementsByTagName(root)[0].childNodes;  
		obj = {}; 
		
		for(var t=0; t<tabelas.length; t++){
			tabela = tabelas[t][0];
			listar = tabelas[t][1];
			atts = tabelas[t][2];
			for(c=0; c<xml.length; c++){  
				if(xml[c].tagName == tabela ){ 
					
					if(listar){ 
						obj[tabela] = []; 
						lista = xml[c].childNodes; 
						for(l=0; l<lista.length; l++){
							item = {}; 
							for(a=0; a<atts.length; a++){ 
								att = lista[l].getElementsByTagName(atts[a])[0]; 
								item[atts[a]] = att.textContent;
							}  
							obj[tabela].push(item);
							item.id_arr = obj[tabela].indexOf(item);
							obj[tabela][listar + item.id ] = item; 
						}  
					}else{  
						obj[tabela] = {}; 
						for(a=0; a<atts.length; a++){ 
							att = xml[c].getElementsByTagName(atts[a])[0]; 
							obj[tabela][atts[a]] = att.textContent;	 
						}  
					} 
					break;
				} 
			}			
		}
		
		return obj;
		 
	}

	// att
	function ponteiro_att(xml, ID, att){  
		if( xml[ID] ){
			return xml[ID].getAttribute(att); 
		}
	}

	// nodes
	function ponteiro_lista(xml,a,lb){ //  ponteiro que retorna conteúdo da tag com index [a] e tags internas do index [a][b] 
		if(xml[a].getElementsByTagName(lb)[0].firstChild){ // se a tag estiver vazia, o firstChild = null da bug no retorno da proxima linha
			return xml[a].getElementsByTagName(lb)[0].firstChild.nodeValue;   
		}  
	}
	
	function isArray( obj ) {
		return toString.call(obj) === "[object Array]";
	}; 
	
		
	// INICIAR // 
	
	preload_ok = sessionStorage.getItem("preload_ok"); 
	session = sessionStorage.getItem("session"); 
	
	if(  session == null ||  session == '' ||  session == 'undefined'  || !session ){
		session = Math.round(Math.random() * 100000); 
		sessionStorage.setItem("session", session); 
	}
	 
	myRequest.open("GET", "xml/bd.xml?session="+session, true); 
	myRequest.send(null);  
	
}

