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
	
	$id_profissional = $_SESSION['id_usuario'];
	$nome_profissional = $_POST['nomeProfissional'];
	$sobrenome_profissional = $_POST['sobrenomeProfissional'];
	
	include("../../_conexao/conexao_login.php");
			
	$sql_code = "UPDATE profissional SET nome = '$nome_profissional', sobrenome = '$sobrenome_profissional' WHERE profissional.id_profissional = '$id_profissional'";
	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
	
	$_SESSION['nome'] = $nome_profissional;
	$_SESSION['sobrenome'] = $sobrenome_profissional;
	
	echo "<script>";
	echo 	"window.location.replace('configuracoes.php');";
	echo "</script>";
			
?>