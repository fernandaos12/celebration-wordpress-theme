<?php

$login = $_POST['login'];
$senha = MD5($_POST['senha']);
$email = $_POST['email'];
$connect = mysql_connect('187.45.196.185','tenobrasil13','Convexmusique');
$db = mysql_select_db('tenobrasil13');
$query_select = "SELECT login FROM cadastro WHERE login = '$login'";
$select = mysql_query($query_select,$connect);
$array = mysql_fetch_array($select);
$logarray = $array['login'];

    if($login == "" || $login == null){
        echo"<script language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');window.location.href='index.html';</script>";

        }else{
            if($logarray == $login){

                echo"<script language='javascript' type='text/javascript'>alert('Esse login já existe');window.location.href='index.html';</script>";
                die();

            }else{
                $query = "INSERT INTO cadastro (login,senha,email) VALUES ('$login','$senha','$email')";
                $insert = mysql_query($query,$connect);

                if($insert){
                    echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!'); window.location.href='login.html'</script>";
                }else{
                    echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='index.html'</script>";
                }
            }
        }
?>
