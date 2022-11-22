<?php 

include "../conexion.php";

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['denunciante_cod']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['clave']) ) {
        $alert = '<div class="alert alert-primary" role="alert">
                    Todo los campos son obligatorios
                </div>';
    } else {

        $denunciante_cod = $_POST['denunciante_cod'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $clave = md5($_POST['clave']);
        

        $query = mysqli_query($conection, "SELECT * FROM denunciante where denunciante_cod= '$denunciante_cod'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                        El numero de cedula ingresado ya esta registrado
                    </div>';
        } else {
            $query_insert = mysqli_query($conection, "INSERT INTO denunciante(denunciante_cod,nombre,apellido,clave,id_rol) values ('$denunciante_cod', '$nombre', '$apellido', '$clave', '2')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                            Usuario registrado
                        </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar
                    </div>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Sistema de Denuncia</title>
   <link rel="stylesheet" href="../estilo/estilo.css">
</head>
<body>
    <form action="" method="POST">
           <?php echo isset($alert) ? $alert : ''; ?>
        <h2>Registrarse</h2>
        <label>Numero de documento</label>
        <input type="number" name="denunciante_cod" placeholder="Ej:52452" required>
        <label>Nombre</label>
        <input type="text" name="nombre" placeholder="Ej:Lorena" required>
        <label>Apellido</label>
        <input type="text" name="apellido" placeholder="Ej:Lopez" required>
        <label>Contraseña</label>
        <input type="password" name="clave" placeholder="Ej: 4512585HGJKKL" required>
        

     
        <input type="submit" value="Guardar Usuario" class="btn btn-primary">
   
            
        </div>
        <div id="">
            <b><a class="" href="index.php">Ingresar al sistema</a></b>
            
        </div>


    </form>
</body>
</html>

