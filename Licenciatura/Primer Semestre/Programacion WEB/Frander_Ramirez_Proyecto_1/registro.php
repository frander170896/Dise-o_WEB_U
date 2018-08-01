<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarse</title>
</head>
<body>
    <?php session_start(); ?>
    <h1>Registrarse</h1>

     <form action="Controlador/inicioSesion.php" method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required></input><br>
        <label>Contraseña:</label><br>
        <input type="password" name="clave" required></input><br><br>
        <input type="hidden" name="form" value="2">

        <input type="submit" value="Registrarse">
     </form>
     
     <?php if(isset($_SESSION['respuesta'])){echo "<br>". $_SESSION['respuesta']."<br>";}?>
     <br>
     <a href="index.php">Regresar</a>
     <?php session_destroy(); ?>
</body>
</html>