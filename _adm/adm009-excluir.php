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
	
	if(!isset($_GET['id_av'])){
		echo "<script>";
		echo "window.location.replace('adm004-categorias.php');";;
		echo "</script>";
	}
	
	$id_avaliacao = $_GET['id_av'];

	$avaliacao_excluir = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = " DELETE FROM avaliacao WHERE id_av = $id_avaliacao";
	mysqli_query($avaliacao_excluir,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($avaliacao_excluir);
	
	
	echo "<script>";
	echo 	"confirm('Avaliação Excluída com Sucesso!!');";
	echo 	"window.location.replace('adm009-avaliacoes.php');";
	echo "</script>";
	
	
?>