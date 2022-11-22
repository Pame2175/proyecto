<?php
require '../conexion.php';


$denunciante_cod= $_POST['denunciante_cod'];
$nombre= $_POST['nombre'];
$apellido= $_POST['apellido'];
$clave=md5( $_POST['clave']);

        


$sql_insert=  "INSERT INTO denunciante (denunciante_cod,nombre,apellido,clave,id_rol) VALUES('$denunciante_cod','$nombre','$apellido','$clave','2')";
$query= mysqli_query($conection,$sql_insert);// para insertar los dtos 

if ($query) {
        $alert = '<div class="alert alert-primary" role="alert">
                Registrado
              </div>';
              
                    } else {
        $alert = '<div class="alert alert-danger" role="alert">
                Error al registrarse
              </div>';
      }
?>