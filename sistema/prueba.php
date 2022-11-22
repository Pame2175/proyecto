<?php 
session_start();
include "../conexion.php";
if(!ISSET($_SESSION['denunciante'])){
        header('location:../');
    }
  if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre_denunciante']) || empty($_POST['celular']) || empty($_POST['cedula']) || empty($_POST['foto']) || empty($_POST['denunciante_cod'])  ) {
      $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {
  





$nombre_denunciante = $_POST['nombre_denunciante'];
$celular = $_POST['celular'];
$cedula = $_POST['cedula'];
$foto = $_POST['foto'];
$denunciante_cod = $_POST['denunciante_cod'];
$fecha=$_POST['fecha'];
$estados = $_POST['estados'];

$sql =  "INSERT INTO lista_denuncia (nombre_denunciante,celular,cedula_numero,evidencia,denunciante_cod,fecha,id_estado) VALUES('$nombre_denunciante','$celular','$cedula','$foto','$denunciante_cod','$fecha','$estados')";
$query= mysqli_query($conection,$sql);// para insertar los dtos 

if ($query) {
        $alert = '<div class="alert alert-primary" role="alert">
                Reporte enviado 
              </div>';
              
                    } else {
        $alert = '<div class="alert alert-danger" role="alert">
                Error al enviar reporte]
              </div>';
               }
      }
      }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/jquery-3.5.1.js"></script>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Sistema de Denuncia</title>
    <?php include "includes/header.php"; ?>
    <link href="../sistema/css/estilos_formulario.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="">
         <?php
      date_default_timezone_set('America/Mexico_city');
      $fecha=date("Y-m-d H:i:s");
     
    
     
?>

        <form class="enviar" method="post" action="" autocomplete="off">
 <h4>Formulario</h4>
                <?php echo isset($alert) ? $alert : ''; ?>
                
                <div class="form-group">
                    <label for="nombre_denunciante">Nombre del denunciante</label>
                    <input type="text" placeholder="Ej: lucas" name="nombre_denunciante" class="form-control" 
                    value="" required="" >
                </div>
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="number"  placeholder="Ej: 2584578" name="celular"class="form-control" value="" required="" >
                </div>
                <div class="form-group">
                    <label for="cedula">Cedula de identidad</label>
                    <input type="number"  placeholder="Ej: 2584578" name="cedula"class="form-control" value="" required="" >
                </div>
                 <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="text"  placeholder="Ej: 2584578" name="foto" class="form-control" value="" required="" >
                </div>
                <div class="form-group">
                    
                    <input type="hidden" placeholder="Ej: Los dueños lo maltratan" name="denunciante_cod" value="<?php echo $fetch['denunciante_cod'];?>" required="" >
                </div>
                 <div class="form-group">
                      <label for="foto">Fecha lo ocurrido</label>
                    <input type="date" placeholder="Ej: Los dueños lo maltratan" name="fecha" value="<?php $fecha?>" >
                </div>
               
               <div class="form-group">
           <label>Estado del reporte</label>
           <?php
            $query_estados = mysqli_query($conection, "SELECT id_estado, nombre FROM estados ");
            $resultado_estados= mysqli_num_rows($query_estados);
             mysqli_close($conection);
            ?>
           <select  disabled="" id="estados" name="estados" class="form-control" required="">
             <?php
              if ($resultado_estados > 0) {
                while ($estados= mysqli_fetch_array($query_estados)) {
                  // code...
              ?>
                 <option value="<?php echo $estados['id_estado']; ?>"><?php echo $estados['nombre']; ?></option>
             <?php
                }
              }
              ?>
           </select>
           
         </div>

                <div>
                
                  <label></label>
                <button class="boton" type="submit" value="button" >Registrar</button>
               
                </div>
          

            </form>
      </div>   
    
</body>
</html>