<?php
     

     if(isset($_POST['formulario'])){
        if($_POST['formulario'] == 1){
            $name = $_POST['name'];
            $work = $_POST['work'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $address = $_POST['address'];
    
            $logica = new logica();
            $logica->insertarContacto($name, $work,$mobile,$email,$address);
        }else if($_POST['formulario'] == 2){
           //recive los datos necesarios para mostrar
        }
        if($_POST['formulario'] == 3){
         //recibe los datos necesarios para eliminar
        }
     }

    class logica{
       
        public function logica(){}

        public function ObtenerEncabezadoContacto(){
            $lista = array();

            $file = @file("logica/Datos.txt");
            if($file){
                While(list($var,$val) = each($file)){
                    $val = trim($val);
                    $contacto = logica::ObtenerContacto($val);
                    array_push($lista,$contacto);
                }
            }else{
                print " No se encontro el archivo Datos.txt";
            }
            return $lista;
        }
        public function ObtenerContacto($dato){
           
            include_once('entidades/Encabezado_Contacto.php');
            $name = "";
            $state = "";
            $id = 0;
            $temp = "";
            $contador=0;

            for($i = 0; $i< strlen($dato); $i++){
                if($dato[$i] != '$'){
                    $temp .= $dato[$i];
                }
                else if($contador == 0){
                    $name = $temp;
                    $contador++;
                    $temp = "";
                }
                else if ($contador == 1){
                    $id = $temp;
                    $contador++;
                    $temp = "";
                }
                else if ($contador == 2){
                    $state = $temp;
                    $contador++;
                    $temp = "";
                    $i=strlen($dato);
                }
                
            }
            $contacto = new Encabezado_Contacto($name,$id,$state);
            return $contacto;
        }
        public function insertarContacto($name, $work,$mobile,$email,$address){
            //obtiene la la posicion en la que incertara
            $indice = 0;
            if(filesize("Datos2.txt") == 0){
                $indice = 0;
            } else {
                $indice = count(file("Datos2.txt"));
            }

            //incerto en el ecabezado del contacto
            $file = fopen("Datos.txt", "a");
            fwrite($file, $name.'$'.$indice.'$'.'0&'."\n");
            fclose($file);

            //incerto en el detalle del contacto
            $file = fopen("Datos2.txt", "a");
            fwrite($file, $work.'$'.$mobile.'$'.$email.'$'.$address.'$'."\n");
            fclose($file);

            header('location:../index.php');
        }
    }

?>