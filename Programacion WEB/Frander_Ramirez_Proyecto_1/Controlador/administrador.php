<?php
    
    if(!(session_status() === PHP_SESSION_ACTIVE)){
        session_start();
    }

    if(isset($_POST["form"])){
        if($_POST["form"]== 1){
            $cont = new administrador();
            $cont->AgregarArchivo();
        }
        if($_POST["form"] == 2){
            $cont = new administrador();
            $cont->ActualizarArhivo();
        }
        if($_POST["form"] == 3){
            $cont = new administrador();
            $datos = $_POST['eliminar'];
            $array = explode(",",$datos);
            print_r($array);
            $eliminar = $array[0];
            $nombreArchivo = $array[1];
            $cont->eliminarArchivo($eliminar,$nombreArchivo);
        }
    }

    class administrador{

        public function administrador(){}
        
        public function AgregarArchivo(){
            $dir_subida = "../Almacenamiento/".$_SESSION['user']."/";
            $fichero_subido = $dir_subida . basename($_FILES['excel']['name']);
            if (move_uploaded_file($_FILES['excel']['tmp_name'], $fichero_subido)) {
                $nombre = $_FILES['excel']['name'];
                $autor = $_POST['autor'];
                $fecha = date("d/m/Y");
                $tamaño = $_FILES['excel']['size'];
                $descripcion = $_POST['descripcion'];
                $clasificacion = $_POST['clasificacion'];

                administrador::guardarEnArchivo($dir_subida,$nombre,$autor,$fecha,$tamaño,$descripcion, $clasificacion);
                $_SESSION['respuesta'] =  "Los datos se guardaron de manera exitosa.";
            } else {
                $_SESSION['respuesta'] =  "Error! Los datos no se almacenaron.";
            }
            header("location: ../Interfaz/PaginaPrincipal.php");
        }

        public function guardarEnArchivo($direccion,$nombre,$autor,$fecha,$size,$clasificacion,$descripcion){
            $indice = 0;
            if(file_exists($direccion."detalle_archivos.txt")){
                if(filesize($direccion."detalle_archivos.txt") > 0){
                    $fp = fopen($direccion."detalle_archivos.txt", "r");
                    $indice = strlen(file_get_contents($direccion."detalle_archivos.txt"));
                } else {
                    $indice = 0;
                }
            }
           
            //incerto en el ecabezado del archivo
            $file = fopen($direccion."encabezado_archivos.txt", "a");
            $temp= $autor.'$'.$fecha.'$'.$size.'$'.$descripcion.'$'.$clasificacion.'$'."|";
            $tamano = strlen($temp)+1;
            fwrite($file, $nombre.'$'.$indice.'$'.'0$'.$tamano.'$'.'0'.'$'."|\n");
            fclose($file);

            //incerto en el detalle del contacto
            $file = fopen($direccion."detalle_archivos.txt", "a");
            fwrite($file, $autor.'$'.$fecha.'$'.$size.'$'.$descripcion.'$'.$clasificacion.'$'."|\n");
            fclose($file);

        }
        public function ObtenerEncabezadoArchivo($dato){
            $lista=array();
            $nombre = "";
            $indice = "";
            $eliminado = "";
            $tamaño = "";
            $compartido = "";
            $temp = "";

            $contador=0;
            for($i = 0; $i < strlen($dato); $i++){
                if($dato[$i] != '|'){
                    if($dato[$i] != '$'){
                        $temp.= $dato[$i];
                    }
                    else if($contador == 0){
                        $nombre = $temp;
                        $contador++;
                        $temp = "";
                    }
                    else if($contador == 1){
                        $indice = $temp;
                        $contador++;
                        $temp = "";
                    }
                    else if($contador == 2){
                        $eliminado = $temp;
                        $contador++;
                        $temp = "";
                    }
                    else if($contador == 3){
                        $tamaño = $temp;
                        $contador++;
                        $temp = "";
                    }
                    else if ($contador == 4){
                        $compartido = $temp;
                        $temp = "";
                    }
                }else{
                    array_push($lista,array("nombre"=>$nombre,"indice"=>$indice,"eliminado"=>$eliminado,"tamaño"=>$tamaño,"compartido"=>$compartido));
                    $contador = 0;
                }
            }
            
            return $lista;
        }
        public function ObtenerDetalleArchivo($dato){
            $lista=array();
            $autor = "";
            $fecha = "";
            $tamaño = "";
            $clasificacion = "";
            $descripcion = "";
            $temp = "";

            $contador=0;
            for($i = 0; $i < strlen($dato); $i++){
                if($dato[$i] != '|'){
                    if($dato[$i] != '$'){
                        $temp.= $dato[$i];
                    }
                    else if($contador == 0){
                        $autor = $temp;
                        $contador++;
                        $temp = "";
                    }
                    else if($contador == 1){
                        $fecha = $temp;
                        $contador++;
                        $temp = "";
                    }
                    else if($contador == 2){
                        $tamaño = $temp;
                        $contador++;
                        $temp = "";
                    }
                    else if($contador == 3){
                        $clasificacion = $temp;
                        $contador++;
                        $temp = "";
                    }
                    else if ($contador == 4){
                        $descripcion = $temp;
                        $temp = "";
                    }
                }else{
                    array_push($lista,array("autor"=>$autor,"fecha"=>$fecha,"tamaño"=>$tamaño,"clasificacion"=>$clasificacion,"descripcion"=>$descripcion));
                    $contador = 0;
                }
            }
            
            return $lista;
        }
        public function ObtenerDatosSubidos(){
            $datos = array();
            if(file_exists("../Almacenamiento/".$_SESSION['user']."/encabezado_archivos.txt")){
                $contenido = file_get_contents("../Almacenamiento/".$_SESSION['user']."/encabezado_archivos.txt");
                $lista = administrador::ObtenerEncabezadoArchivo($contenido); 
                $datos = array();   
            
                if($lista != null){
                    $fp = fopen("../Almacenamiento/".$_SESSION['user']."/detalle_archivos.txt", "r");
                    for($i=0;$i<count($lista);$i++){
                        fseek($fp,trim($lista[$i]['indice']));
                        $linea = fgets($fp,trim($lista[$i]['tamaño']));
                        $array = explode("$",trim($lista[$i]['nombre'])."$".$linea."$".trim($lista[$i]['eliminado']));
                        array_push($datos,$array);
                    }
                    fclose ($fp);
                }
            }
            return $datos;
        }

        public function ActualizarArhivo(){

          // print_r($_FILES);
            if(isset($_FILES)){
                // Si entra a este if, es porque el usuario quiere modificar el archivo
                $n_nombre = $_FILES['excel']['name'];
                $n_size = $_FILES['excel']['size'];
                $autor = $_POST['autor'];
                $fecha = $_POST['fecha'];
                $descripcion = $_POST['descripcion'];
                $clasificacion = $_POST['clasificacion'];
                $id = $_POST['id'];
                $archivo_anterior = $_POST['anterior'];
                $nombre =$n_nombre;
                $size =$n_size;

                $dir_subida = "../Almacenamiento/".$_SESSION['user']."/";
                $fichero_subido = $dir_subida . basename($_FILES['excel']['name']);

                if (move_uploaded_file($_FILES['excel']['tmp_name'], $fichero_subido)) {
                    // obtener el encabezado del archivo
                    $contenido = file_get_contents("../Almacenamiento/".$_SESSION['user']."/encabezado_archivos.txt");
                    $lista_encabezado = administrador::ObtenerEncabezadoArchivo($contenido); 
                    $encabezadoActualizar = administrador::obtenerEncabezadoActualizar($lista_encabezado,$archivo_anterior);
                    $tamañoDetalle = $encabezadoActualizar[3];// $tamañoDetalle tamaño del detalle que se modificara
                    
                    $temp= $autor.'$'.$fecha.'$'.$size.'$'.$descripcion.'$'.$clasificacion.'$'."|";
                    $tamaño_nDetalle = strlen($temp)+1; //$tamaño_nDetalle tamaño del detalle actualizado
                    
                    if($tamaño_nDetalle <= $tamañoDetalle){
                        // Si entra a este if, es porque el tamaño de los datos actualizar son menores o iguales a los existentes

                        $diferencia = $tamañoDetalle - $tamaño_nDetalle;
                        $temp = 0; // $temp variable que me indicara apartir de donde se empezara a modificar el archivo

                        // En este for se va actualizar el encabezado
                        for($i = 0; $i<count($lista_encabezado);$i++){
                            if(trim($archivo_anterior) == trim($lista_encabezado[$i]['nombre']) && $temp == 0 ){
                                $lista_encabezado[$i]['nombre'] = $n_nombre;
                                $lista_encabezado[$i]['indice'] = $lista_encabezado[$i]['indice'];
                                $lista_encabezado[$i]['eliminado'] = 0;
                                $lista_encabezado[$i]['tamaño'] = $lista_encabezado[$i]['tamaño'] - $diferencia;
                                $lista_encabezado[$i]['compartido'] = 0;

                                $temp = 1;
                            }else if($temp == 1){
                                $lista_encabezado[$i]['indice'] = $lista_encabezado[$i]['indice'] - $diferencia ;
                            }
                        }
                        // Actualizacion del detalle del nuevo archivo
                        $contenido = file_get_contents("../Almacenamiento/".$_SESSION['user']."/detalle_archivos.txt");
                        $lista = administrador::ObtenerDetalleArchivo($contenido);
                    
                        $lista[$id]["autor"] = $autor;
                        $lista[$id]["fecha"] = $fecha;
                        $lista[$id]["tamaño"] = $size;
                        $lista[$id]["clasificacion"] = $clasificacion;
                        $lista[$id]["descripcion"] = $descripcion;

                        //llamado a los metodos de escritura masiva en los archivos
                        administrador::ActualizacionMasivaEncabezado($lista_encabezado);
                        administrador::ActualizacionMasivaDetalle($lista); 
                       
                        //eliminacion del archivo anterior
                        unlink($dir_subida.$archivo_anterior);
                        //header("location: ../Interfaz/PaginaPrincipal.php");
                    }
                    else{
                        // Si entra a este else, es porque el tamaño de lo que desea subir es más grande que lo existente 
                        $contenido = file_get_contents("../Almacenamiento/".$_SESSION['user']."/encabezado_archivos.txt");
                        $lista_encabezado = administrador::ObtenerEncabezadoArchivo($contenido); 
                        $temp= $autor.'$'.$fecha.'$'.$size.'$'.$descripcion.'$'.$clasificacion.'$'."|";
                        $tamaño_nDetalle = strlen($temp)+1; //$tamaño_nDetalle tamaño del detalle actualizado
                        $indice_temp = 0;
                        $tamaño_temp = 0;
                        $temp = 0;
                        $diferencia = 0;

                        for($i=0; $i < count($lista_encabezado); $i++){
                            if(trim($lista_encabezado[$i]['tamaño']) >= $tamaño_nDetalle && trim($lista_encabezado[$i]['eliminado']) == 1 && $temp == 0 ){
                               
                                $indice_temp = $lista_encabezado[$i]['indice'];
                                $tamaño_temp = $lista_encabezado[$i]['tamaño'];
                                $diferencia = $lista_encabezado[$i]['tamaño'] - $tamaño_nDetalle;

                                $lista_encabezado[$i]['nombre'] = $n_nombre;
                                $lista_encabezado[$i]['indice'] = $lista_encabezado[$i]['indice'];
                                $lista_encabezado[$i]['eliminado'] = 0;
                                $lista_encabezado[$i]['tamaño'] = $lista_encabezado[$i]['tamaño'] - $diferencia;
                                $lista_encabezado[$i]['compartido'] = 0;
                                $temp = 1;
                            }else if ($temp == 1){
                                $lista_encabezado[$i]['indice'] = $lista_encabezado[$i]['indice'] - $diferencia ;
                            }
                        }
                        if($temp == 1){
                            //obtengo el detalle que se encontraba en esa posicion eliminado

                            // Actualizacion del detalle del nuevo archivo
                            $fp = fopen("../Almacenamiento/".$_SESSION['user']."/detalle_archivos.txt", "r");
                            fseek($fp,$indice_temp);
                            $linea = fgets($fp,$tamaño_temp);
                            $array_detalle = explode("$",$linea); 
                            fclose ($fp);

                            
                            $contenido = file_get_contents("../Almacenamiento/".$_SESSION['user']."/detalle_archivos.txt");
                            $lista_detalle_vieja = administrador::ObtenerDetalleArchivo($contenido);

                            if($array_detalle != null){
                                for($i=0; $i < count($lista_detalle_vieja); $i++){
                                    if(trim($lista_detalle_vieja[$i]['autor']) ==  $array_detalle[0] && trim($lista_detalle_vieja[$i]['fecha']) == $array_detalle[1] &&
                                       trim($lista_detalle_vieja[$i]['tamaño']) ==  $array_detalle[2] && trim($lista_detalle_vieja[$i]['clasificacion']) == $array_detalle[3]
                                       && trim($lista_detalle_vieja[$i]['descripcion']) == $array_detalle[4]){
                                        
                                        $lista_detalle_vieja[$i]["autor"] = $autor;
                                        $lista_detalle_vieja[$i]["fecha"] = $fecha;
                                        $lista_detalle_vieja[$i]["tamaño"] = $size;
                                        $lista_detalle_vieja[$i]["clasificacion"] = $clasificacion;
                                        $lista_detalle_vieja[$i]["descripcion"] = $descripcion;
                                    }
                                }
                            }

                            //llamado a los metodos de escritura masiva en los archivos
                            administrador::ActualizacionMasivaEncabezado($lista_encabezado);
                            administrador::ActualizacionMasivaDetalle($lista_detalle_vieja); 

                            unlink($dir_subida.$archivo_anterior);
                           // header("location: ../Interfaz/PaginaPrincipal.php");
                        }else{
                            //marcar el anterior como eliminado el archivo que iba actualizar, pero que no es tan grande para almacenar la actualizacion
                            $contenido = file_get_contents("../Almacenamiento/".$_SESSION['user']."/encabezado_archivos.txt");
                            $lista_encabezado = administrador::ObtenerEncabezadoArchivo($contenido); 
                                for($i = 0; $i<count($lista_encabezado);$i++){
                                    if(trim($archivo_anterior) == trim($lista_encabezado[$i]['nombre']) ){
                                        $lista_encabezado[$i]['eliminado'] = 1;
                                        $i =count($lista_encabezado);
                                    }
                                }   
                            administrador::ActualizacionMasivaEncabezado($lista_encabezado);
                            $indice = 0;
                            if(file_exists($dir_subida."detalle_archivos.txt")){
                                if(filesize($dir_subida."detalle_archivos.txt") > 0){
                                    $fp = fopen($dir_subida."detalle_archivos.txt", "r");
                                    $indice = strlen(file_get_contents($dir_subida."detalle_archivos.txt"));
                                } else {
                                    $indice = 0;
                                }
                            }
                            //incerto en el ecabezado del archivo
                            $file = fopen($dir_subida."encabezado_archivos.txt", "a");
                            $temp= $autor.'$'.$fecha.'$'.$size.'$'.$descripcion.'$'.$clasificacion.'$'."|";
                            $tamano = strlen($temp)+1;
                            fwrite($file, $nombre.'$'.$indice.'$'.'0$'.$tamano.'$'.'0'.'$'."|\n");
                            fclose($file);

                            //incerto en el detalle del contacto
                            $file = fopen($dir_subida."detalle_archivos.txt", "a");
                            fwrite($file, $autor.'$'.$fecha.'$'.$size.'$'.$descripcion.'$'.$clasificacion.'$'."|\n");
                            fclose($file);

                        }
                    }
                } 
            
            }
            header("location: ../Interfaz/PaginaPrincipal.php");
           
        }

        public function obtenerEncabezadoActualizar($lista,$archivo_anterior){
        
            $datos ="";
            for($i=0;$i<count($lista);$i++){
               if(trim($lista[$i]['nombre']) == trim($archivo_anterior)){
                    $datos = trim($lista[$i]['nombre']).','.trim($lista[$i]['indice']).','.trim($lista[$i]['eliminado']).','.trim($lista[$i]['tamaño']).','.trim($lista[$i]['compartido']);
                    $i = count($lista);
               }
            }
            
            $array = explode(",", $datos); 
            return  $array;
        }

        public function ActualizacionMasivaDetalle($lista){
            $a = "a";
            $w = "w";
            $contador = 0;
            $fa= fopen("../Almacenamiento/".$_SESSION['user']."/detalle_archivos.txt", "w"); 
            fwrite($fa,""); 
            fclose($fa); 
            $file = fopen("../Almacenamiento/".$_SESSION['user']."/detalle_archivos.txt", "a");
           
            for($i = 0; $i< count($lista);$i++){
               fwrite($file,trim($lista[$i]['autor'].'$'.$lista[$i]['fecha'].'$'.$lista[$i]['tamaño'].'$'.$lista[$i]['clasificacion'].'$'.$lista[$i]['descripcion'].'$'."|")."\n");
            }
            fclose($file);

        }
        public function ActualizacionMasivaEncabezado($lista){
            $a = "a";
            $w = "w";
            $contador = 0;
            $fa= fopen("../Almacenamiento/".$_SESSION['user']."/encabezado_archivos.txt", "w"); 
            fwrite($fa,""); 
            fclose($fa); 
        
            $file = fopen("../Almacenamiento/".$_SESSION['user']."/encabezado_archivos.txt", "a");
            for($i = 0; $i< count($lista);$i++){
                
                fwrite($file, trim($lista[$i]['nombre'].'$'.$lista[$i]['indice'].'$'.$lista[$i]['eliminado'].'$'.$lista[$i]['tamaño'].'$'.$lista[$i]['compartido'].'$'."|")."\n");
            }
            fclose($file);

        }
        public function eliminarArchivo($id,$nombreArchivo){
            //eliminar detalle del archivo
            $fp = fopen("../Almacenamiento/".$_SESSION['user']."/encabezado_archivos.txt", "r");
            $datos = file_get_contents("../Almacenamiento/".$_SESSION['user']."/encabezado_archivos.txt");
            $temp = "";
            $lista = array();
            $lista = administrador::ObtenerEncabezadoArchivo($datos);
            
           
            if($lista != NULL){
                for($i = 0; $i < count($lista); $i++){
                    if($i == $id){
                        $lista[$i]['eliminado'] = 1;
                    }
                } 
            }
            print_r($lista);


        
            if(file_exists("../Almacenamiento/".$_SESSION['user']."/".$nombreArchivo)){
                unlink("../Almacenamiento/".$_SESSION['user']."/".$nombreArchivo);
            }
           administrador::ActualizacionMasivaEncabezado($lista);
           header("location: ../Interfaz/PaginaPrincipal.php");

        }
    
    }
    

?>