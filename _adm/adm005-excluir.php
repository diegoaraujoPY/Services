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
	
	if(!isset($_GET['id_usu'])){
		echo "<script>";
		echo "window.location.replace('adm004-categorias.php');";;
		echo "</script>";
	}
	
	$id_usuario = $_GET['id_usu'];
	
	include('../_conexao/conexao_profissional.php');
	
	$sql_contrato = "SELECT * FROM contrato WHERE id_usuario = $id_usuario";
	$sql_query_contrato = $mysqli->query($sql_contrato) or die ("Falha na execução do código SQL " . $mysqli->error);
	
	$sql_avalie = "SELECT * FROM avalie WHERE id_usuario = $id_usuario";
	$sql_query_avalie = $mysqli->query($sql_avalie) or die ("Falha na execução do código SQL " . $mysqli->error);
	
	$sql_avaliacao = "SELECT * FROM avaliacao WHERE id_usuario = $id_usuario";
	$sql_query_avaliacao = $mysqli->query($sql_avaliacao) or die ("Falha na execução do código SQL " . $mysqli->error);
	
	$sql_permissao = "SELECT aceitar FROM servico WHERE aceitar = $id_usuario";
	$sql_query_permissao = $mysqli->query($sql_permissao) or die ("Falha na execução do código SQL " . $mysqli->error);
	
	$quant_contrato = $sql_query_contrato->num_rows;
	$quant_avalie = $sql_query_avalie->num_rows;
	$quant_avaliacao = $sql_query_avaliacao->num_rows;
	$quant_permissao = $sql_query_permissao->num_rows;
	
	$quant = $quant_contrato + $quant_avalie + $quant_avaliacao + $quant_permissao;
	
	if($quant==0){
		$usuario_excluir = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
		$sql = " DELETE FROM usuario WHERE id_usuario = $id_usuario";
		mysqli_query($usuario_excluir,$sql) or die ("Erro ao tentar cadastrar registro");
		mysqli_close($usuario_excluir);
		echo "<script>";
		echo 	"confirm('Usuário Excluído com Sucesso!!');";
		echo 	"window.location.replace('adm005-usuarios.php');";
		echo "</script>";
	} else {
		echo "<script>";
		echo 	"confirm('Você não pode excluir esse usuário, pois tem pendências em seu nome!!');";
		echo 	"window.location.replace('adm005-usuarios.php');";
		echo "</script>";
	}
	
	
	
?>