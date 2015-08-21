	
     
	<script type="text/javascript" language="javascript" src="../_tools/jquery-ui.js" charset="utf-8"></script> 

   	<script>
		
		$(document).ready(function() {  
		
			var layout_itens = document.getElementById("layout_itens");
			var layout_larguras = document.getElementById("layout_larguras");
			var itens = document.getElementById("itens");
			var layout_altera = document.getElementById("layout_altera");
			var lixo = document.getElementById("lixo");
			var itm; 
			
			function layout_att(){ 
				var sortedIDs = []; 
				var sortedCls = []; 
				$("#itens").children().each( function(){
					sortedIDs.push(this.id);
					sortedCls.push(this.className);
				}); 
				layout_itens.setAttribute("value", sortedIDs); 
				layout_larguras.setAttribute("value", sortedCls); 
			}
			
			if(layout_itens.value != "" ){
				var layout_arr = layout_itens.value.split(","); 
				var larguras_arr = layout_larguras.value.split(",");
				
				for(var i=0; i<layout_arr.length; i++){  
					if(layout_arr[i] != ""){ //elimina eventuais "," vazios  
                        if(document.getElementById(layout_arr[i])){ // caso um banner seja removido, não trava nesse ponto 
							
							itm = document.getElementById(layout_arr[i]);
							
							console.log(larguras_arr[i]);	
							
							itm.className = larguras_arr[i];
							
							var bt_size = document.createElement('span');   
							bt_size.className = 'bt_size';
							
							if(itm.className == 'w100') bt_size.innerHTML = '&ndash;';
							else bt_size.innerHTML = '&plus;';
								
							itm.appendChild(bt_size);
							bt_size.itm = itm;
							
							var bt_move = document.createElement('span');   
							bt_move.className = 'bt_move';
							bt_move.innerHTML = "<img src='_layout/handle.png'/>";
							itm.appendChild(bt_move); 
							
							bt_size.onclick = function(){
								console.log(this.itm);
								if(this.itm.className == 'w100') {
									this.itm.className = 'w50';
									this.innerHTML = '&plus;';
								}else{
									this.itm.className = 'w100';
									this.innerHTML = '&ndash;';	
								} 
								layout_att();
							}
							
							var bt_menos = document.createElement('div');   
							
							console.log(itm);
                            itens.appendChild(itm);
                        } 
                    } 
				} 
			} 
			
			//layout_att();
				
			$( "#itens" ).sortable({
				handle: ".bt_move", 
				connectWith: ".sortable",
				update: function( event, ui ) {  
					layout_att();
				} 
		  
			}).disableSelection();    
			
		  
		});  
		
		
		

	
    </script>