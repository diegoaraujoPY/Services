<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['id_adm'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(!isset($_GET['cod_regiao'])){
		echo "<script>";
		echo "window.location.replace('adm007-editar_regioes.php');";;
		echo "</script>";
	}
	
	$cod_regiao = $_GET['cod_regiao'];
	
	include('../_conexao/conexao_profissional.php');
	
	$excluirregiao = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "DELETE FROM regiao WHERE id_regiao = $cod_regiao";
	mysqli_query($excluirregiao,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($excluirregiao);
	
	echo "<script>";
	echo 	"window.location.replace('adm007-servicos.php');";
	echo "</script>";
	
?>