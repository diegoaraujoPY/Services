<?php
	if(!isset($_SESSION)){
		session_start();
	}
	$id_categoria = $_SESSION['id_categoria'];
	$servico_pesquisa = $_GET['service'];
	
	if($servico_pesquisa==''){
		$servico_pesquisa = "Padrão";
	}
	
	$regiao_filtro = $_GET['regiao'];
	$avaliacao_filtro = $_GET['avaliacao'];
	
	echo "<script>";
	echo 	"window.location.replace('categorias.php?id=$id_categoria&service=$servico_pesquisa&regiao=$regiao_filtro&avaliacao=$avaliacao_filtro');";;
	echo "</script>";

?>