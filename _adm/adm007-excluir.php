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
	
	if(!isset($_GET['id_serv'])){
		echo "<script>";
		echo "window.location.replace('adm004-categorias.php');";;
		echo "</script>";
	}
	
	$id_servico = $_GET['id_serv'];
	
	include('../_conexao/conexao_profissional.php');
	
	$sql_contrato = "SELECT * FROM contrato WHERE id_servico = $id_servico";
	$sql_query_contrato = $mysqli->query($sql_contrato) or die ("Falha na execução do código SQL " . $mysqli->error);
	
	$sql_avalie = "SELECT * FROM avalie WHERE id_servico = $id_servico";
	$sql_query_avalie = $mysqli->query($sql_avalie) or die ("Falha na execução do código SQL " . $mysqli->error);
	
	$sql_avaliacao = "SELECT * FROM avaliacao WHERE id_servico = $id_servico";
	$sql_query_avaliacao = $mysqli->query($sql_avaliacao) or die ("Falha na execução do código SQL " . $mysqli->error);
	
	$sql_regiao = "SELECT * FROM regiao WHERE id_servico = $id_servico";
	$sql_query_regiao = $mysqli->query($sql_regiao) or die ("Falha na execução do código SQL " . $mysqli->error);
	
	$quant_contrato = $sql_query_contrato->num_rows;
	$quant_avalie = $sql_query_avalie->num_rows;
	$quant_avaliacao = $sql_query_avaliacao->num_rows;
	$quant_regioes = $sql_query_regiao->num_rows;
	
	$quant = $quant_contrato + $quant_avalie + $quant_avaliacao + $quant_regioes;
	
	if($quant==0){
		$usuario_excluir = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
		$sql = " DELETE FROM servico WHERE id_servico = $id_servico";
		mysqli_query($usuario_excluir,$sql) or die ("Erro ao tentar cadastrar registro");
		mysqli_close($usuario_excluir);
		echo "<script>";
		echo 	"confirm('Serviço Excluído com Sucesso!!');";
		echo 	"window.location.replace('adm007-servicos.php');";
		echo "</script>";
	} else {
		echo "<script>";
		echo 	"confirm('Você não pode excluir esse serviço, pois tem pendências em seu nome!!');";
		echo 	"window.location.replace('adm007-servicos.php');";
		echo "</script>";
	}
	
	
	
?>