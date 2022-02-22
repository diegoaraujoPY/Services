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
	
	if(!isset($_GET['id_cont'])){
		echo "<script>";
		echo "window.location.replace('adm004-categorias.php');";;
		echo "</script>";
	}
	
	$id_contrato = $_GET['id_cont'];
	
	include('../_conexao/conexao_profissional.php');
	
	$sql = "SELECT * FROM contrato WHERE id_contrato = $id_contrato";
	$sql_contrato = $mysqli->query($sql) or die ("Falha na execução do código SQL " . $mysqli->error);
	
	while($contrato = mysqli_fetch_array($sql_contrato)){
		$id_servico = $contrato['id_servico'];
		$id_usuario = $contrato['id_usuario'];
		
		$sql = "SELECT * FROM avalie WHERE id_servico = $id_servico";
		$sql_servico = $mysqli->query($sql) or die ("Falha na execução do código SQL " . $mysqli->error);
		
		$quant = $sql_servico->num_rows;
		
		if($quant==0){
			
		} else {
			$avalie_excluir = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
			$sql_avalie = " DELETE FROM avalie WHERE id_servico = $id_servico AND id_usuario = $id_usuario";
			mysqli_query($avalie_excluir,$sql_avalie) or die ("Erro ao tentar cadastrar registro");
			mysqli_close($avalie_excluir);
		}
		
	}

	$contrato_excluir = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = " DELETE FROM contrato WHERE id_contrato = $id_contrato";
	mysqli_query($contrato_excluir,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($contrato_excluir);
	
	
	echo "<script>";
	echo 	"confirm('Contrato Excluído com Sucesso!!');";
	echo 	"window.location.replace('adm008-contratos.php');";
	echo "</script>";
	
	
?>