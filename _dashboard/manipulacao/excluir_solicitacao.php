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
	
	if(!isset($_GET['c'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_usuario.php');";;
		echo "</script>";
	}

	$cod_servico = $_GET['c'];
	

	include("../../_conexao/conexao_login.php");
			
	$excluir_solicitacao = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "UPDATE servico SET aceitar = 0 WHERE id_servico = '$cod_servico'";
	mysqli_query($excluir_solicitacao,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($excluir_solicitacao);
	
	echo "<script>";
	echo 	"window.location.replace('../main_profissional/solicitacao.php?c=$cod_servico');";
	echo "</script>";

?>