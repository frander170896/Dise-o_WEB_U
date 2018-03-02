<?php
     include_once('entidades/contacto.php');
    class logica{
        
        public function logica(){

        }

        public function leerArchivo(){
            $lista = array();

            $file = @file("Datos.txt");
            if($file){
                While(list($var,$val) = each($file)){
                    $val = trim($val);
                    $contacto = logica::crearContacto($val);
                    array_push($lista,$contacto);
                    //print "$val </br>"
                }
            }else{
                print " No se encontro el archivo Datos.txt";
            }
            return $lista;
        }
        public function crearContacto($dato){

            $name = "";
            $work = "";
            $mobile = "";
            $email = "";
            $address = "";
            $state = "";
            $id = 0;
            $temp = "";
            $contador=0;

            for($i = 0; $i< strlen($dato); $i++){
                if($dato[$i] != ','){
                    $temp .= $dato[$i];
                }
                else if($contador == 0){
                    $name = $temp;
                    $contador++;
                    $temp = "";
                }
                else if ($contador == 1){
                    $work = $temp;
                    $contador++;
                    $temp = "";
                }
                else if ($contador == 2){
                    $mobile = $temp;
                    $contador++;
                    $temp = "";
                }
                else if ($contador == 3){
                    $email = $temp;
                    $contador++;
                    $temp = "";
                }
                else if ($contador == 4){
                    $address = $temp;
                    $contador++;
                    $temp = "";
                }
                else if ($contador == 5){
                    $state = $temp;
                    $contador++;
                    $temp = "";
                }
                else if ($contador == 6){
                    $id = $temp;
                    $contador++;
                    $temp = "";
                }
            }

            $contacto = new contacto($name,$work,$mobile,$email,$address,$state,$id);
            return $contacto;
        }
    }

?>