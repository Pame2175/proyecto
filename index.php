<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Sistema de Denuncia</title>
    <link rel="stylesheet" href="estilo/estilo.css">
</head>
<body background="../salir.jpg">
    <form action="" method="POST">
        <h2>Ingresar al sistema</h2>
        <input type="text" name="denunciante_cod" placeholder="Ej:52452" required>
        <input type="password" name="clave" placeholder="Ej: 4512585HGJKKL" required>
        <?php include 'sistema/login_usuario.php'?>
       
       <input type="submit" name="login" value="Guardar Usuario" class="btn btn-primary">
        <br>
        <div id="user">
            <b><a href="admin.php"></a></b>
            
        </div>
        <div id="">
            <style>
                .btnregistrarse{
                   width: 60%;
                   background: #27ff00;
                    color: #1a1314;
                    border-radius: 20px;
                    text-decoration: none;
                }
            </style>
            <a class="btnregistrarse" href="sistema/registro_usuario.php">Registrarse</a>
            
        </div>


    </form>
</body>
</html>
