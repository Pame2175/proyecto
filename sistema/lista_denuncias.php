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
<link rel="stylesheet" href="files/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<title>Lista de denuncias</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1>Mis listas de denuncia</h1>
		
		<!--<form action="" method="" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>-->
		<div class="containerTable">
		<table>
			<thead>
			<tr>
				<th>cod de  denuncia</th>
				<th>Nombre denunciante</th>	
				<th>celular</th>
				<th>cedula</th>
				<th>Direccion</th>
				<th>Foto</th>
				<th>Codigo denunciante</th>
				<th>Detalles</th>
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





			$query = mysqli_query($conection, "SELECT * FROM lista_denuncia WHERE denunciante_cod = '$denunciante_cod' ORDER BY lista_denuncia_id ASC LIMIT $desde,$por_pagina") or die(mysqli_error());
			while($fetch = mysqli_fetch_array($query)){
			$multimedia=json_decode($fetch['imagenes'],true);
			foreach ($multimedia as $value) {
						//var_dump($value['foto']); imprimir en json

						
			?>
				<tbody>
				<tr>
					<td><?php echo $fetch["lista_denuncia_id"];?></td>
					<td><?php echo $fetch["nombre_denunciante"];?></td>
					<td><?php echo $fetch["celular"];?></td>
					<td><?php echo $fetch["cedula"];?></td>
					<td><?php echo $fetch["direccion"];?></td>
					
					<td><?php echo $value["foto"];?></td>
					<td><?php echo $fetch["denunciante_cod"];?></td>
					
		
					<td>
						<button type="button" class="btn btn-primary mostrar" id="mostrar" data-toggle="modal" data-target="#exampleModal">
  					Detalle
				</button>
						
					</td>
				</tr>
			</tbody>
		<?php 
				
}
			}
		 ?>


		</table>
		<!-- Button trigger modal -->

<style>
	.imagen{
		width: 500px;
		height: 200px;
	}
</style>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" class="imagen" name="imagen" id="imagen">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
       
      </div>
    </div>
  </div>
</div>

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
<script src="files/bower_components/jquery/dist/jquery.min.js"></script>
<script src="files/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
var foto;
$(document).on("click", ".mostrar", function(){
foto = $(this).closest("tr");
imagen=foto.find('td:eq(5)').text();

$("#imagen").attr("src", imagen);
$("#exampleModal").modal("show");

});
</script>