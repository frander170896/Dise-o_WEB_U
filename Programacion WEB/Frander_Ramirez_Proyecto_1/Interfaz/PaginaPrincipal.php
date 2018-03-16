<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina Principal</title>
</head>
<body>
<?php 
    session_start();
    include_once('../Controlador/administrador.php');
    $cont = new administrador();
    $lista = $cont->ObtenerDatosSubidos();
    if(isset($_POST['actualizar'])){
        $datos = $_POST['actualizar'];
        $array = explode(",",$datos);       
    }
?>
        <h1>Bienvenido: <?php echo $_SESSION['user'] ?></h1>

        <h2>Adjuntar Archivos</h2>
        <form enctype="multipart/form-data" action="../Controlador/administrador.php" method="POST">
            <label>Autor: </label>
            <input type="text" name="autor" required> <br><br>
            <label>Clasificación: </label>
            <input type="text" name="clasificacion" required> <br>
            <br>
            <label>Descripción: </label><br>
            <textarea name="descripcion" cols="30" rows="5" required></textarea><br><br>

            <input type="hidden" name="form" value="1" />
            <input type="file" name="excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  required><br><br>
            <input type="submit" value="Subir">
        </form>

        <?php if(isset($_SESSION['respuesta'])){echo "<br>". $_SESSION['respuesta']."<br>";}?>
        <br>
        <br>

        <table border="1">
            <thead>
                <tr>
                    <th>Autor</th>
                    <th>Clasificación</th>
                    <th>Descripción</th>
                    <th>Fecha Creación</th>
                    <th>Tamaño</th>
                    <th>Imagen</th>
                    <th>Descargar</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                 $con = 0;
                foreach ($lista as $value) {
                    if($value[7] == 0){
                ?>
                    <tr>
                        <td><?php echo $value[1] ?></td>
                        <td><?php echo $value[4] ?></td>
                        <td><?php echo $value[5] ?></td>
                        <td><?php echo $value[2] ?></td>
                        <td><?php echo $value[3] ?></td>
                        <td><?php echo $value[0] ?></td>

                        <td><a href="<?php echo "../Almacenamiento/" . $_SESSION['user'] ."/". $value[0]; ?>" target="_blank"><input type="button" value="Descargar"></a></td>
                        <form method="POST" action="PaginaPrincipal.php">
                            <input type="hidden" name="actualizar" value="<?php echo $value[1].','.$value[4].','.$value[5].','.$value[2].','.$value[3].','.$value[0].','.$con ?>"></input>
                            <td><input type="submit" value="Actualizar"></input></td>
                        </form>
                        <td>
                        <form method="POST" action="../Controlador/administrador.php">
                             <input type="hidden" name="form" value="3" />
                             <input type="hidden" name="eliminar" value="<?php echo $con.','.$value[0]?>"></input>
                             <input type="submit" value="Eliminar">
                        </form>
                        
                        </td>
                    </tr>

                    <?php } $con++; } ?>
            </tbody>
        </table>
        <br>
        <br>
        <form action="../Controlador/cerrarSesion.php" method="POST">
            <input type="hidden" name="cerrar" value="1">
            <input type="submit" value="Cerrar Sesión">
        </form>

        <?php if(isset($array)){ ?>
        
            <h2>Actualizar Archivos</h2>
            <form enctype="multipart/form-data" action="../Controlador/administrador.php" method="POST">
                <label>Autor: </label>
                <input type="text" value="<?php echo $array[0] ?>" placeholder="<?php echo $array[0]?>" name="autor" required> <br><br>
                <label>Clasificación: </label>
                <input type="text" value="<?php echo $array[1] ?>" placeholder="<?php echo $array[1]?>" name="clasificacion" required> <br>
                <br>
                <label>Fecha Creación: </label>
                <input type="date" value="<?php echo $array[3] ?>" placeholder="<?php echo $array[3]?>" name="fecha" required> <br>

                <label>Descripción: </label><br>
                <textarea name="descripcion" value="<?php echo $array[2]?>" placeholder="<?php echo $array[2]?>" cols="30" rows="5" required></textarea><br><br>
                <input type="hidden" name="anterior" value="<?php echo $array[5]?>" />
                <input type="hidden" name="form" value="2" />
                <input type="hidden" name="id" value="<?php echo $array[6]?>" />
                <input type="file" name="excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"></input>
                <br><br>
                
                <input type="submit"  value="Actualizar">
                
            </form>
        <br>
        <br> 
        <?php } ?>
</body>
</html>