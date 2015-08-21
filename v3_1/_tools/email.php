<?php

	if($_POST){	 
		
		require_once("../_control/acesso.php");
		require_once("../_control/seguranca.php");
		require_once("cms/_tr/mysql.php");
		 
		$dados = sql_select($conexao,"dados","email","","",false);
		$to_email = $dados['email'];

		//check if its an ajax request, exit if not
		if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
			return false;
		}
		
		//Sanitize input data using PHP filter_var().
		$nome = $_POST["nome"];
		$email = $_POST["email"];
		$mensagem = $_POST["msg"];

		//email body
		$message_body = $mensagem . "\r\n\r\n" . $nome . " <" . $email .">";
		$subject = "contato via TRCOMrezende.com de " . $nome;

		//proceed with PHP email.
		$headers = 'From: ' . $to_email . "\r\n" .
		'Reply-To: ' . $email . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		$send_mail = mail($to_email, $subject, $message_body, $headers);

		if(!$send_mail){ 
			return false;
		}else{
			return true;
		} 
	}

?>
