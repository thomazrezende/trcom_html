window.onload = function (){  
	
	var projeto_id = document.getElementById('projeto_id').value;
	var projeto_path = "projetos/projeto" + projeto_id + "/"; 
	
	console.log(projeto_id);
	
	// VARS //
	
	var i,
		a, 
		tema,
		session,
		lg,
		cookie;
	
	var page_y, 
		win_w,
		win_h,
		wn,
		mobile;
	
	var dur = 250, // default duration for animations
		in_out = "easeInOutQuart",
		_out = "easeOutQuart",
		in_ = "easeInQuart"; 
	
	var cinza = "#f0f0f0";
	var branco = '#fff';
	var preto = '#222';
	
	var w_imgs = ["_p", "_m", "_g"];  
	
	var root = location.origin;
	var path = location.pathname.split('/');
	
	for(i=0; i<path.length-1; i++){
		root += path[i] + '/';
	} 
	
	html_at = path[path.length-1]; // html atual
	
	console.log( "ROOT: " + root ); 
	
	// OBJETOS //
	
	var dbody = document.body;
	var header = document.getElementById('header'); 
	var footer = document.getElementById('footer');  
	
	var container = document.getElementById('container');
	var imagens = document.getElementById('imagens');
	var dados = document.getElementById('dados'); 
	dados.aberto = false;
	
	var logo_svg = document.getElementById('logo_svg');  
	var voltar_bt = document.getElementById('voltar_bt');
	var voltar_svg = document.getElementById('voltar_svg');  
	
	var projeto_nome_lb = document.getElementById('projeto_nome_lb');  
	var projeto_sub = document.getElementById('projeto_sub');
	var dados_tx = document.getElementById('dados_tx');
	var info_bt = document.getElementById('info_bt');
	var info_bt_mais = document.getElementById('info_bt_mais');
	var info_bt_v = document.getElementById('info_bt_v');
	
	var descricao = document.getElementById('descricao');
	var creditos = document.getElementById('creditos');
	
	var cortina_fade = document.getElementById('cortina_fade');
	
	var arquivos = document.getElementById('arquivos');
	var mapa_titulo = document.getElementById('mapa_titulo');
	var mapa = document.getElementById('mapa');
	var relacionados_titulo = document.getElementById('relacionados_titulo');
	var relacionados = document.getElementById('relacionados');
	 
	var seta_topo = document.getElementById('seta_topo');
	var seta_topo_path = document.getElementById('seta_topo_path');
	
	var img,
		pre_img, 
		preload_list = [],
		perload_at,
		preload_at = 0; 
	
	lg = "_pt"; 
	sessionStorage.setItem("lg", "_pt");   
	
	var titulos = [
		{ _pt:"LOCALIZA&Ccedil;&Atilde;O", _en:"LOCATION" },
		{ _pt:"PROJETOS RELACIONADOS", _en:"RELATED PROJECTS" }
	];
	
	// SESSION //
	
	session = sessionStorage.getItem("session");
			
	if(  session == "" || !session  ){
		session = Math.random() * 1000;  
		sessionStorage.setItem("session", session); 
	} 
	
	console.log('SESSION: ' + session);
	
	// window size // 
	
	function resize(){ 		
		win_w = $( window ).width();
		win_h = $( window ).height(); 
		
		if(win_w <= 700){
			wn = 1;
			if(win_w < win_h) dbody.className = "w1v";
			else dbody.className = "w1h";		
		}else{
			wn = 2;
			if(win_w < win_h) dbody.className = "w2v";
			else dbody.className = "w2h";	
		}  	
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
	}else{ 
	    mobile = false; 
	}
	
	console.log( "MOBILE: " + mobile ); 
	
	var bt_event;
	if(mobile) bt_event = 'touchstart';
	else bt_event = 'click'
	
	var container_effect = $(container).Vague({
		intensity: 12, // Blur Intensity
		forceSVGUrl: false, // Force absolute path to the SVG filter, 
	});  
	    
	
	// XML //
	
	var myRequest1;
	var myRequest2;
	var projeto;
	var bd;

	if(window.XMLHttpRequest){ 
		myRequest1 = new XMLHttpRequest();
		myRequest2 = new XMLHttpRequest();
	}else if(window.ActiveXObject){ 
		myRequest1 = new ActiveXObject("Microsoft.XMLHTTP");
		myRequest2 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	myRequest1.onreadystatechange = function(){
		if(this.readyState === 4){ 
			bd = xml2arr(
				this.responseXML, 'bd',[
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
			
			// TEMA //

			tema = sessionStorage.getItem("tema");  

			if( tema == "" || !tema ){

				tema_id = Math.floor( Math.random() * bd.temas.length );
				d = bd.temas[tema_id];
				tema = d.id;

				sessionStorage.setItem("tema", tema); 

			}  
			
			console.log('TEMA: ' + tema); 
			
			// chama projeto
			
			myRequest2.open("GET", projeto_path + "dados.xml?session="+session, true);
			myRequest2.send(null); 
			
		}  
	} 
	
	var cortina,categoria,cidade,cliente,br;
	
	myRequest2.onreadystatechange = function(){
		if(this.readyState === 4){ 
			projeto = xml2arr(
				this.responseXML, 'projeto',[
					['dados',false,['id','codigo','sublogo','nome_pt','nome_en','texto_pt','texto_en','creditos_pt','creditos_en','subtitulo_pt','subtitulo_en','cidade','data','categoria','marcadores','cliente','hex_topo','hex_logo','relacionados','lb_arquivos','layout_itens','layout_larguras']],
					['relacionados','projeto', ['id','sublogo','nome_pt','nome_en','categoria']],
					['clientes','cliente', ['id','nome','site']],
					['categorias','categoria', ['id','nome_pt','nome_en','hex']],
					['marcadores','marcador', ['id','nome_pt','nome_en']],
					['cidades','cidade', ['id','nome_pt','nome_en','lat','lng']],
					['arquivos','arquivo', ['id','tipo','embed','legenda_pt','legenda_en','link']]
				]);
			
			console.log('///////////// PROJETO /////////////');
			console.log(projeto);   
			
			imagens = document.getElementById('imagens');
			
			// DADOS //
			
			header.style.backgroundImage = "url(" + projeto_path + "capa" + w_imgs[wn] + ".jpg)";
			console.log( projeto_path + "capa" + w_imgs[wn] + ".jpg" );
			
			categoria = bd.categorias[ "categoria" + projeto.dados.categoria ];
			cidade = bd.cidades[ "cidade" + projeto.dados.cidade ];
			cliente = bd.clientes[ "cliente" + projeto.dados.cliente ]; 
			
			console.log(logo_svg);
			console.log(projeto.dados.hex_logo);
			$(logo_svg).css({fill:projeto.dados.hex_logo});
			
			projeto_nome_lb.innerHTML =  projeto.dados['nome' + lg];
			projeto_sub.innerHTML =  "<span class='versalete'>" + categoria[ 'nome' + lg ] + ' / ' + projeto.dados.data.split('-')[0] + "</span>";
			projeto_sub.innerHTML += "&nbsp;&nbsp;" + projeto.dados['subtitulo' + lg] ;
			
		
			$(info_bt).on( bt_event, function(){
				if( dados.aberto ){
					fechar_dados();
				}else{
					abrir_dados();
				}  
			});
			
			descricao.innerHTML = projeto.dados['texto'+lg];
			creditos.innerHTML = projeto.dados['creditos'+lg]; 			
			
			info_bt_mais.setAttribute( 'fill', categoria.hex );
			//voltar_svg.setAttribute( 'fill', categoria.hex );
			//seta_topo_path.setAttribute( 'fill', categoria.hex );
			$('a').css({ color:categoria.hex });
			$(projeto_sub).css({ background:categoria.hex }); 
			
			$(seta_topo).on(bt_event,function(){
				$(dbody).stop(true).scrollTo(0, {duration:dur*2, esaing:in_out, axis:'y'});			
			});			
			
			// IMAGENS //  
			
			if( projeto.dados.layout_itens != '' ){
				
				var layout = projeto.dados.layout_itens.split(',');
				var larguras = projeto.dados.layout_larguras.split(',');
			
				var item;
				var item_id;
				var arquivo;
				var imagem;
				var legenda;

				for( i=0; i<layout.length; i++ ){

					item_id = layout[i].split('tem')[1];

					for(a=0; a<projeto.arquivos.length; a++){
						arquivo = projeto.arquivos[a];
						if( item_id == arquivo.id ){ 
							break;
						}
					}

					item = document.createElement('div');
					item.ID = arquivo.id;
					item.className = 'arquivo ' + larguras[i];

					if(arquivo.tipo == 'emb'){
						item.innerHTML = arquivo.embed;
						item.className += ' emb'; 
					}else{
						if(larguras[i] == 'w100'){
							imagem = new Image(); 
							//imagem.src =  projeto_path + 'TRCOM_' + projeto.dados.lb_arquivos + '_' + arquivo.id + w_imgs[wn] + '.jpg';
							item.appendChild(imagem);
							item.imagem = imagem;
							item.source = projeto_path + 'TRCOM_' + projeto.dados.lb_arquivos + '_' + arquivo.id + w_imgs[wn] + '.jpg'; 
						}else{
							//$(item).css({backgroundImage:'url(' + projeto_path + 'TRCOM_' + projeto.dados.lb_arquivos + '_' + arquivo.id + w_imgs[wn-1] + '.jpg )'});				 
							item.source =  projeto_path + 'TRCOM_' + projeto.dados.lb_arquivos + '_' + arquivo.id + w_imgs[wn-1] + '.jpg'; 
						}
						
						$(item).css({opacity:0});
						preload_list.push(item);

						if(arquivo.link != ''){
							item.link = arquivo.link;
							item.className += ' pointer';
							item.onclick = function(){
								window.open(this.link,'_blank');
							}
						}
					}

					legenda = document.createElement('div');
					legenda.className = 'legenda';
					legenda.innerHTML = arquivo['legenda' + lg];
					item.appendChild(legenda);

					arquivos.appendChild(item);	 

				}  // imagens
				
				
				//preload 
				 
				preload_at = 0;
				preload_imgs(); 
				
			}
			
			
			// TITULOS //
			
			mapa_titulo.innerHTML = titulos[0][lg];
			

			// RELACIONADOS //
			if( projeto.dados.relacionados != '' ){
				
				relacionados_titulo.innerHTML = titulos[1][lg];
				var relacs = projeto.dados.relacionados.split(',');
				
				var relac_id;
				var relac;
				
				for( i=0; i<relacs.length; i++ ){
					
					relac_id = relacs[i];					
					relac = document.createElement('div');
					relac.className = 'cel_projeto';
					relac.ID = relac_id;
					
					$(relac).css({backgroundImage: 'url(projetos/projeto' + relac_id + '/tb.jpg)'});
					
					$(relac).on('click',function(){						
						chamar_projeto(this.ID);						
					});
					
					relacionados.appendChild(relac);  
					
				}
				
				
			}else{
				
				$(relacionados_titulo).hide();
				$(relacionados).hide();
				
			}
			
			
			
			/////////////////// INICIAR /////////////////// 

			// iniciar layout
			resize();
			window.scrollTo(0,0);

			$(cortina_fade).fadeOut(dur, function(){
				load_map();  
			});  
			
		} 
	}


 	/////////////////// FUNCS ///////////////////
	 
	
	function preload_imgs(){
		img = preload_list[ preload_at ];
		pre_img = new Image();
		pre_img.src = img.source;
		pre_img.onload = function(){ 
			if(img.imagem){ 
				img.imagem.src = img.source;
				$(img).css({opacity:0}).animate({ opacity:1 }, dur); 
			}else{ 
				$(img).css({backgroundImage:'url(' + img.source + ')', opacity:0}).animate({ opacity:1 }, dur); 
			}  
			preload_at ++;
			if(preload_at < preload_list.length ){
				preload_imgs();
			} 
		}
	} 
	
	function chamar_projeto(ID){  
		document.location.href = 'projeto.php?id=' + ID;
	}
	
	/* GMAPS */

	var mapa = document.getElementById("mapa");

	var map;
	var city_icon; 
	var city; 

	function load_map() { 

		var mapOptions = {
			center: new google.maps.LatLng( cidade.lat, cidade.lng ), 
			zoom: 3,
			backgroundColor: cinza,
			mapTypeId: google.maps.MapTypeId.MAP,
			panControl: false,
			mapTypeControl: false,
			streetViewControl: false,
			scrollwheel: false,
			disableDoubleClickZoom: true,
			scaleControl: false, 
			overviewMapControl: false,
			rotateControl: false, 
			zoomControl: false,
			styles: map_styles,
			scaleControlOptions: {
				position: google.maps.ControlPosition.BOTTOM_LEFT
			}
		};

		map = new google.maps.Map(mapa, mapOptions);  

		// marker 

		city_icon = circulo( 30, 1, categoria.hex );
		 
		city = new MarkerWithLabel({
			position : new google.maps.LatLng ( cidade.lat, cidade.lng ),
			icon:city_icon,
			optimized: false,
			zIndex:2,
			labelContent: i,
			labelContent:  cidade['nome' + lg], 
			labelAnchor:  new google.maps.Point (-16, 6),
			labelClass: "map_labels",
			map:map 
		}); 
	}
	
	function circulo(maximo, area, cor){ 
		var raio_area = Math.sqrt(area/Math.PI);
		var raio_max = Math.sqrt(maximo/Math.PI); 
		var raio_fim = 30 * raio_area / raio_max;

		var circ = {
			path: google.maps.SymbolPath.CIRCLE,
			fillColor: cor,
			fillOpacity: 1,
			scale: raio_fim,
			strokeColor:cinza,
			strokeWeight: 1.5,
		} 
		return circ;			
	}    

	var map_styles = [
	  {
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "water",
		"elementType": "geometry",
		"stylers": [
		  { "visibility": "on" },
		  { "color": "#f0f0f0" }
		]
	  },{
		"featureType": "administrative.country",
		"elementType": "geometry.stroke",
		"stylers": [
		  { "visibility": "on" },
		  { "color": "#f0f0f0" }
		]
	  },{
		"featureType": "administrative.province",
		"elementType": "geometry.stroke",
		"stylers": [
		  { "visibility": "on" },
		  { "color": "#f0f0f0" }
		]
	  },{
		"featureType": "landscape",
		"elementType": "geometry",
		"stylers": [
		  { "visibility": "on" },
		  { "color": "#dddddd" }
		]
	  }
	]
	 

	$(voltar_bt).on(bt_event,function(){
		voltar();
	}); 
	
	function voltar(){
		
		var voltar_para = sessionStorage.getItem('voltar_para');
		
		if(voltar_para != ''){
			document.location.href = voltar_para;
		}else{
			document.location.href = 'destaques.html';
		} 
		
	}
	
	//dados
	
	function calcular_h_dados(){
		if( dbody.className == "w1v" ){ 
			dados.h_fim = $(descricao).height() + $(creditos).height() + 50;
		}else{
			if( $(descricao).height() > $(creditos).height() ){
				dados.h_fim = $(descricao).height() + 30;
			}else{
				dados.h_fim = $(creditos).height() + 30;
			} 
		} 
	}  
	
	function abrir_dados(){
		dados.aberto = true;
		calcular_h_dados();  
		
		$(dados_tx).animate({height:dados.h_fim}, dur, in_out);
		$(dbody).stop(true).scrollTo(dados, {duration:dur, esaing:in_out, axis:'y'});
		
		$(info_bt_v).hide();
	}
	
	function fechar_dados(){
		dados.aberto = false;
		
		$(dados_tx).animate({height:0}, dur, in_out);
		$(dbody).stop(true).scrollTo(dados, {duration:dur, esaing:in_out, axis:'y'});
		
		$(info_bt_v).show();
	}
	
	// WINDOW // 
	
	
	function verifica_scroll(){  
		page_y = $(window).scrollTop();		
	}  

	window.onscroll = verifica_scroll; 
	
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
	
	function xml2arr(_xml, _root, tabelas){  
		var t,root,c,a,l,tabela,listar,atts,lista,item,att,obj,xml; 
		
		clean(_xml); 
		root = _xml.getElementsByTagName(_root); 
		
		console.log(">>>> "+_root);
		console.log(root); 
		
		xml = root[0].childNodes; 
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
							
							console.log('att >>> '+atts[a]);
							
							obj[tabela].push(item);	
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
	 
	myRequest1.open("GET", "xml/bd.xml?session="+session, true);
	myRequest1.send(null);  
	
}


