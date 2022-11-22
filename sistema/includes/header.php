
	<?php 
	if(empty($_SESSION['denunciante']))
	{
		header('location: ../');
	}
	
 ?>
	<header>
		<script src="js/jquery-3.5.1.js"></script>
		<div class="header">
			<a href="" class="btnMenu"><i class="fas fa-bars"></i></a>
			<h1>Sistema de Denuncia</h1>
			<div class="optionsBar">
				<?php
				include '../conexion.php'; 
				$consulta= mysqli_query($conection, "SELECT * FROM denunciante WHERE denunciante_id='$_SESSION[denunciante]'");
				$row = $consulta->num_rows;
				if($row > 0){
		        $fetch = mysqli_fetch_array($consulta);
		        $_SESSION['nombre']= $fetch['nombre'];
		    }
		        ?>
				<span class="user">Bienvenido <?php echo $_SESSION['nombre']?></span>
				
				<!--<a href="cerrar_session.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>-->
			</div>
		</div>
		<?php include "nav.php"; ?>
	</header>