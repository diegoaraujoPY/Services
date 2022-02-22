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
	
	if(!isset($_SESSION['edicaocategoria'])){
		echo "<script>";
		echo "window.location.replace('adm004-categorias.php');";;
		echo "</script>";
	}
	
	$id_categoria = $_SESSION['edicaocategoria'];
	$nome = $_POST['categoria'];
	
	$categoria_editar = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = " UPDATE categoria SET nome = '$nome' WHERE id_categoria = '$id_categoria'";
	mysqli_query($categoria_editar,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($categoria_editar);
	
	echo "<script>";
	echo 	"confirm('Categoria editada!!');";
	echo 	"window.location.replace('adm004-categorias.php');";
	echo "</script>";
	
?>