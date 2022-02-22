<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['id_usuario'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(isset($_SESSION['status'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_usuario.php');";;
		echo "</script>";
	}


	$id_usuario = $_SESSION['id_usuario'];
	$id_servico = $_GET['c'];
	
	$excluir_avalie = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "DELETE FROM avalie WHERE id_usuario = $id_usuario AND id_servico = $id_servico";
	mysqli_query($excluir_avalie,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($excluir_avalie);
	
	$excluir_contrato = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "DELETE FROM contrato WHERE id_servico = $id_servico";
	mysqli_query($excluir_contrato,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($excluir_contrato);
	
	echo "<script>";
	echo "window.location.replace('../../index.php');";
	echo "</script>";

?>