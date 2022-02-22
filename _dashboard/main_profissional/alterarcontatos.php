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
	$telefone_profissional = $_POST['tellProfissional'];
	$insta_profissional = $_POST['instaProfissional'];
	$face_profissional = $_POST['faceProfissional'];
	$zap_profissional = $_POST['zapProfissional'];
	
	include("../../_conexao/conexao_login.php");
			
	$sql_code = "UPDATE profissional SET telefone = '$telefone_profissional', insta = '$insta_profissional', face = '$face_profissional', whatsapp = '$zap_profissional' WHERE profissional.id_profissional = '$id_profissional'";
	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
	
	$_SESSION['telefone'] = $telefone_profissional;
	$_SESSION['instagram'] = $insta_profissional;
	$_SESSION['facebook'] = $face_profissional;
	$_SESSION['whatsapp'] = $zap_profissional;
	
	echo "<script>";
	echo 	"window.location.replace('configuracoes.php');";
	echo "</script>";
			
?>