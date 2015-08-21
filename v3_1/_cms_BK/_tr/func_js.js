

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


var bt_voltar;
var submenu;
var submenu_list;
var submenu_select; 
var submenu_select_ico; 
var bt_gravar;
var h_container;
var t_container;
var mensagem;
var submenu_type = "list";

function resize(){  
	
	bt_voltar = document.getElementById('bt_voltar');
	submenu = document.getElementById('submenu');
	submenu_select_ico = document.getElementById('submenu_select_ico');
	bt_gravar = document.getElementById('bt_gravar'); 
	
	win_w = $( window ).width();
	win_h = $( window ).height();
	
	h_container = win_h;
	t_container = 0;
	
	if( bt_voltar ) {
		h_container -= 50;
		t_container += 50;
	}
	
	if( submenu ){
		h_container -= 51;
		t_container += 51; 
		
		submenu_list = document.getElementById('submenu_list');
		submenu_select = document.getElementById('submenu_select');
		
		if($(submenu_list).height() <= 60 && submenu_type == "select" ) { 
			submenu_type = "list";
			$(submenu_list).show();
			$(submenu_select).hide();
			$(submenu_select_ico).hide();
		}
		   
		if($(submenu_list).height() >= 60 && submenu_type == "list" ) {
			submenu_type = "select";
			$(submenu_select).show();
			$(submenu_select_ico).show();
			$(submenu_list).hide();
			   
		}
		
		console.log(submenu_type);
		
	}
	
	if( bt_gravar ) {
		h_container -= 99;
	}
	
	$("#menu_ul").css( { height:win_h - 199 } ); 
	$("#container").css( { height:h_container, top:t_container } ); 
	
	
	
	
}

window.onresize = resize;  