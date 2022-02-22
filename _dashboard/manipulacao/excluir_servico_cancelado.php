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
	
	if(!isset($_GET['icontrato'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_usuario.php');";;
		echo "</script>";
	}

	$id_contrato = $_GET['icontrato'];

	include("../../_conexao/conexao_login.php");
	
	$excluir_contrato = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql_fim = "DELETE FROM contrato WHERE id_contrato = '$id_contrato'";
	mysqli_query($excluir_contrato,$sql_fim) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($excluir_contrato);
	
	echo "<script>";
	echo "window.location.replace('../main_profissional/agenda.php');";;
	echo "</script>";

?>