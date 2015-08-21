<?php   

function send_file($filename,$d){ 
	header ("Expires: Mon, 1 Apr 1974 05:00:00 GMT"); 
	header ("Last-Modified: ".gmdate("D,d M YH:i:s") . " GMT"); 
	header ("Cache-Control: no-cache, must-revalidate"); 
	header ("Pragma: no-cache"); 
	header ("Content-Transfer-Encoding: UTF-8");
	header ("Content-Encoding: UTF-8");
	header ("Content-type: image/svg; charset=UTF-8"); 
	header ("Content-Disposition: attachment; filename=".$filename); 
	header ("Content-Description: PHP Generated SVG Data"); 
	
	print $d;
}   

send_file( $_POST["svg_name"], stripslashes ($_POST["svg_out"])); 
	
?>