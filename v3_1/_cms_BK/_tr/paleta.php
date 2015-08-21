	<style type="text/css">
 
		/* PALETA DE CORES */

		.paleta{
			position: absolute;
			width: 177px;
			height:25px;
			background: #fff;
			border:#fff 1px solid;
			z-index: 100;
			display: none;
		}

		.cor{
			float: left;
			width: 25px;
			height: 25px;
			border:#fff 1px solid;
		}

		.cor_select{
			border:#fff 6px solid;
		}

		.cor:hover{border:#333 1px solid;}

	</style>   	

	<script type="text/javascript">
		
		window.onload = function(){ 
				
			var cor;
			var i;
			var u;
			var usadas = document.getElementById('usadas').value.split(',');
			for(i=0; i<usadas.length;i++){
				usadas[i] = usadas[i].split('|');
				usadas[i][0] = document.getElementById('hex' + usadas[i][0]);
			}

			var paleta = document.createElement('ul');
			paleta.className = 'paleta';
			document.body.appendChild(paleta);

			function verifica_usadas(){
				for(i=0; i<paleta_cores.length; i++){
					paleta_cores[i].li.style.background = paleta_cores[i].hex;
					if(paleta_cores[i].usada){
						paleta_cores[i].li.className = 'cor cor_select';							
					}else{
						paleta_cores[i].li.className = 'cor';
					}
				}
			}

			for(i=0; i<paleta_cores.length; i++){
				cor = document.createElement('li');
				paleta_cores[i].li = cor;
				cor.ID = i;
				cor.className = 'cor';

				for(u=0; u<usadas.length; u++){ 
					if(paleta_cores[i].hex == usadas[u][1]){ 
						paleta_cores[i].usada = true;
						usadas[u][0].cor = cor;
					}  
				}

				paleta.appendChild(cor);

				cor.onmousedown = function(){
					if(campo_focus.cor) paleta_cores[campo_focus.cor.ID].usada = false;
					campo_focus.value = paleta_cores[this.ID].hex;
					campo_focus.style.background = paleta_cores[this.ID].hex;
					campo_focus.cor = this;
					paleta_cores[this.ID].usada = true;
					verifica_usadas();
				} 
			}

			verifica_usadas(); 

			var campos = document.getElementsByTagName('input');
			var campo;	
			var campo_focus;

			for(i=0; i<campos.length; i++){

				campo = campos[i];

				if(campo.id[0] == 'h'){ // hex

					if(campo.value){
						campo.style.background = campo.value;
					} 

					campo.onfocus = function(){

						campo_focus = this;

						var top = $(this).offset().top;
						var left = $(this).offset().left - 2 
						var win_w = $(window).width();

						if(top - 27 > 0) top -= 27; 
						else top += $(this).height();							

						if(left + 27 > win_w) left = win_w - 27;  

						paleta.style.top =  top + 'px';
						paleta.style.left = left + 'px';	
						paleta.style.display = 'block';	
						
						for(i=0; i<paleta_cores.length; i++){
							if(this.value == paleta_cores[i].hex){
								paleta_cores[i].li.style.backgroundColor = '#fff';
							}else{
								paleta_cores[i].li.style.background = paleta_cores[i].hex;
							}
						} 
						
					}

					campo.onblur = function(){	
						paleta.style.display = '';	
					} 
				} 
			}
		}

	</script>