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
		echo "window.location.replace('../../_paginas/login_usuario.php');";
		echo "</script>";
	}
	
	$id_profissional = $_SESSION['id_usuario'];
	$cep_profissional = $_POST['cepProfissional'];
	$cidade_profissional = $_POST['cidadeProfissional'];
	$uf_profissional = $_POST['ufProfissional'];
	$bairro_profissional = $_POST['bairroProfissional'];
	$rua_profissional = $_POST['ruaProfissional'];
	$n_profissional = $_POST['numProfissional'];
	
	include("../../_conexao/conexao_login.php");
			
	$sql_code = "UPDATE profissional SET cep = '$cep_profissional', cidade = '$cidade_profissional', uf = '$uf_profissional', bairro = '$bairro_profissional', rua = '$rua_profissional', num = '$n_profissional' WHERE profissional.id_profissional = '$id_profissional'";
	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
	
	$_SESSION['cep'] = $cep_profissional;
	$_SESSION['cidade'] = $cidade_profissional;
	$_SESSION['uf'] = $uf_profissional;
	$_SESSION['bairro'] = $bairro_profissional;
	$_SESSION['rua'] = $rua_profissional;
	$_SESSION['num'] = $n_profissional;
	
	echo "<script>";
	echo 	"window.location.replace('configuracoes.php');";
	echo "</script>";
			
?>