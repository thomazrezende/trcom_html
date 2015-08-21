<?php
require_once("../../../_control/acesso.php");
require_once("../../../_control/seguranca.php");
require_once("_tr/mysql.php");
require_once("_tr/html.php");

$conexao = conectar();
sessao();

head("TRCOM_login");

?>

<body class="login">
	
		<?php

			div1("dados_login", "","", "", false );  

			form1("login_form", "login_form", "php/logar.php", "post");

				input("login", "input", "login", "text", "", "LOGIN", false, false); 
				input("senha", "input", "senha", "password", "", "SENHA", false, false);
				submit('','btg',"ENTRAR");

			form2();

			a_link("esqueci_senha","","php/esqueci_senha.php", "esqueci a senha", "_self", false);	

			div2();

			mensagem();

		?> 
     
</body>
</html>
