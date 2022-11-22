<?php 
	session_start();
	include "../conexion.php";	

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="js/jquery-3.5.1.js"></script>
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
				<th>cod de  denuncia</th>
				<th>Nombre denunciante</th>	
				<th>celular</th>
				<th>cedula</th>
				<th>Evidencia</th>
				<th>Numero de cedula</th>
				<th></th>
				<th>Estado</th>
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
			$query = mysqli_query($conection, "SELECT r.lista_denuncia_id , r.nombre_denunciante , r.celular, r.cedula, r.direccion, r.denunciante_cod, r.titulo,r.imagenes, re.nombre
				FROM lista_denuncia r
				INNER JOIN estados re ON  r.id_estado = re.id_estado") or die(mysqli_error());
			while($fetch = mysqli_fetch_array($query)){
					
			?>
				<tbody>
				<tr>
					<td><?php echo $fetch["lista_denuncia_id"]; ?></td>
					<td><?php echo $fetch["nombre_denunciante"]; ?></td>
					<td><?php echo $fetch["celular"]; ?></td>
					<td><?php echo $fetch["cedula"]; ?></td>
					<td><?php echo $fetch["imagenes"]; ?></td>
					<td><?php echo $fetch["denunciante_cod"]; ?></td>
					
					<td><?php echo $fetch["nombre"]; ?></td>
		
					<td>
						<a class="link_edit" href="editar_usuario.php?id=<?php echo $data["idusuario"]; ?>">Editar</a>
						
					</td>
				</tr>
			</tbody>
		<?php 
				

			}
		 ?>


		</table>
		</div>
		
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>