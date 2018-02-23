<?php 
    include_once('../dominio/equivalencia.php');
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
            //$metodo = new logicaConvertidor();
            //$metodo->convertir_Longitudes();
        }else if($opcion == "3"){
            $metodo = new logicaConvertidor();
            $metodo->convertir_volumenes();
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
          // array_push($lista, new equivalencia("Millas",160934.4,1609.344,1.609344,63360,5280,1760,1.609344,880,1,0.86897624,0.86897624));
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
         public function convertir_volumenes(){

         }
         public function llenarequivalenciaVolumen(){
            $lista = array();
            // estandar = nombre,plg3,pie3,yd3,cm3,dm3,m3
             
            array_push($lista, new equivalencia("Pulgadas",1,0.006,0.0000214,16.39,0.01639,0.0000164));
            array_push($lista, new equivalencia("Pies",1728,1,0.037,28316.83,28.32,0.02832));
            array_push($lista, new equivalencia("Yardas",46656,27,1,764554.64,764.55,0.765));
            array_push($lista, new equivalencia("Yardas",0.061,0.00003532,0.00000131,1,0.001,0.000001));
            array_push($lista, new equivalencia("Yardas",61.02,0.03531,0.00131,1000,1,0.001));
            array_push($lista, new equivalencia("Yardas",61023.76,35.3147,1.308,1000000,1000,1));

            print_r($lista);
            return $lista;
         }
         public function llenarequivalenciaSuperficie(){
            $lista = logicaConvertidor::llenarequivalenciaVolumen();
            $valor = $_POST['valor'];
            $convertir = $_POST['convertir'];
            $a = $_POST['a'];

           /* $equivalencia = logicaConvertidor::obtenerEquivalencia($lista,$convertir,$a);

            $resultado = ($valor * $equivalencia);

            $_SESSION["FormResultado"]="10";
            $_SESSION["valor"]=$valor;
            $_SESSION["unidad_1"]=$convertir;
            $_SESSION["unidad_2"]= $a;
            $_SESSION["resultado"]=$resultado;
            print_r($_SESSION);
            header('Location: ../index.php');*/
         }

    }



?>