<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['id_usuario'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(isset($_SESSION['status'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_usuario.php');";
		echo "</script>";
	}
	
	$id_usuario = $_SESSION['id_usuario'];
	$nome_usuario = $_POST['nomeUsuario'];
	$sobrenome_usuario = $_POST['sobrenomeUsuario'];
	
	include("../../_conexao/conexao_login.php");
			
	$sql_code = "UPDATE usuario SET nome = '$nome_usuario', sobrenome = '$sobrenome_usuario' WHERE usuario.id_usuario = '$id_usuario'";
	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
	
	$_SESSION['nome'] = $nome_usuario;
	$_SESSION['sobrenome'] = $sobrenome_usuario;
	
	echo "<script>";
	echo 	"window.location.replace('configuracoes.php');";
	echo "</script>";
			
?>