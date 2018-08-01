<?php 
    include_once('../dominio/equivalencia.php');
    include_once('../dominio/equivalencia_volumen.php');
    include_once('../dominio/equivalencia_superficie.php');
    include_once('../dominio/equivalencia_peso.php');
    include_once('../dominio/equivalencia_velocidad.php');

    session_start();
    $_SESSION["FormResultado"]="";
    $_SESSION["valor"]="";
    $_SESSION["unidad_1"]="";
    $_SESSION["unidad_2"]="";
    $_SESSION["resultado"]="";


    if(isset($_POST['formulario'])){
        $opcion = $_POST['formulario'];
        if($opcion == "1"){
            $metodo = new logicaConvertidor();
            $metodo->convertir_Longitudes();
        }else if($opcion == "2"){
            $metodo = new logicaConvertidor();
            $metodo->convertir_superficie();
        }else if($opcion == "3"){
            $metodo = new logicaConvertidor();
            $metodo->convertir_volumenes();
        }
        else if($opcion == "4"){
           // $metodo = new logicaConvertidor();
            //$metodo->convertir_volumenes();
        }
        else if($opcion == "5"){
            $metodo = new logicaConvertidor();
            $metodo->convertir_peso();
        }else if($opcion == "6"){
            $metodo = new logicaConvertidor();
            $metodo->convertir_velocidad_potencia();
            
        }
    }

    class logicaConvertidor{
        
        public function convertir_Longitudes(){
            $lista = logicaConvertidor::llenar_equivalencias();
            $valor = $_POST['valor'];
            $convertir = $_POST['convertir'];
            $a = $_POST['a'];

            $equivalencia = logicaConvertidor::obtenerEquivalencia($lista,$convertir,$a);

            $resultado = ($valor * $equivalencia);

            $_SESSION["FormResultado"]="10";
            $_SESSION["valor"]=$valor;
            $_SESSION["unidad_1"]=$convertir;
            $_SESSION["unidad_2"]= $a;
            $_SESSION["resultado"]=$resultado;
            print_r($_SESSION);
            header('Location: ../index.php');
        }

        public function llenar_equivalencias(){
           $lista = array();
           // estandar = nombre,centimetros,metros,kilometros,pulgadas,pies,yardas,milimetros,brazas,millas_tierra,millas_mar_eu,millas_mar_ru
           array_push($lista, new equivalencia("Centimetros",1,0.01,0.00001,0.393701,0.0328083,0.0109361,10,0.011,6.21371,0.0000053996,0.0000053999));
           array_push($lista, new equivalencia("Metros",100,1,0.001,39.3701,3.28084,1.09361,1000,0.546807,6.21371,0.00053996,0.00053999));
           array_push($lista, new equivalencia("Kilometros",1,1000,1,3.93701,3280.4,1093.6,1000000,546.8066,0.621371,0.539957,0.53999));
           array_push($lista, new equivalencia("Pulgadas",2.54,0.0254,2.54,1,0.08333,0.027778,25.4,0.01388888,1.57828,0.0000137149,0.0000137149));
           array_push($lista, new equivalencia("Pies",30.48,0.3048,3.048,12,1,0.333333,304.8,0.1666666,1.8939,0.000164578,0.000164578));
           array_push($lista, new equivalencia("Yardas",91.44,0.9144,9.144,36,3,1,914.4,0.5,5.6818,0.00049373,0.00049373));
           array_push($lista, new equivalencia("Millas",1.60934,1609.34,1.60934,6.336,5280,1760,1.609344,880,1,0.86897624,0.86897624));
           array_push($lista, new equivalencia("Brazas",182.88,1.8288,0.0018288,72,6,2,1828.8,1,0.001136363,0.0009874,0.0009874));
           array_push($lista, new equivalencia("Millas Marina",185200,1852,1.852,7.2913385,6.07611548,2.0253718,1852000,1.012685914,1.15077944,1,1));
           array_push($lista, new equivalencia("Milimetros",0.1,0.001,0.000001,0.03937007,0.00328083,0.00109361,1,0.00054680,6,21371192,5.39956803,5.39956803));

           return $lista;
        }

        public function obtenerEquivalencia($lista,$nombre,$a){
            $resultado = 0;
            foreach($lista as $valor){
                if($valor->getNombre() == $nombre && $a == "Centimetros"){
                    $resultado = $valor->getCentimetros();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Metros"){
                    $resultado = $valor->getMetros();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Kilometros"){
                    $resultado = $valor->getKilometros();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Pulgadas"){
                    $resultado = $valor->getPulgadas();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Pies"){
                    $resultado = $valor->getPies();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Yardas"){
                    $resultado = $valor->getYardas();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Millas"){
                    $resultado = $valor->getMillasTierra();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Brazas"){
                    $resultado = $valor->getBrazas();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Millas Marina"){
                    $resultado = $valor->getMillasMarEU();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Milimetros"){
                    $resultado = $valor->getMilimetros();
                    break;  
                }
            }
            
            return $resultado;
         }
         
         public function llenarequivalenciaVolumen(){
            $lista = array();
            // estandar = nombre,plg3,pie3,yd3,cm3,dm3,m3
             
            array_push($lista, new equivalencia_volumen("Pulgadas^3",1,0.006,0.0000214,16.39,0.01639,0.0000164));
            array_push($lista, new equivalencia_volumen("Pies^3",1728,1,0.037,28316.83,28.32,0.02832));
            array_push($lista, new equivalencia_volumen("Yardas^3",46656,27,1,764554.64,764.55,0.765));
            array_push($lista, new equivalencia_volumen("Centimetros^3",0.061,0.00003532,0.00000131,1,0.001,0.000001));
            array_push($lista, new equivalencia_volumen("Decimetros^3",61.02,0.03531,0.00131,1000,1,0.001));
            array_push($lista, new equivalencia_volumen("Metros^3",61023.76,35.3147,1.308,1000000,1000,1));

            return $lista;
         }
         public function obtenerEquivalenciaVolumen($lista,$nombre,$a){
            $resultado = 0;
            foreach($lista as $valor){
                if($valor->getNombre() == $nombre && $a == "Pulgadas^3"){
                    $resultado = $valor->getPulgadas();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Pies^3"){
                    $resultado = $valor->getPies();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Yardas^3"){
                    $resultado = $valor->getYardas();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Centimetros^3"){
                    $resultado = $valor->getCentimetros();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Decimetros^3"){
                    $resultado = $valor->getDecimetro();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Metros^3"){
                    $resultado = $valor->getMetros();
                    break;  
                }
            }
            
            return $resultado;
         }
         public function convertir_volumenes(){
            $lista = logicaConvertidor::llenarequivalenciaVolumen();
            
            $valor = $_POST['valor'];
            $convertir = $_POST['convertir'];
            $a = $_POST['a'];
           $equivalencia = logicaConvertidor::obtenerEquivalenciaVolumen($lista,$convertir,$a);

            $resultado = ($valor * $equivalencia);
           
            $_SESSION["FormResultado"]="10";
            $_SESSION["valor"]=$valor;
            $_SESSION["unidad_1"]=$convertir;
            $_SESSION["unidad_2"]= $a;
            $_SESSION["resultado"]=$resultado;
           
            header('Location: ../index.php');
         }
        public function llenarequivalenciaSuperficie(){
            $lista = array();
            // estandar = nombre,milimetros,centimetros,metros,kilometros,pulgadas,pies,yardas,hectareas,millas
             
            array_push($lista, new equivalencia_superficie("Milimetros^2",1,0.01,0.000001,0.000000000001,0.0015500031,0.0000107639,0.00000119599,0.000000001,0.000000000000386102));
            array_push($lista, new equivalencia_superficie("Centimetros^2",100,1,0.0001,0.0000000001,0.15500031000062,0.001076391041671,0.00011959900463011,0.00000001,0.0000000000386102));
            array_push($lista, new equivalencia_superficie("Metros^2",1000000,10000,1,0.000001,1550.0031000062,10.76391041671,1.1959900463011,0.0001,0.000000386102));
            array_push($lista, new equivalencia_superficie("Kilometros^2",1000000000000,10000000000,1000000,1,1550003100.0062,10763910.41671,1195990.0463011,100,	0.38610215854245));
            array_push($lista, new equivalencia_superficie("Pulgadas^2",645.16,6.4516,0.00064516,0.00000000064516,1,0.0069444444444444,0.0007716049382716,0.000000064516,0.000000000249097));
            array_push($lista, new equivalencia_superficie("Pies^2",92903.04,929.0304,0.09290304,0.000000092903,144,1,	0.11111111111111,0.0000092903,0.00000003587));
            array_push($lista, new equivalencia_superficie("Yardas^2",836127.36,8361.2736,0.83612736,0.000000836127,1296,9,1,0.0000836127,0.00000032283));
            array_push($lista, new equivalencia_superficie("Hectareas",10000000000,100000000,10000,0.01,15500031.000062,107639.1041671,11959.900463011,1,0.0038610215854245));
            array_push($lista, new equivalencia_superficie("Millas^2",2589988110336,25899881103.36,2589988.110336,2.589988110336,4014489600,27878400,3097600,258.9988110336,1));
    

            return $lista;
        }
        public function obtenerEquivalenciaSuperficie($lista,$nombre,$a){
            $resultado = 0;
            foreach($lista as $valor){
                if($valor->getNombre() == $nombre && $a == "Milimetros^2"){
                    $resultado = $valor->getMilimetros();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Centimetros^2"){
                    $resultado = $valor->getCentimetros();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Metros^2"){
                    $resultado = $valor->getMetros();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Kilometros^2"){
                    $resultado = $valor->getKilometros();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Pulgadas^2"){
                    $resultado = $valor->getPulgadas();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Pies^2"){
                    $resultado = $valor->getPies();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Yardas^2"){
                    $resultado = $valor->getYardas();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Hectareas"){
                    $resultado = $valor->getHectareas();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Millas^2"){
                    $resultado = $valor->getMillas();
                    break;  
                }
            }
            
            return $resultado;
         }
        public function convertir_superficie(){
            $lista = logicaConvertidor::llenarequivalenciaSuperficie();
            
            $valor = $_POST['valor'];
            $convertir = $_POST['convertir'];
            $a = $_POST['a'];
            $equivalencia = logicaConvertidor::obtenerEquivalenciaSuperficie($lista,$convertir,$a);

            $resultado = ($valor * $equivalencia);
           
            $_SESSION["FormResultado"]="10";
            $_SESSION["valor"]=$valor;
            $_SESSION["unidad_1"]=$convertir;
            $_SESSION["unidad_2"]= $a;
            $_SESSION["resultado"]=$resultado;
           
            header('Location: ../index.php');
        }


        public function llenarequivalenciaPeso(){
            $lista = array();
            // estandar = nombre,gramos,kilogramos,onzas,libras
             
            array_push($lista, new equivalencia_peso("Gramos",1,0.001,0.03527396194958,0.0022046226218488));
            array_push($lista, new equivalencia_peso("Kilogramos",1000,1,35.27396194958,2.2046226218488));
            array_push($lista, new equivalencia_peso("Onzas",28.349523125,0.028349523125,1,0.0625));
            array_push($lista, new equivalencia_peso("Libras",453.59237,0.45359237,16,1));
            
            return $lista;
        }
        public function obtenerEquivalenciaPeso($lista,$nombre,$a){
            $resultado = 0;
            foreach($lista as $valor){
                if($valor->getNombre() == $nombre && $a == "Gramos"){
                    $resultado = $valor->getGramos();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Kilogramos"){
                    $resultado = $valor->getKilogramos();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Onzas"){
                    $resultado = $valor->getOnzas();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Libras"){
                    $resultado = $valor->getLibras();
                    break;  
                }
            }
            
            return $resultado;
         }
        public function convertir_peso(){
            $lista = logicaConvertidor::llenarequivalenciaPeso();
            
            $valor = $_POST['valor'];
            $convertir = $_POST['convertir'];
            $a = $_POST['a'];
            $equivalencia = logicaConvertidor::obtenerEquivalenciaPeso($lista,$convertir,$a);

            $resultado = ($valor * $equivalencia);
           
            $_SESSION["FormResultado"]="10";
            $_SESSION["valor"]=$valor;
            $_SESSION["unidad_1"]=$convertir;
            $_SESSION["unidad_2"]= $a;
            $_SESSION["resultado"]=$resultado;
           
            header('Location: ../index.php');
        }
        public function llenarequivalenciaVelocidadPotencia(){
            $lista = array();
            // estandar = nombre,kilomtros/h,m/s,km/s,mm/s,nudo,milla/h,milla/s
             
            array_push($lista, new equivalencia_velocidad("Kílometros/h",1,0.28,0.000278,277,78,0.50,0.62,0.000173));
            array_push($lista, new equivalencia_velocidad("Metros/s",3.6,1,0.001,1000,1.943845,2.236936,0.000621));
            array_push($lista, new equivalencia_velocidad("Kilometros/s",3600,1000,1,1000000,1943.845,2236.936,0.621371));
            array_push($lista, new equivalencia_velocidad("Nudos",1.852,0.514444,0.000514,514.44431,1,1.150779,0,00032));
            array_push($lista, new equivalencia_velocidad("Milimetros/s",0.0036,0.001,0,000001,1,0.001944,0.002237,0.000001));
            array_push($lista, new equivalencia_velocidad("Millas/s",5793.638328,1609.34398,1.609344,1609343.9799,3128.315249,3599.999485,1));
            array_push($lista, new equivalencia_velocidad("Millas/h",1.609344,0.44704,0.000447,447.040058,0,868977,1,0.000278));
            return $lista;
        }
        public function obtenerEquivalenciaVelocidad($lista,$nombre,$a){
            $resultado = 0;
            foreach($lista as $valor){
                if($valor->getNombre() == $nombre && $a == "Kílometros/h"){
                    $resultado = $valor->getKilometros_h();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Metros/s"){
                    $resultado = $valor->getMetros();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Kilometros/s"){
                    $resultado = $valor->getKilometros_s();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Nudos"){
                    $resultado = $valor->getNudos();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Milimetros/s"){
                    $resultado = $valor->getMilimetros();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Millas/s"){
                    $resultado = $valor->getMillas_s();
                    break;  
                }
                else if($valor->getNombre() == $nombre && $a == "Millas/h"){
                    $resultado = $valor->getMillas_h();
                    break;  
                }
            }
            
            return $resultado;
         }
        public function convertir_velocidad_potencia(){
            $lista = logicaConvertidor::llenarequivalenciaVelocidadPotencia();
            
            $valor = $_POST['valor'];
            $convertir = $_POST['convertir'];
            $a = $_POST['a'];
            $equivalencia = logicaConvertidor::obtenerEquivalenciaVelocidad($lista,$convertir,$a);
            
            $resultado = ($valor * $equivalencia);
           
            $_SESSION["FormResultado"]="10";
            $_SESSION["valor"]=$valor;
            $_SESSION["unidad_1"]=$convertir;
            $_SESSION["unidad_2"]= $a;
            $_SESSION["resultado"]=$resultado;
           
            header('Location: ../index.php');
        }


    }



?>