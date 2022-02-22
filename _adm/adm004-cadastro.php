<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(isset($_SESSION['id_usuario'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(!isset($_SESSION['id_adm'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(!isset($_POST['categoria'])){
		echo "<script>";
		echo "window.location.replace('adm004-categorias.php');";;
		echo "</script>";
	}
	
	$nome = $_POST['categoria'];
	
	$categoria = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = " INSERT INTO categoria (nome) VALUES ('$nome')";
	mysqli_query($categoria,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($categoria);
	echo "<script>";
	echo 	"confirm('Nova categoria adicionada!!');";
	echo 	"window.location.replace('adm004-categorias.php');";
	echo "</script>";
	
?>