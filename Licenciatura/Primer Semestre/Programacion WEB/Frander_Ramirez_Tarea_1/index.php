<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jsIndex.js"></script>
    <Link rel=StyleSheet href="css/bootstrap.css" Type="text/css"> 
    <Link rel=StyleSheet href="css/fonts/glyphicons-halflings-regular.eot" Type="text/css">
    <Link rel=StyleSheet href="css/fonts/glyphicons-halflings-regular.svg" Type="text/css"> 
    <Link rel=StyleSheet href="css/fonts/glyphicons-halflings-regular.ttf" Type="text/css"> 
    <Link rel=StyleSheet href="css/fonts/glyphicons-halflings-regular.woff" Type="text/css"> 
    
</head>

    <?php 
    include_once('dominio/unidad.php');
    session_start();
     $opcion = "0";
     if(isset($_POST['tipo_conversion'])){
        $opcion = $_POST['tipo_conversion'];
        if($opcion == "1"){
           $lista = array();
           array_push($lista, new unidad("Milimetros","Milimetros"));
           array_push($lista, new unidad("Centimetros","Centimetros"));
           array_push($lista, new unidad("Metros","Metros"));
           array_push($lista, new unidad("Kilometros","Kilometros"));
           array_push($lista, new unidad("Pulgadas","Pulgadas"));
           array_push($lista, new unidad("Pies","Pies"));
           array_push($lista, new unidad("Yardas","Yardas"));
           array_push($lista, new unidad("Brazas","Brazas"));
           array_push($lista, new unidad("Millas","Millas Tierra"));
           array_push($lista, new unidad("Millas Marina","Millas Mar EU"));

        }else if($opcion == 2){
           $lista = array();
           array_push($lista, new unidad("Milimetros^2","Milimetros^2"));
           array_push($lista, new unidad("Centimetros^2","Centimetros^2"));
           array_push($lista, new unidad("Metros^2","Metros^2"));
           array_push($lista, new unidad("Kilometros^2","Kilometros^2"));
           array_push($lista, new unidad("Pulgadas^2","Pulgadas^2"));
           array_push($lista, new unidad("Pies^2","Pies^2"));
           array_push($lista, new unidad("Yardas^2","Yardas^2"));
           array_push($lista, new unidad("Hectareas","Hectareas"));
           array_push($lista, new unidad("Millas^2","Millas^2"));
         
        }else if($opcion == 3){
            $lista = array();
           array_push($lista, new unidad("Centimetros^3","Centimetros^3"));
           array_push($lista, new unidad("Metros^3","Metros^3"));
           array_push($lista, new unidad("Pulgadas^3","Pulgadas^3"));
           array_push($lista, new unidad("Pies^3","Pies^3"));
           array_push($lista, new unidad("Yardas^3","Yardas^3"));
           array_push($lista, new unidad("Decimetros^3","Decimetros^3"));
        }else if($opcion == 4){
          /* $lista = array();
           array_push($lista, new unidad("Pulgadas","Pulgadas^3"));
           array_push($lista, new unidad("Pies","Pies^3"));
           array_push($lista, new unidad("Litros","Litros"));
           array_push($lista, new unidad("Hectolitros","Hectolitros"));
           array_push($lista, new unidad("Galones","Galones[RU]"));
           array_push($lista, new unidad("Galones2","Galones[EU]"));
           array_push($lista, new unidad("Pintas_Liquidas","Pintas Liquídas"));
           array_push($lista, new unidad("Quarter_Liquidas","Quarter Liquídas"));
           array_push($lista, new unidad("Bushles","Bushles[RU]"));
           array_push($lista, new unidad("Bushles2","Bushles[EU]"));*/
        }else if($opcion == 5){
            $lista = array();
            array_push($lista, new unidad("Gramos","Gramos"));
            array_push($lista, new unidad("Kilogramos","Kilogramos"));
            array_push($lista, new unidad("Onzas","Onzas"));
            array_push($lista, new unidad("Libras","Libras"));
        }else if($opcion == 6){
            $lista = array();
            array_push($lista, new unidad("Kílometros/h","Kílometros/h"));
            array_push($lista, new unidad("Metros/s","Metros/s"));
            array_push($lista, new unidad("Kilometros/s","Kilometros/s"));
            array_push($lista, new unidad("Nudos","Nudos"));
            array_push($lista, new unidad("Milimetros/s","Milimetros/s"));
            array_push($lista, new unidad("Millas/s","Millas/s")); 
            array_push($lista, new unidad("Millas/h","Millas/h"));  
            
        }
     }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Conversor</div>
                    <div class="panel-body">
                       <form action="index.php" method="POST">
                            <div class="form-group">
                                <label for="sel1">Elija un tipo de conversión:</label>
                                <select name ="tipo_conversion" class="form-control" id="sel1">
                                    <option value="0" selected disabled>Seleccione una opción...</option>
                                    <option value="1">Longitud</option>
                                    <option value="2">Superficie</option>
                                    <option value="3">Volumen</option>
                                    <!--<option value="4">Capacidad</option>-->
                                    <option value="5">Peso</option>
                                    <option value="6">Velocidad Potencia</option>
                                </select>
                            </div>
                            <input type="submit" value="Cargar" class="btn btn-success" name="btn_cargar"></input>
                       </form>
                    </div>
                </div>
            </div>
        </div>
         <!--Formulario 1 Longitud -->
        <?php if(isset($opcion)){
            if($opcion == "1"){ ?>
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-12 col-md-6 col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Longitud</div>
                            <div class="panel-body">
                                <form action="logica/logica_convertidor.php" method="POST">
                                    <input type="hidden" name="formulario" value="1">
                                    <div class="form-group">
                                    <label for="valor">Quiero Convertir:</label>
                                    <input type="text" id="valor" name="valor" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <select  class="form-control" name="convertir" id="select1">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sel1">A:</label>
                                        <select class="form-control" name="a" id="select2">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <input type="submit" value="Calcular" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>  
        <?php } ?>
         <!--Formulario 2 Superficie-->
        <?php if(isset($opcion)){
            if($opcion == "2"){ ?>
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-12 col-md-6 col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Superficie</div>
                            <div class="panel-body">
                                <form action="logica/logica_convertidor.php" method="POST">
                                    <input type="hidden" name="formulario" value="2">
                                    <div class="form-group">
                                    <label for="valor">Quiero Convertir:</label>
                                    <input type="text" id="valor" name="valor" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <select  class="form-control" name="convertir" id="select1">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sel1">A:</label>
                                        <select class="form-control" name="a" id="select2">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <input type="submit" value="Calcular" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>  
         <?php } ?> 
         <!--Formulario 3 Volumen-->
         <?php if(isset($opcion)){
            if($opcion == "3"){ ?>
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-12 col-md-6 col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Volumen</div>
                            <div class="panel-body">
                                <form action="logica/logica_convertidor.php" method="POST">
                                    <input type="hidden" name="formulario" value="3">
                                    
                                    <div class="form-group">
                                    <label for="valor">Quiero Convertir:</label>
                                    <input type="text" id="valor" name="valor" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <select  class="form-control" name="convertir" id="select1">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sel1">A:</label>
                                        <select class="form-control" name="a" id="select2">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <input type="submit" value="Calcular" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>  
        <?php } ?>
         <!--Formulario 4 Capacidad-->
         <?php if(isset($opcion)){
            if($opcion == "4"){ ?>
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-12 col-md-6 col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Capacidad</div>
                            <div class="panel-body">
                                <form action="logica/logica_convertidor.php" method="POST">
                                    <input type="hidden" name="formulario" value="4">
                                    <div class="form-group">
                                    <label for="valor">Quiero Convertir:</label>
                                    <input type="text" id="valor" name="valor" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <select  class="form-control" name="convertir" id="select1">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sel1">A:</label>
                                        <select class="form-control" name="a" id="select2">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <input type="submit" value="Calcular" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>  
        <?php } ?> 
         <!--Formulario 5 Peso-->
         <?php if(isset($opcion)){
            if($opcion == "5"){ ?>
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-12 col-md-6 col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Peso</div>
                            <div class="panel-body">
                                <form action="logica/logica_convertidor.php" method="POST">
                                    <input type="hidden" name="formulario" value="5">
                                    <div class="form-group">
                                    <label for="valor">Quiero Convertir:</label>
                                    <input type="text" id="valor" name="valor" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <select  class="form-control" name="convertir" id="select1">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sel1">A:</label>
                                        <select class="form-control" name="a" id="select2">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <input type="submit" value="Calcular" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>  
        <?php } ?> 
        <!--Formulario 6 Velocidad de Potencia -->
        <?php if(isset($opcion)){
            if($opcion == "6"){ ?>
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-12 col-md-6 col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Velocidad Potencia</div>
                            <div class="panel-body">
                                <form action="logica/logica_convertidor.php" method="POST">
                                    <input type="hidden" name="formulario" value="6">
                                    <div class="form-group">
                                    <label for="valor">Quiero Convertir:</label>
                                    <input type="text" id="valor" name="valor" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <select  class="form-control" name="convertir" id="select1">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sel1">A:</label>
                                        <select class="form-control" name="a" id="select2">
                                        <?php foreach($lista as $unidad){ ?>
                                            <option value="<?php echo $unidad->getValor() ?>"><?php echo $unidad->getNombre() ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <input type="submit" value="Calcular" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>  
        <?php } ?> 
         <!--Resultados -->
        <?php if(isset($_SESSION["FormResultado"]) and $_SESSION["FormResultado"] == "10"){ ?>
            <div class="row">
                <div class="col-sm-offset-3 col-sm-12 col-md-6 col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Resultado</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label> Conversión de: <?php echo $_SESSION["valor"]." ".$_SESSION["unidad_1"] ?></label>
                            </div>
                            <div class="form-group">
                                <label> A: <?php echo $_SESSION["unidad_2"] ?></label>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="resultado" type="text" value="<?php echo $_SESSION["resultado"]." ".$_SESSION["unidad_2"]?>" disabled></input>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

        <?php
            if(isset($_SESSION["FormResultado"])){
                session_destroy();
            }
        } ?>                                      
    </div>   
    
</body>
</html>