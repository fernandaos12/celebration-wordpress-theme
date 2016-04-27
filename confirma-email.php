<?php
$login     = $_POST['login'];
$subject = "Confirmação de cadastro no site Celebration";
$message = "
Você está recebendo a confirmação de cadastro no site Celebration Ville na sessão Corretores.
Os dados abaixo correspondem ao seu login e senha.
"; // fim da mensagem
$headers .= "To: $nome <$login>" . "\r\n";
$headers .= "From: Celebration Ville <email@email.com.br>" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
mail($login, $subject, $message, $headers);
?>