<?php 
  session_start();
  include "../conexion.php";  
 include "includes/header.php";
 include "includes/scripts.php";
 ?>

<head>
  <!DOCTYPE html>
<html lang="en">
  <script src="js/jquery-3.5.1.js"></script>
  <meta charset="UTF-8">

  <title>Lista de denuncias</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="files/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="files/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="files/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Dropzone -->
  <link rel="stylesheet" href="files/plugins/dropzone/dropzone.css">


  <script src="files/bower_components/jquery/dist/jquery.min.js"></script>

  <script src="files/bower_components/jquery-ui/jquery-ui.min.js"></script>

  
  <script src="files/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



  
  <script src="files/plugins/sweetalert2/sweetalert2.all.js"></script>

 

  <script src="files/plugins/dropzone/dropzone.js"></script>
</head>

<body>
  
  <div class="input-group multimediaVirtual" style="display:none">
  <span class="input-group-addon"><i class="fa fa-youtube-play"></i></span> 
  <input type="text" class="form-control input-lg multimedia" placeholder="Ingresar código video youtube">
  </div>
  <div class="multimediaFisica">
  <label>Nombre del Denunciante</label>
  <input type="text" class="form-control input-lg nombre_denunciante"  placeholder="escribe su nombre y apellido">
  <label>Celular</label>
  <input type="number" class="form-control input-lg celular"  placeholder="escribe su numero de celular">
  <label>Cedula</label>
  <input type="number" class="form-control input-lg cedula"  placeholder="escribe su numero de cedula">
   <label>Direccion del hecho</label>
  <input type="text" class="form-control input-lg direccion"  placeholder="escribe su numero de direccion">
  <label></label>
  <input type="hidden" class="form-control input-lg denunciante_cod" value="<?php echo $fetch['denunciante_cod']?>" placeholder="escribe su numero de cedula">
  <div class="form-group">
           <label>Estado del reporte</label>
           <?php
            $query_estados = mysqli_query($conection, "SELECT id_estado, nombre FROM estados");
            $resultado_estados= mysqli_num_rows($query_estados);
             mysqli_close($conection);
            ?>
           <select disabled="" id="estados" name="estados" class="form-control estados" required="">
             <?php
              if ($resultado_estados > 0) {
                while ($estados= mysqli_fetch_array($query_estados)) {
                  
              ?>
                 <option value="<?php echo $estados['id_estado']; ?>"><?php echo $estados['nombre']; ?></option>
             <?php
                }
              }
              ?>
           </select>

  <label>Titulo de imagen</label>
  <input type="text" class="form-control input-lg validarProducto tituloProducto"  placeholder="escribe el titulo para la imagen">
  
  <div class="dz-message needsclick">
    Selecionar imagen
  </div>

</div>
<div>
<button type="button" class="btn btn-primary guardarProducto" >Enviar reporte</button>
</div>
</div>
</div>
</div>
</div>
<?php include "includes/footer.php"; ?>
</body>

<script src="js.js"></script>
