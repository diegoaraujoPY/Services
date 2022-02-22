<?php
	
	$nome = $_POST['nomeADM'];
	$sobrenome = $_POST['sobrenomeADM'];
	$nivel = $_POST['nivel'];
	$usuario = $_POST['usuarioADM'];
	$senha = password_hash($_POST['usuarioSenha'], PASSWORD_DEFAULT);
		
	$registra_adm = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = " INSERT INTO adm (nome, sobrenome, nivel, usuario, senha_adm) VALUES ";
	$sql .="('$nome', '$sobrenome', '$nivel', '$usuario', '$senha')";
	mysqli_query($registra_adm,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($registra_adm);
	echo "<script>";
	echo 	"confirm('Administrador Cadastrado!');";
	echo 	"window.location.replace('../index.php');";
	echo "</script>";
?>