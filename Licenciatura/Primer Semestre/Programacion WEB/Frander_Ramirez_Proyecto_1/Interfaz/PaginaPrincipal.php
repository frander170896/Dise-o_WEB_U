<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />    
    <title>Pagina Principal</title>
</head>
<body>
    <main class="container">
            <?php 
                session_start();
                if(isset($_SESSION['user'])){
                    
                    include_once('../Controlador/administrador.php');
                    include_once('../Controlador/inicioSesion.php');
                    $cont = new administrador();
                    $lista = $cont->ObtenerDatosSubidos();
                   
                    $compartidos = $cont->obtenerCompartidos();
                    if(isset($_POST['actualizar'])){
                        $datos = $_POST['actualizar'];
                        $array = explode(",",$datos);       
                    }else if(isset($_POST['Compartir'])){
                        $datos = $_POST['Compartir'];
                        $datos = explode(",",$datos);  

                        $cont = new inicioSesion();
                        $usuarios = $cont->obtenerRegistros();
                    }
            ?>
            <h1>Bienvenido: <?php echo $_SESSION['user'] ?></h1>
            <div class="botonflotante">
                <form action="../Controlador/cerrarSesion.php" method="POST">
                    <input type="hidden" name="cerrar" value="1">
                    <input type="submit" class="centrarBoton" value="Cerrar Sesión">
                </form>
            </div>
            
            <article class="articulo formArchivo">
                <h2>Adjuntar Archivos</h2>
                <form enctype="multipart/form-data" action="../Controlador/administrador.php" method="POST">
                    <table>
                        <tr>
                            <td><label>Autor: </label></td>
                            <td><input type="text" name="autor" required></td>
                        </tr>
                        <tr>
                            <td><label>Clasificación: </label></td>
                            <td><input type="text" name="clasificacion" required></td>
                        </tr>
                        <tr>
                            <td><label>Descripción: </label></td>
                            <td><textarea name="descripcion" cols="30" rows="5" required></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="file" name="excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  required></td>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="form" value="1" /> </td>
                            <td><input type="submit" value="Subir"></td>
                        </tr>
                    </table>
                </form>
                <?php if(isset($_SESSION['respuesta'])){echo  $_SESSION['respuesta'];}?>
            
            </article>
            <article class="articulo">
                <?php if(isset($compartidos)){?>
                    <h2>Archivos Compartidos</h2>
                    <section class="scroll">
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Enviado por</th>
                                    <th>Nombre del Archivo</th>
                                    <th>Descargar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($compartidos as $key => $value) {?>
                                <tr>
                                    <td><?php echo $value['emisor'] ?></td>
                                    <td><?php echo $value['archivo'] ?></td>
                                    <td><a href="<?php echo "../Almacenamiento/" .$value['emisor']."/".$value['archivo']; ?>" target="_blank"><input type="button" value="Descargar"></a></td>
                                </tr>
                                <?php  } ?>
                            </tbody>
                        
                        </table>
                        <?php }else{?>
                            <h1>No se han recibido archivos</h1>
                        <?php  } ?>
                    </section>
            </article>
            <article class="tablaArchivos">
            <h2>Archivos Subidos</h2>
                <section class="scroll">
                    <?php if(isset($lista) ){ ?>
                            
                            <table border="1" class="contenido">
                                <thead>
                                    <tr>
                                        <th>Autor</th>
                                        <th>Clasificación</th>
                                        <th>Descripción</th>
                                        <th>Fecha Creación</th>
                                        <th>Tamaño</th>
                                        <th>Imagen</th>
                                        <th>Descargar</th>
                                        <th>Compartir</th>
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
                                            <td> 
                                                <form method="POST" action="PaginaPrincipal.php">
                                                    <input type="hidden" name="Compartir" value="<?php echo $value[1].','.$value[0]?>"></input>
                                                    <input type="submit" value="Compartir"></input>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="POST" action="PaginaPrincipal.php">
                                                    <input type="hidden" name="actualizar" value="<?php echo $value[1].','.$value[4].','.$value[5].','.$value[2].','.$value[3].','.$value[0].','.$con ?>"></input>
                                                    <input type="submit" value="Actualizar"></input>
                                                </form>
                                            </td>
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
                        <?php }else{ ?>
                                <h1>No hay Datos Subidos</h1>
                        <?php } ?>
                </section>
                    
            </article>
            
    
             <article class="articulo formArchivo">

                <?php if(isset($array)){ ?>
                
                    <h2>Actualizar Archivos</h2>
                    <form enctype="multipart/form-data" action="../Controlador/administrador.php" method="POST">
                        <table>
                            <tr>
                                <td><label>Autor: </label></td>
                                <td><input type="text" value="<?php echo $array[0] ?>" placeholder="<?php echo $array[0]?>" name="autor" required></td>
                            </tr>
                            <tr>
                                <td><label>Clasificación: </label></td>
                                <td> <input type="text" value="<?php echo $array[1] ?>" placeholder="<?php echo $array[1]?>" name="clasificacion" required></td>
                            </tr>
                            <tr>
                                <td><label>Fecha Creación: </label></td>
                                <td><input type="date" value="<?php echo $array[3] ?>" placeholder="<?php echo $array[3]?>" name="fecha" required></td>
                            </tr>
                            <tr>
                                <td><label>Descripción: </label></td>
                                <td><textarea name="descripcion" value="<?php echo $array[2]?>" placeholder="<?php echo $array[2]?>" cols="30" rows="5" required></textarea></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td> <input type="file" name="excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"></input></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit"  value="Actualizar"></td>
                            </tr>
                        </table>
                        <input type="hidden" name="anterior" value="<?php echo $array[5]?>" />
                        <input type="hidden" name="form" value="2" />
                        <input type="hidden" name="id" value="<?php echo $array[6]?>" />
                       
                        
                    </form>
            <?php } ?>
            </article>   
            <article class="articulo formArchivo">
                <?php if(isset($usuarios)){?>
                        <h2>Compartir Archivo</h2>
                            <form action="../Controlador/administrador.php" method="POST">
                                <table>
                                    <tr>
                                        <td><label for="archivo">Archivo:</label></td>
                                        <td><input type="text" name="nombre_archivo" value="<?php echo $datos[1]?>" ></td>
                                    </tr>
                                    <tr>
                                        <td><label for="receptor">Compartir a:</label></td>
                                        <td>
                                            <select name="receptor">
                                                <?php foreach ($usuarios as $key => $value) {
                                                    if($value['nombre'] != $_SESSION['user'] ){
                                                ?>
                                                <option value="<?php echo $value['nombre'] ?>"><?php echo $value['nombre'] ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" value="Enviar"></td>
                                    </tr>
                                </table>
                                <input type="hidden" name="emisor" value="<?php echo $_SESSION['user']?>"/>
                                <input type="hidden" name="form" value="4" />
                                
                            </form>
                        
                    <?php } ?>
            </article>   
           
           
        <?php }else{?>
            <h1>Para hacer uso del sistema debes iniciar sesión</h1>
            <a href="../index.php">Ir al Inicio de Sesión</a>
        <?php } ?>
    
    </main>
</body>
</html>