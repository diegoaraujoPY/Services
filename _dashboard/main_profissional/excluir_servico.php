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
		echo "window.location.replace('../../_paginas/login_usuario.php');";;
		echo "</script>";
	}

	$cod_regiao = $_GET['cod_regiao'];
	
	

	include("../../_conexao/conexao_login.php");
			
	$excluir_servico = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "DELETE FROM regiao WHERE regiao.id_regiao = $cod_regiao";
	mysqli_query($excluir_servico,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($excluir_servico);
	
	echo "<script>";
	echo "window.location.replace('editarregioesdeatendimento.php');";;
	echo "</script>";

?>