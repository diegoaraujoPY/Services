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
	$senha_profissional = $_SESSION['senha'];
	$senha_antiga_profissional = $_POST['senhaProfissional'];
	$nova_senha_profissional = $_POST['NovaProfissional'];
	$confirme_senha_profissional = $_POST['ConfirmeNovaP'];
	
	include("../../_conexao/conexao_login.php");
	
	if($senha_profissional==$senha_antiga_profissional){
		if($nova_senha_profissional==$confirme_senha_profissional){
			$sql_code = "UPDATE profissional SET senha = '$nova_senha_profissional' WHERE profissional.id_profissional = '$id_profissional'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
			echo "<script>";
			echo 	"confirm('SENHA ALTERADA COM SUCESSO!');";
			echo 	"window.location.replace('configuracoes.php');";
			echo "</script>";
		} else {
			echo "<script>";
			echo 	"confirm('A CONFIRMAÇÃO DA SENHA NÃO COINCIDE!');";
			echo 	"window.location.replace('mudar_senha.php');";
			echo "</script>";
		}
	} else {
		echo "<script>";
		echo 	"confirm('SENHA INVÁLIDA!');";
		echo 	"window.location.replace('mudar_senha.php');";
		echo "</script>";
	}
			
?>