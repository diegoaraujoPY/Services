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
	
	if(!isset($_GET['cat'])){
		echo "<script>";
		echo "window.location.replace('adm004-categorias.php');";;
		echo "</script>";
	}
	
	$id_categoria = $_GET['cat'];
	
	include('../_conexao/conexao_profissional.php');
	
	$sql = "SELECT * FROM servico WHERE id_categoria = $id_categoria";
	$sql_servicos = $mysqli->query($sql) or die ("Falha na execução do código SQL " . $mysqli->error);
	
	$quant = $sql_servicos->num_rows;
	
	if($quant==0){
		$categoria_excluir = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
		$sql = " DELETE FROM categoria WHERE id_categoria = $id_categoria";
		mysqli_query($categoria_excluir,$sql) or die ("Erro ao tentar cadastrar registro");
		mysqli_close($categoria_excluir);
		echo "<script>";
		echo 	"confirm('Categoria Excluída com Sucesso!!');";
		echo 	"window.location.replace('adm004-categorias.php');";
		echo "</script>";
	} else {
		echo "<script>";
		echo 	"confirm('Você não pode excluir essa categoria, pois já tem serviços cadastrados nela!!');";
		echo 	"window.location.replace('adm004-categorias.php');";
		echo "</script>";
	}
	
	
	
?>