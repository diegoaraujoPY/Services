<?php
	
	$nome = $_POST['nomeUsuario'];
	$sobrenome = $_POST['sobrenomeUsuario'];
	$nascimento = $_POST['nascUsuario'];
	$sexo = $_POST['sexo'];
	$cep = $_POST['cepUsuario'];
	$cidade = $_POST['cidadeUsuario'];
	$uf = $_POST['estadoUsuario'];
	$bairro = $_POST['bairroUsuario'];
	$rua = $_POST['ruaUsuario'];
	$num = $_POST['numUsuario'];
	$telefone = $_POST['tellUsuario'];
	$senha = $_POST['senhaUsuario'];
		
	$registra_usuario = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = " INSERT INTO usuario (nome, sobrenome, nascimento, telefone, cep, cidade, uf, bairro, rua, num, senha) VALUES ";
	$sql .="('$nome', '$sobrenome', '$nascimento', '$telefone', '$cep', '$cidade', '$uf', '$bairro', '$rua', '$num', '$senha')";
	mysqli_query($registra_usuario,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($registra_usuario);
	echo "<script>";
	echo 	"confirm('Usuário Cadastrado com Sucesso!');";
	echo 	"window.location.replace('../_cadastrado/usuario.php');";
	echo "</script>";
?>