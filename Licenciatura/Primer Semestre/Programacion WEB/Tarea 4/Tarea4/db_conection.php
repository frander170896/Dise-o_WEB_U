<?php

//http://sqlitebrowser.org/
// número, fecha, cliente, impuestos, y montototal
// Create (connect to) SQLite database in file

function obtenerconexion() {
    $file_db = new PDO('sqlite:base.db');
// Set errormode to exceptions
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $file_db;
}

function obtenersubtotal($factura) {
    $porcentaje = 0;
    try {
        $file_db = obtenerconexion();
        $statement = 'select sum(subtotal) subt from producto where factura=' . $factura . '';
        $result = $file_db->query($statement);
        foreach ($result as $row) {
            $porcentaje = $row['subt'];
        }
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
    return $porcentaje;
}

function insertarfactura($data) {
    $numero = $data['numeroi'];
    $fecha = $data['fechai'];
    $cliente = $data['clientei'];
    try {
        $file_db = obtenerconexion();
        if (isset($data['selectprods'])) {
            $vec = $data['selectprods'];
            foreach ($vec as $selectedOption) {
                actualizarrelacionfactura($numero, $selectedOption, $file_db);
            }
        }
        $impuestos = obtenersubtotal($numero) * 0.13;
        $montototal = obtenersubtotal($numero) *(100+ 0.13)/100;
        
        //Monto * (100 + porcentaje) / 100
        // Prepare INSERT statement to SQLite3 file db
        $insert = "INSERT INTO factura (numero, fecha, cliente,impuestos,montototal) 
                VALUES (:numero, :fecha, :cliente,:impuestos,:montototal)";
        $stmt = $file_db->prepare($insert);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':impuestos', $impuestos);
        $stmt->bindParam(':montototal', $montototal);
        $stmt->execute();
        return 'Se ha insertado la informacion!';
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
}

function eliminardependenciafactura($factura) {
    try {
        $file_db = obtenerconexion();
        // Prepare INSERT statement to SQLite3 file db
        $insert = "delete from producto where factura=:numero";
        $stmt = $file_db->prepare($insert);
        $stmt->bindParam(':numero', $factura);
        $stmt->execute();

        return 'Se ha eliminado el registro con el numero: ' . $factura;
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
}

function eliminarfactura($data) {
   // var_dump($data);
    $numero = $data['numeroe'];
    try {
        $file_db = obtenerconexion();
        // Prepare INSERT statement to SQLite3 file db
        $insert = "DELETE FROM factura WHERE NUMERO=:numero";
        $stmt = $file_db->prepare($insert);
        $stmt->bindParam(':numero', $numero);
        $stmt->execute();
        eliminardependenciafactura($numero);
        return 'Se ha eliminado el registro con el numero: ' . $numero;
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
}

function insertarproducto($data) {
    $cantidad = $data['cantidad'];
    $descripcion = $data['descripcion'];
    $valoru = $data['valoru'];
    $subtotal = $cantidad * $valoru;
    $factura=0;
    try {
        $file_db = obtenerconexion();
        // Prepare INSERT statement to SQLite3 file db
        $insert = "INSERT INTO producto (cantidad, descripcion, valorunitario,subtotal, factura) 
                VALUES (:cantidad, :descripcion, :valorunitario, :subtotal, :factura)";
        $stmt = $file_db->prepare($insert);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':valorunitario', $valoru);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->bindParam(':factura', $factura);
        $stmt->execute();
        return 'Se ha insertado la informacion!';
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
}

function eliminarproducto($data) {
   // var_dump($data);
    $descripcion = $data['descripcion'];
    try {
        $file_db = obtenerconexion();
        // Prepare INSERT statement to SQLite3 file db
        $insert = "DELETE FROM producto WHERE descripcion=:descripcion";
        $stmt = $file_db->prepare($insert);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->execute();

        return 'Se ha eliminado el registro con el numero: ' . $descripcion;
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
}
