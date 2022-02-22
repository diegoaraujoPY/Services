<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['id_usuario'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_usuario.php');";;
		echo "</script>";
	}

	if(!isset($_GET['cod_servico'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_usuario.php');";;
		echo "</script>";
	}
	
	$id_usuario = $_SESSION['id_usuario'];
	$id_solicitado = $_GET['cod_servico'];
	
	$solicitar = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = " UPDATE servico SET aceitar = '$id_usuario' WHERE servico.id_servico = '$id_solicitado'";
	mysqli_query($solicitar,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($solicitar);
	echo "<script>";
	echo 	"window.location.replace('contratar.php?cod_servico=$id_solicitado');";
	echo "</script>";
	
?>