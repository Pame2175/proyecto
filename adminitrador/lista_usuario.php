<?php 
	session_start();
	include "../conexion.php";	

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="js/jquery-3.5.1.js"></script>
	<script src=""></script>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de denuncias</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1>Lista de reportes realizados</h1>
		
		
		<div class="containerTable">
		<table>
			<thead>
			<tr>
				<th>cod_denunciante</th>
				<th>Nombre</th>	
				<th>Apellido</th>
				
				<th>Rol</th>
				
				<th></th>
			</tr>
		</thead>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM lista_denuncia ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 2;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);
			$consulta= mysqli_query($conection,"SELECT * FROM denunciante WHERE denunciante_id='$_SESSION[denunciante]'") or die(mysqli_error());
			$fetch = mysqli_fetch_array($consulta);
			$denunciante_cod = $fetch['denunciante_cod'];
			$query = mysqli_query($conection, "SELECT r.denunciante_cod, r.nombre , r.apellido, re.rol
			FROM denunciante r
			INNER JOIN roles re ON  r.id_rol = re.id_rol;") or die(mysqli_error());
			while($fetch = mysqli_fetch_array($query)){
					
			?>
				<tbody>
				<tr>
					<td><?php echo $fetch["denunciante_cod"]; ?></td>
					<td><?php echo $fetch["nombre"]; ?></td>
					<td><?php echo $fetch["apellido"]; ?></td>
					
				
					<td><?php echo $fetch["rol"]; ?></td>
					
		
					<td>
						<a class="link_edit" href="editar_usuario.php?id=<?php echo $data["idusuario"]; ?>"></a> 
						
					</td>
				</tr>
			</tbody>
		<?php 
				

			}
		 ?>


		</table>
		</div>
		
		


	</section>
	<?php include "includes/footer.php"; ?>
</body>