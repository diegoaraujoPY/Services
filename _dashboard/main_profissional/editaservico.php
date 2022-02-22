<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['id_usuario'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(!isset($_SESSION['status'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_usuario.php');";
		echo "</script>";
	}
	
	$especialidade_servico = $_POST['especialidade_servico'];
	$descricao_servico = $_POST['descricao'];
	$categoria_servico = $_POST['categoria'];
	$id_profissional_servico = $_SESSION['id_usuario'];
	$id_servico = $_SESSION['id_servico'];
	
	include("../../_conexao/conexao_login.php");
			
	$edita_servico = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "UPDATE servico SET especialidade = '$especialidade_servico', descricao = '$descricao_servico', id_categoria = '$categoria_servico' WHERE servico.id_servico = '$id_servico'";
	mysqli_query($edita_servico,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($edita_servico);
	
	echo "<script>";
	echo 	"window.location.replace('myservicos.php');";
	echo "</script>";
			
?>