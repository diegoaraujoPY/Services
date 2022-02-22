<?php
	
	$nome = $_POST['nomeProfissional'];
	$sobrenome = $_POST['sobrenomeProfissional'];
	$nascimento = $_POST['nascProfissional'];
	$cep = $_POST['cepProfissional'];
	$cidade = $_POST['cidadeProfissional'];
	$uf = $_POST['estadoProfissional'];
	$bairro = $_POST['bairroProfissional'];
	$rua = $_POST['ruaProfissional'];
	$num = $_POST['numProfissional'];
	$telefone = $_POST['tellProfissional'];
	$instagram = $_POST['instaProfissional'];
	$facebook = $_POST['faceProfissional'];
	$whatsapp = $_POST['zapProfissional'];
	$senha = $_POST['senhaProfissional'];
		
	$registra_profissional = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = " INSERT INTO profissional (nome, sobrenome, nascimento, telefone, cep, cidade, uf, bairro, rua, num, insta, face, whatsapp, senha) VALUES ";
	$sql .="('$nome', '$sobrenome', '$nascimento', '$telefone', '$cep', '$cidade', '$uf', '$bairro', '$rua', '$num', '$instagram', '$facebook', '$whatsapp','$senha')";
	mysqli_query($registra_profissional,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($registra_profissional);
	
	echo "<script>";
	echo 	"confirm('Profissional Cadastrado com Sucesso!');";
	echo 	"window.location.replace('../_cadastrado/profissional.php');";
	echo "</script>";
?>