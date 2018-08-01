<?php 

 class inicioSesion{

    public function inicioSesion(){}

    public function validarUsuario(){
        session_start();
        if(isset($_POST['nombre']) && isset($_POST['clave'])){
            $direccion = "../Datos/Usuarios.txt";
            $existe = inicioSesion::permisoAcceso($direccion,$_POST['nombre'],$_POST['clave']);
            if($existe){
                $_SESSION['user'] = $_POST['nombre'];
                $_SESSION['pass'] = $_POST['clave'];
                header('location: ../Interfaz/PaginaPrincipal.php');
            }else{
                $_SESSION['respuesta'] = "El usuario o la contraseña son incorrectos";
                header('location: ../index.php');
            }
        }else{
            $_SESSION['respuesta'] = "No se ha ingresado el usuario o la contraseña";
            header('location: ../index.php');
        }
    }
    public function permisoAcceso($direccion,$nombre,$clave){

        $contenido = file_get_contents($direccion);
        $lista = inicioSesion::ObtenerUsuarios($contenido);  
        print_r($lista); 
        $existe = false; 
        if($lista != null){
            for( $i=0; $i<count($lista); $i++){
                if(trim($lista[$i]["nombre"]) == trim($nombre) && trim($lista[$i]["clave"]) == trim($clave)){
                    $existe = true;
                    $i = count($lista);
                }
            }
        }
        return $existe;
    }
    public function usuarioExiste($direccion,$nombre){

        $contenido = file_get_contents($direccion);
        $lista = inicioSesion::ObtenerUsuarios($contenido);  
        
        $existe = false; 
        echo 'tamaño: '.count($lista);
        if($lista != null){
            for( $i=0; $i<count($lista); $i++){
                echo "aqui";
                echo $lista[$i]["nombre"] .' = '.$nombre.'<br>';
                $temp = "";
                $temp = $lista[$i]["nombre"];
                if(trim($lista[$i]["nombre"]) == trim($nombre)){
                    echo 'si existe';
                    $existe = true;
                    $i = count($lista);
                }
            }
        }
        echo $existe . '<br>';
        return $existe;
    }
    public function obtenerRegistros(){
        $direccion = "../Datos/Usuarios.txt";
        $contenido = file_get_contents($direccion);
        $lista = inicioSesion::ObtenerUsuarios($contenido); 

        return  $lista;
    }
    public function ObtenerUsuarios($dato){
        $lista=array();
        $nombre = "";
        $clave = "";
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
                else if ($contador == 1){
                    $clave = $temp;
                    $temp = "";
                }
            }else{
                array_push($lista,array("nombre"=>$nombre,"clave"=>$clave));
                $contador = 0;
            }
        }
        
        return $lista;
    }

    public function registrarUsuario(){
        session_start();
        if(isset($_POST['nombre']) && isset($_POST['clave'])){
            $direccion = "../Datos/Usuarios.txt";
            $existe = inicioSesion::usuarioExiste($direccion,$_POST['nombre']);
            if($existe){
                $_SESSION['respuesta'] = "El usuario ya existe";
                header('location: ../registro.php');
            }else{
                $direccion = "../Datos/Usuarios.txt";
                if(inicioSesion::escribirArchivo($direccion,$_POST['nombre'],$_POST['clave'])){
                    $_SESSION['respuesta'] = "El usuario ha sido creado exitosamente";
                    mkdir("../Almacenamiento/".$_POST['nombre'], 0700);
                    mkdir("../Almacenamiento/".$_POST['nombre']."/Compartido", 0700);
                    $file = fopen("../Almacenamiento/".$_POST['nombre']."/Compartido"."/archivos_compartidos.txt","a");
                    fclose($file);
                    header('location: ../registro.php');
                }else{
                    $_SESSION['respuesta'] = "Ocurrio un error al crear el usuario";
                    header('location: ../registro.php');
                }
                
            }
        }else{
            $_SESSION['respuesta'] = "No se pueden ingresar campos vacios";
            header('location: ../registro.php');
        }
    }

    public function escribirArchivo($direccion,$nombre,$clave){
        //incerto en el ecabezado del contacto
        $incerto = false;
        try{
            $file = fopen($direccion, "a+");
            $temp= $nombre.'$'.$clave."$|\n";
            fwrite($file, $temp);
            fclose($file);
            $incerto = true;
        }catch(Exception $e){
            $incerto = false;
        }
        return $incerto;
    }

 }

 if(isset($_POST['form'])){
    if($_POST['form'] == 1){
        $control = new inicioSesion();
        $control->validarUsuario();
    }
    else if($_POST['form'] == 2){
       $control = new inicioSesion();
       $control->registrarUsuario();
    }
 }
 

?>