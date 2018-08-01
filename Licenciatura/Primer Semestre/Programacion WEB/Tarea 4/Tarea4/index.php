<?php
include 'servicios.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>TAREA 4</title>
        
    </head>
    <body>

        <header>
            <h1>Sistema de Facturación</h1>
        </header>

        <div>
            <?php
            $resultado = '';
            if ($data = $_POST) {
                switch ($data['metodo']) {
                    case "insertarfactura":
                        $resultado = insertarfactura($data);
                        break;
                    case "eliminarfactura":
                        $resultado = eliminarfactura($data);
                        break;

                    //modificarfactura
                    case "modificarfactura":
                        $resultado = modificarfactura($data);
                        break;
                    case "insertarproducto":
                        $resultado = insertarproducto($data);
                        break;
                    case "eliminarproducto":
                        $resultado = eliminarproducto($data);
                        break;
                    //

                    default:
                        break;
                }
            } else {
                //nothing here
            }
            ?>
            <table class="tprincipal">

                <thead>

                    <tr>
                        <th colspan="9">Facturas</th>
                    </tr>
                    <tr>
                        <td>Número</td>
                        <td>cliente</td>
                        <td>Fecha</td>
                        <td>Impuestos</td>
                        <td>Monto Total</td>
                        <td>Productos</td>
                        <td>Actualizar</td>
                        <td>Eliminar</td>
                        <td>Ver Productos</td>
                    </tr> 
                </thead>
                <tbody>    
                    <?php echo selectfactura(); ?>

                </tbody>
            </table>
            <table>
                <tr>
                    <th colspan="6">Nueva Factura</th>
                </tr>
                <th>Número</th>
                <th>cliente</th>
                <th>Fecha</th>
                <th>Productos</th>
                <th>Agregar</th>

                <tbody>

                    <tr>
                <form action='index.php' method='POST'>
                    <td>
                        <input type="number" name="numeroi" required="" placeholder="Numero" min="1">
                    </td>
                    <td>
                        <input type="text" name="clientei" required="" placeholder="Cliente">
                    </td>
                    <td>
                        <input type="date" name="fechai" required="" placeholder="Fecha">
                    </td>

                    <td>
                        <?php echo selectdescripcionProducto(); ?>
                    </td>
                    <td colspan="2"> <input type="hidden" name="metodo" value="insertarfactura" />
                        <button type="submit" name="submit"><img src="">Insertar</button>
                    </td>
                </form>
                </tr>
                </tbody>
            </table>
            <p>
                <?php
                if ($resultado !== '') {
                    echo 'Accion realizada correctamente!';
                }
                ?>
            </p>
        </div>
        <div>
            <table class="tprincipal">

                <thead>

                    <tr>
                        <th colspan="5">Productos</th>
                    </tr>
                    <tr>
                        <td>Cantidad</td>
                        <td>Descripcion</td>
                        <td>Valor (U)</td>                        
                        <td>Subtotal</td>
                        <td>Borrar</td>
                    </tr> 
                </thead>
                <tbody>  

                    <?php
                    if ($data = $_POST) {
                        switch ($data['metodo']) {
                            case "verproductos":
                                echo selectproducto2($data['numerov']);

                                break;
                            default :
                                break;
                        }
                    }
                    // echo selectproducto();
                    ?>
                    <tr>
                <form action='index.php' method='POST'>
                    <td>
                        <input type="number" name="cantidad" required="" placeholder="Cantidad" min="1">
                    </td>
                    <td>
                        <input type="text" name="descripcion" required="" placeholder="Descripcion">
                    </td>
                    <td>
                        <input type="number" name="valoru" required="" placeholder="Valor Unitario">
                    </td>
                    <td colspan="2"> <input type="hidden" name="metodo" value="insertarproducto" />
                        <button type="submit" name="submit"><img src="">Insertar</button>
                    </td>
                </form>
                </tr>
                </tbody>
            </table>

        </div>
        <footer>

        </footer>
    </body>
</html>




