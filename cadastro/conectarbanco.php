<?php
 	$login = $_POST['login'];
    $entrar = $_POST['entrar'];
    $senha = md5($_POST['senha']);
    $connect = mysql_connect('localhost','root','root');
    $db = mysql_select_db('cadastro');
?>