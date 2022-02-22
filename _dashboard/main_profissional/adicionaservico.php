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
	
	include("../../_conexao/conexao_login.php");
			
	$registra_servico = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = " INSERT INTO servico (especialidade, descricao, id_profissional, id_categoria) VALUES ";
	$sql .="('$especialidade_servico', '$descricao_servico', '$id_profissional_servico', '$categoria_servico')";
	mysqli_query($registra_servico,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($registra_servico);
	
	echo "<script>";
	echo 	"window.location.replace('regioesdeatendimento.php');";
	echo "</script>";
			
?>