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
        $lista = $logica->leerArchivo();
        print_r($lista);
    ?>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Work</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($lista as $value) {
                if($value->getState() != 1){?>
                    <tr>
                        <td><?php echo $value->getName() ?></td>
                        <td><?php echo $value->getWork()?></td>
                        <td><?php echo $value->getMobile() ?></td>
                        <td><?php echo $value->getEmail()?></td>
                        <td><?php echo $value->getAddress()?></td>
                    </tr>
            <?php }   
             } ?>
        </tbody>
    </table>
</body>
</html>