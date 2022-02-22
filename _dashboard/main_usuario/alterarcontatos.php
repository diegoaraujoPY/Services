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
	
	$id_usuario = $_SESSION['id_usuario'];
	$telefone_usuario = $_POST['tellUsuario'];
	
	include("../../_conexao/conexao_login.php");
			
	$sql_code = "UPDATE usuario SET telefone = '$telefone_usuario' WHERE usuario.id_usuario = '$id_usuario'";
	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
	
	$_SESSION['telefone'] = $telefone_usuario;
	
	echo "<script>";
	echo 	"window.location.replace('configuracoes.php');";
	echo "</script>";
			
?>