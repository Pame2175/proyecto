<?php
	include '../conexion.php';
	#RECIBIR ARCHIVOS MULTIMEDIA
#-----------------------------------------------------------
	if(isset($_POST["nombre_denunciante"]) && isset($_POST["celular"]) && isset($_POST["direccion"]) && isset($_POST["denunciante_cod"]) &&  isset($_POST["estados"]) && isset($_POST["tituloProducto"]) && isset($_POST["multimedia"])){

		$sql =  $conection->query("INSERT INTO lista_denuncia(nombre_denunciante,celular,cedula,direccion,denunciante_cod,id_estado,titulo,imagenes) VALUES('".$_POST["nombre_denunciante"]."','".$_POST["celular"]."','".$_POST["cedula"]."','".$_POST["direccion"]."','".$_POST["denunciante_cod"]."','".$_POST["estados"]."','".$_POST["tituloProducto"]."','".$_POST["multimedia"]."') ");

		if ($sql) {
			echo "ok";
		}else{	
			echo "error";
		}


	}


