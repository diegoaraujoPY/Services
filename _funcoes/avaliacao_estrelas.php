<?php

	function exibirAvaliacao($qualidade){
		
		if($qualidade==1){
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
		} else if ($qualidade>1 AND $qualidade<2){
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='meio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
		} else if ($qualidade==2){
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
		} else if ($qualidade>2 AND $qualidade<3){
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='meio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
		} else if ($qualidade==3){
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
		} else if ($qualidade>3 AND $qualidade<4){
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='meio'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
		} else if ($qualidade==4){
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='vazio'></i>";
		} else if ($qualidade>4 AND $qualidade<5){
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='meio'></i>";
		} else if ($qualidade==5){
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
			echo 	"<i class='fa' id='full'></i>";
		}
		
	}

	function editarAvaliacao($editar_qualidade){
		
		if($editar_qualidade==1){
			echo		"<label for='estrela_um'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_um' name='estrela' value='1' checked>";
						
			echo		"<label for='estrela_dois'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_dois' name='estrela' value='2'>";
						
			echo		"<label for='estrela_tres'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_tres' name='estrela' value='3'>";
						
			echo		"<label for='estrela_quatro'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_quatro' name='estrela' value='4'>";
						
			echo		"<label for='estrela_cinco'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_cinco' name='estrela' value='5'>";
			
		} else if ($editar_qualidade==2){
			echo		"<label for='estrela_um'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_um' name='estrela' value='1'>";
						
			echo		"<label for='estrela_dois'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_dois' name='estrela' value='2' checked>";
						
			echo		"<label for='estrela_tres'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_tres' name='estrela' value='3'>";
						
			echo		"<label for='estrela_quatro'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_quatro' name='estrela' value='4'>";
						
			echo		"<label for='estrela_cinco'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_cinco' name='estrela' value='5'>";
			
		} else if ($editar_qualidade==3){
			echo		"<label for='estrela_um'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_um' name='estrela' value='1'>";
						
			echo		"<label for='estrela_dois'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_dois' name='estrela' value='2'>";
						
			echo		"<label for='estrela_tres'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_tres' name='estrela' value='3' checked>";
						
			echo		"<label for='estrela_quatro'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_quatro' name='estrela' value='4'>";
						
			echo		"<label for='estrela_cinco'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_cinco' name='estrela' value='5'>";
			
		} else if ($editar_qualidade==4){
			echo		"<label for='estrela_um'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_um' name='estrela' value='1'>";
						
			echo		"<label for='estrela_dois'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_dois' name='estrela' value='2'>";
						
			echo		"<label for='estrela_tres'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_tres' name='estrela' value='3'>";
						
			echo		"<label for='estrela_quatro'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_quatro' name='estrela' value='4' checked>";
						
			echo		"<label for='estrela_cinco'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_cinco' name='estrela' value='5'>";
			
		} else if ($editar_qualidade==5){
			echo		"<label for='estrela_um'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_um' name='estrela' value='1'>";
						
			echo		"<label for='estrela_dois'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_dois' name='estrela' value='2'>";
						
			echo		"<label for='estrela_tres'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_tres' name='estrela' value='3'>";
						
			echo		"<label for='estrela_quatro'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_quatro' name='estrela' value='4'>";
						
			echo		"<label for='estrela_cinco'><i class='fa'></i></label>";
			echo		"<input type='radio' id='estrela_cinco' name='estrela' value='5' checked>";
			
		}
		
	}

?>