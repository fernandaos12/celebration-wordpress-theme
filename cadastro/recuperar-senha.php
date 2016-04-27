<?php
$conecta = mysql_connect("localhost", "root", "root");

mysql_select_db("cadastro", $conecta); 
//pega a variavel via post
$email = $_POST['email'];

$sql = mysql_query("SELECT * FROM inscricaologin WHERE email='$email'");
$result = mysql_query($sql, $conecta); 

//conta quantos tem
$num_rows = mysql_num_rows($result);
//se tiver  + de 1 cadastrado
if($num_rows=='1'){
	//faz um while para vc coloar os dados nas variavels
	while($row_email = mysql_fetch_array($result){
		$rowemail = $row_email['email'];
		$rowsenha = $row_email['senha'];
		}
		
//enviar um email para variavel email juntamente com a variável senha;
$mensage ="Você solicitou a recuperação de senha, confira seu dados.";
$mensage .="E-mail= " . $rowemail;
$mensage .="Senha:" . $rowsenha;
mail($rowemail, "recuperação de senha", $mensage);

echo"<script>alert(Sua senha foi enviada para o e-mail indicado.),window.open('login.html','_self')</script>";

}else{
		
	echo"<script>alert('E-mail não cadastrado em nosso sistema'),window.open('login.html','_self')</script>";
	
}
?>