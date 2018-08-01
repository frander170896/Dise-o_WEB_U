<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de Sessión</title>
</head>
<body>
    <?php session_start(); ?>
    <h1>Inicio de Sesión</h1>

     <form action="Controlador/inicioSesion.php" method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required></input><br>
        <label>Contraseña:</label><br>
        <input type="password" name="clave" required></input><br><br>
        <input type="hidden" name="form" value="1">

        <input type="submit" value="Iniciar Sesión">
     </form>

     <?php if(isset($_SESSION['respuesta'])){echo "<br>". $_SESSION['respuesta']."<br>";}?>
     <br>
     <a href="registro.php">Registrarse</a>
     <?php session_destroy(); ?>
</body>
</html>