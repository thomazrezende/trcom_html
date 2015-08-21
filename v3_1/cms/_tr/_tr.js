 
var navega = document.getElementById('navega');
var bt_topo = document.getElementById('bt_topo');
var conteudo = document.getElementById('conteudo');
var gravar = document.getElementById('gravar');  
var bt_voltar;

var mobile;
navega.lock = false;
var navega_h = $(navega).height();
var page_y;  

$(bt_topo).on('click', function(){
	$(window).scrollTo( 0, {duration:250, axis:'y'});
	$(bt_topo).animate({bottom:-51}, 200);
});

// barras
$('.barra').each( function(){    
	if($(this).find('#bt_voltar').length > 0){
		$(this).find('.barra_tb').css({ left: 113 });
	}
});

function resize(){   
	
	win_w = $( window ).width();
	win_h = $( window ).height();
	
	$('#navega_fake').css({height: navega_h });
	
	$('.list').each( function(i){   
		if( $(this).height() > 60 ){ 
			$(this).find('select').show();  
		}else{
			$(this).find('select').hide(); 
		} 
	});  
	
	if( win_w < 600){
		$('body').addClass('mobile');
		mobile = true;
		if(gravar) {
			$(bt_topo).css({marginBottom: 50});
			$(conteudo).css({paddingBottom: 150});
		}else{
			$(conteudo).css({paddingBottom: 100}); 
		}
	}else{
		$('body').removeClass('mobile');
		mobile = false;
		if(gravar){
			$(bt_topo).css({marginBottom: 100});
			$(conteudo).css({paddingBottom: 200});
		}else{
			$(conteudo).css({paddingBottom: 100}); 
		}
	}  
	
}

window.onresize = resize;   
resize(); 

function verifica_scroll(){ 
		
	page_y = $(window).scrollTop();  

	if( page_y > navega_h-50 && !navega.lock){ 
		navega.lock = true;
		$(navega).css({position:'fixed', top: -navega_h + 100});
		$(bt_topo).animate({bottom:0}, 200);
	} 

	if( page_y <= navega_h-50 && navega.lock){
		navega.lock = false;
		$(navega).css({position:'absolute', top:50});
		$(bt_topo).animate({bottom:-51}, 200);
	}    

} 

window.onscroll = verifica_scroll;	

// FORM //
 
function excluir(ref,destino){ // cria o alert com o texto e redireciona para o php que fara a exclusao.
	var confirma = confirm("Confirma a exclusão de "+ ref +" ?");
	if (confirma){
		window.location = destino;
	}  
}
	
function criar(ref,destino){ // cria o alert com o texto e redireciona para o php que fara a exclusao.
	var nome = prompt("CRIAR "+ref);
	if (nome!=null && nome!=""){
		window.location = destino+"?criar="+nome;
	}
}

function troca_senha(destino){
	var confirma = confirm("Confirma renovação automática de senha?");
		if (confirma){
			window.location = destino;
		}
	}
	
function hDiv(h){
	document.getElementById('lista').style.height=h+'px';
	}
	
function recarrega(){
	document.location.reload(true);	
	} 	

// iniciar

$(document).ready(function(){
	$(conteudo).fadeIn(200);
})

