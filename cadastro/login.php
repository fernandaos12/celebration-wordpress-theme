<?php
    $login = $_POST['login'];
    $senha = ($_POST['senha']);
    $entrar = $_POST['entrar'];
    $connect = mysql_connect('187.45.196.185','tenobrasil13','Convexmusique');
    $db = mysql_select_db('tenobrasil13');
        if (isset($entrar)) {

            $verifica = mysql_query("SELECT * FROM login WHERE login = '$login' AND senha = '$senha'") or die("Houve um erro com seu usuário ou senha.");
                if (mysql_num_rows($verifica)<=0){
                    echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='http://celebrationville.com.br/?page_id=551';</script>";
                    die();
                }else{
                    setcookie("login",$login);
                    header("Location:http://celebrationville.com.br/?page_id=553");
                }
        }
?>
