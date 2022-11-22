<?php
	session_start();
	require 'conexion.php';
	
	if(ISSET($_POST['login'])){
		$denunciante_cod= $_POST['denunciante_cod'];
		$clave= md5($_POST['clave']);
		
		$query = mysqli_query($conection, "SELECT * FROM denunciante WHERE denunciante_cod = '$denunciante_cod' && clave = '$clave'") or die(mysqli_error());
		$fetch = mysqli_fetch_array($query);
		$row = $query->num_rows;
		if($row > 0){
		if($fetch['id_rol']==1){
		$_SESSION['denunciante'] = $fetch['denunciante_id'];
		header("location:adminitrador/index_admin.php");
		}

		if($fetch['id_rol']==2){
		$_SESSION['denunciante'] = $fetch['denunciante_id'];
		header("location:sistema/index.php");
	}
		}else{
			echo "<center><label class='text-danger'>Usuario o Contraseña Inconrecta</label></center>";
		}
	}
?>
