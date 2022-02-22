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
	$status = $_POST["statusn"];
	
	include("../../_conexao/conexao_login.php");
			
	$sql_code = "UPDATE profissional SET status = '$status' WHERE profissional.id_profissional = '$id_profissional'";
	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
	
	$_SESSION['status'] = $status;
	
	echo "<script>";
	echo 	"window.location.replace('../main_profissional.php');";
	echo "</script>";
			
?>