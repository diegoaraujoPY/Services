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
	$cep_usuario = $_POST['cepUsuario'];
	$cidade_usuario = $_POST['cidadeUsuario'];
	$uf_usuario = $_POST['ufUsuario'];
	$bairro_usuario = $_POST['bairroUsuario'];
	$rua_usuario = $_POST['ruaUsuario'];
	$n_usuario = $_POST['numUsuario'];
	
	include("../../_conexao/conexao_login.php");
			
	$sql_code = "UPDATE usuario SET cep = '$cep_usuario', cidade = '$cidade_usuario', uf = '$uf_usuario', bairro = '$bairro_usuario', rua = '$rua_usuario', num = '$n_usuario' WHERE usuario.id_usuario = '$id_usuario'";
	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
	
	$_SESSION['cep'] = $cep_usuario;
	$_SESSION['cidade'] = $cidade_usuario;
	$_SESSION['uf'] = $uf_usuario;
	$_SESSION['bairro'] = $bairro_usuario;
	$_SESSION['rua'] = $rua_usuario;
	$_SESSION['num'] = $n_usuario;
	
	echo "<script>";
	echo 	"window.location.replace('configuracoes.php');";
	echo "</script>";
			
?>