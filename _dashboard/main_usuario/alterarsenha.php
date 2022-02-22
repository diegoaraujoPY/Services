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
	$senha_usuario = $_SESSION['senha'];
	$senha_antiga_usuario = $_POST['senhaUsuario'];
	$nova_senha_usuario = $_POST['NovaUsuario'];
	$confirme_senha_usuario = $_POST['ConfirmeNovaU'];
	
	include("../../_conexao/conexao_login.php");
	
	if($senha_usuario==$senha_antiga_usuario){
		if($nova_senha_usuario==$confirme_senha_usuario){
			$sql_code = "UPDATE usuario SET senha = '$nova_senha_usuario' WHERE usuario.id_usuario = '$id_usuario'";
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
		
		echo "</script>";
	}
			
?>