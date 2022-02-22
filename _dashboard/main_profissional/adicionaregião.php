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
	
	$cidade_servico = $_POST['cidadeServico'];
	$uf_servico = $_POST['ufServico'];
	$regiao_servico = $_SESSION['id_servico_regiao'];
	
	include("../../_conexao/conexao_login.php");
			
	$registra_servico = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = " INSERT INTO regiao (regiao, estado, id_servico) VALUES ";
	$sql .="('$cidade_servico', '$uf_servico', '$regiao_servico')";
	mysqli_query($registra_servico,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($registra_servico);
	
	echo "<script>";
	echo 	"window.location.replace('regioesdeatendimento.php');";
	echo "</script>";
			
?>