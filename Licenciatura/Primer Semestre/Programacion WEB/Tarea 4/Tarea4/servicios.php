<?php

include 'db_conection.php';

function selectfactura() {
    $cadena = '';
    try {
        $file_db = obtenerconexion();
        $result = $file_db->query('SELECT * FROM factura');

        foreach ($result as $row) {
            
            $cadena .= '<tr>';
            $cadena .= "<form action='index.php' method='POST'>";
            $cadena .= '<td> <input type="number" name="numerom" value="' . $row['numero'] . '"></td>';
            $cadena .= '<td> <input type="text"  name="clientem" value="' . $row['cliente'] . '"></td>';
            $cadena .= '<td> <input type="date" name="fecham" value="' . $row['fecha'] . '"></td>';
            $cadena .= '<td> <input type="number" name="impuestosm" value="' . $row['impuestos'] . '"></td>';
            $cadena .= '<td> <input type="number" name="montototalm" value="' . $row['montototal'] . '"></td>';
            $cadena .= '<td class="productos_asig" tabindex="1" size="3" style="width:100px;">' . selectdescripcionProducto2($row['numero']) . '</td>';
            //$cadena .= '<td>' . selectdescripcionProducto() . '</td>';
            $cadena .= '<td> <input type="hidden" name="metodo" value="modificarfactura" />'
                    . '<button type="submit" name="submit"><img src="">Actualizar</button></td>';
            $cadena .= '</form>';

            $cadena .= "<form action='index.php' method='POST'>";
            $cadena .= '<td> <input type="hidden" name="metodo" value="eliminarfactura" />';
            $cadena .= '<input type="hidden" name="numeroe" value="' . $row['numero'] . '">';
            $cadena .= '<button type="submit" name="submit"><img src="">Borrar</button></td>';
            $cadena .= '</form>';
            $cadena .= "<form action='index.php' method='POST'>";
            $cadena .= '<td> <input type="hidden" name="metodo" value="verproductos" />';
            $cadena .= '<input type="hidden" name="numerov" value="' . $row['numero'] . '">';
            $cadena .= '<button type="submit" name="submit"><img src="">Ver Productos</button></td>';
            $cadena .= '</form>';


            $cadena .= '</tr>';
        }
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
    return $cadena;
}

function selectproducto() {
    $cadena = '';
    try {
        $file_db = obtenerconexion();
        $result = $file_db->query('SELECT * FROM producto where factura<>0');

        foreach ($result as $row) {
            $cadena .= '<tr>';
            $cadena .= "<form action='index.php' method='POST'>";
            $cadena .= '<td> <input type="number" name="cantidad" value="' . $row['cantidad'] . '"></td>';
            $cadena .= '<td> <input type="text"  name="descripcion" value="' . $row['descripcion'] . '"></td>';
            $cadena .= '<td> <input type="number" name="valoru" value="' . $row['valorunitario'] . '"></td>';
            $cadena .= '<td> <input type="number" name="impuestos" value="' . $row['subtotal'] . '"></td>';
           
//            $cadena .= '<td> <input type="hidden" name="metodo" value="modificarproducto" />'
//                    . '<button type="submit" name="submit"><img src="">Actualizar</button></td>';
//            $cadena .= '</form>';

//            $cadena .= "<form action='index.php' method='POST'>";
            $cadena .= '<td> <input type="hidden" name="metodo" value="eliminarproducto" />';
            $cadena .= '<input type="hidden" name="numeroe" value="' . $row['descripcion'] . '">';
            $cadena .= '<button type="submit" name="submit"><img src="">Borrar</button></td>';
            $cadena .= '</form>';
//            $cadena .= "<form action='index.php' method='POST'>";
//            $cadena .= '<td> <input type="hidden" name="metodo" value="verproductos" />';
//            $cadena .= '<input type="hidden" name="numerov" value="' . $row['descripcion'] . '">';
//            $cadena .= '<button type="submit" name="submit"><img src="">Ver Productos</button></td>';
//            $cadena .= '</form>';


            $cadena .= '</tr>';
        }
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
    return $cadena;
}

function selectproducto2($factura) {
    $cadena = '';
    try {
        $file_db = obtenerconexion();
        $result = $file_db->query('SELECT * FROM producto where factura='.$factura.'  group by descripcion;');

        foreach ($result as $row) {
            $cadena .= '<tr>';
            $cadena .= "<form action='index.php' method='POST'>";
            $cadena .= '<td> <input type="number" name="cantidad" value="' . $row['cantidad'] . '"></td>';
            $cadena .= '<td> <input type="text"  name="descripcion" value="' . $row['descripcion'] . '"></td>';
            $cadena .= '<td> <input type="number" name="valoru" value="' . $row['valorunitario'] . '"></td>';
            $cadena .= '<td> <input type="number" name="impuestos" value="' . $row['subtotal'] . '"></td>';
           
//            $cadena .= '<td> <input type="hidden" name="metodo" value="modificarproducto" />'
//                    . '<button type="submit" name="submit"><img src="">Actualizar</button></td>';
//            $cadena .= '</form>';

//            $cadena .= "<form action='index.php' method='POST'>";
            $cadena .= '<td> <input type="hidden" name="metodo" value="eliminarproducto" />';
            $cadena .= '<input type="hidden" name="numeroe" value="' . $row['descripcion'] . '">';
            $cadena .= '<button type="submit" name="submit"><img src="">Borrar</button></td>';
            $cadena .= '</form>';
//            $cadena .= "<form action='index.php' method='POST'>";
//            $cadena .= '<td> <input type="hidden" name="metodo" value="verproductos" />';
//            $cadena .= '<input type="hidden" name="numerov" value="' . $row['descripcion'] . '">';
//            $cadena .= '<button type="submit" name="submit"><img src="">Ver Productos</button></td>';
//            $cadena .= '</form>';


            $cadena .= '</tr>';
        }
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
    return $cadena;
}
function selectdescripcionProducto() {

    $cadena = '';
    try {
        $file_db = obtenerconexion();
       $sql='SELECT descripcion FROM producto where factura=0';
        $result = $file_db->query($sql);
        $cadena .= '<select name="selectprods[]" multiple="multiple" tabindex="1" size="3" style="width:100px;">';
        foreach ($result as $row) {
            $cadena .= '<option value="' . $row['descripcion'] . '">' . $row['descripcion'] . '</option>';
        }
        $cadena .= '</select>';
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
    return $cadena;
}
function selectdescripcionProducto2($factura) {

    $cadena = '';
    try {
        $file_db = obtenerconexion();
        $sql='SELECT descripcion FROM producto where factura='.$factura.'';
        $result = $file_db->query($sql);
        
      $cadena .= '<select name="lectura[]" disabled="true" multiple="multiple" tabindex="1" size="3" style="width:100px;">';
        foreach ($result as $row) {
            $cadena .= '<option>' . $row['descripcion'] . '</option>';
        }
        $cadena .= '</select>';
        
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
    return $cadena;
}


function modificarfactura($data) {
    $numero = $data['numerom'];
    $fecha = $data['fecham'];
    $cliente = $data['clientem'];
    $impuestos = $data['impuestosm'];
    $montototal = $data['montototalm'];
    try {
        $file_db = obtenerconexion();
        // Prepare INSERT statement to SQLite3 file db
        $update = "UPDATE factura 
            SET cliente = :cliente, fecha = :fecha , montototal = :montototal, impuestos=:impuestos                         
                WHERE numero=:numero";

        $stmt = $file_db->prepare($update);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':impuestos', $impuestos);
        $stmt->bindParam(':montototal', $montototal);
        $stmt->execute();

        return 'Se ha actualizado la informacion!';
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
}

function actualizarrelacionfactura($factura, $producto, $cnx) {
    try {

        $update = "UPDATE producto 
            SET factura = :factura                         
                WHERE descripcion=:producto";

        $stmt = $cnx->prepare($update);
        $stmt->bindParam(':factura', $factura);
        $stmt->bindParam(':producto', $producto);
        $stmt->execute();

        return 'Se ha actualizado la informacion!';
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
}

