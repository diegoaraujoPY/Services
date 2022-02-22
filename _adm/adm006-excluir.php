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
	
	if(!isset($_GET['id_pro'])){
		echo "<script>";
		echo "window.location.replace('adm004-categorias.php');";;
		echo "</script>";
	}
	
	$id_profissional = $_GET['id_pro'];
	
	include('../_conexao/conexao_profissional.php');
	
	$sql = "SELECT * FROM servico WHERE id_profissional = $id_profissional";
	$sql_servicos = $mysqli->query($sql) or die ("Falha na execução do código SQL " . $mysqli->error);
	
	$quant = $sql_servicos->num_rows;
	
	if($quant==0){
		$profissional_excluir = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
		$sql = " DELETE FROM profissional WHERE id_profissional = $id_profissional";
		mysqli_query($profissional_excluir,$sql) or die ("Erro ao tentar cadastrar registro");
		mysqli_close($profissional_excluir);
		echo "<script>";
		echo 	"confirm('Profissional Excluído com Sucesso!!');";
		echo 	"window.location.replace('adm006-Profissionais.php');";
		echo "</script>";
	} else {
		echo "<script>";
		echo 	"confirm('Você não pode excluir esse profissional, pois tem serviços cadastrados em seu nome!!');";
		echo 	"window.location.replace('adm006-Profissionais.php');";
		echo "</script>";
	}
	
	
	
?>