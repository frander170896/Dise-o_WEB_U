<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de contactos</title>
</head>
<body>
    <?php
        include_once('logica/logica.php');
        $logica = new logica();
        $lista = $logica->ObtenerEncabezadoContacto();
        print_r($lista);
    ?>
    <h1>Formulario</h1>
    <form action="logica/logica.php" method="POST">
        <input type="hidden" name="formulario" value="1">
        <label for="name">Nombre: </label><br>
        <input type="text" name="name"><br>
        <label for="name" >Trabajo: </label><br>
        <input type="text" name="work" ><br>
        <label for="name" >Teléfono: </label><br>
        <input type="tel"name="mobile"><br>
        <label for="name" >Correo: </label><br>
        <input type="email" name="email"><br>
        <label for="name">Dirección: </label><br>
        <textarea name="address"></textarea><br>

        <input type="submit" value="Guardar">
        
    </form>
    <h1>Todos los contactos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($lista as $value) {
                if($value->getState() != 1){?>
                    <tr>
                        <td><?php echo $value->getName() ?></td>
                        <?php if(isset($_SESSION["Mostrar"]) && $_SESSION["id_detalle"] ==  $_SESSION["id"] ){ ?>
                            <td><?php echo $_SESSION["work"] ?></td>
                            <td><?php echo $_SESSION["mobile"] ?></td>
                            <td><?php echo $_SESSION["email"] ?></td>
                            <td><?php echo $_SESSION["address"] ?></td>

                        <?php } ?>
                        
                        <form action="logica/logica.php" method="POST">
                            <input type="hidden" value="<?php echo $value->getId()?>">
                            <input type="hidden" name="formulario" value="2">
                            <td><input type="submit" value="Detalle"></td>
                        </form>
                        <form action="logica/logica.php" method="POST">
                            <input type="hidden" value="<?php echo $value->getId()?>">
                            <input type="hidden" name="formulario" value="3">
                            <td><input type="submit" value="Eliminar"></td>
                        </form>  
                    </tr>
            <?php }   
             } ?>
        </tbody>
    </table>
</body>
</html>