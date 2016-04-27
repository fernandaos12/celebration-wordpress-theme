<?php 
	
	
	//Wordpress
	include("../../../wp-load.php");

	
	//Campos

	$name	  = $_POST['n'];
	$email	  = $_POST['e'];
	
	
	// Cadastrando no myMail
	
	echo  mymail_subscribe($email, array('firstname' => $name, 'lastname' => ' '), array('assinantes'), false);


?>
