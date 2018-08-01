<?php 

 class incioSesion{

    public function incioSesion(){}

    public function validarUsuario(){
        session_start();
        if(isset($_POST['nombre']) && isset($_POST['clave'])){
            $existe = incioSesion::usuarioExiste($_POST['nombre'],$_POST['clave']);
            if($existe){
                $_SESSION['user'] = $_POST['nombre'];
                $_SESSION['pass'] = $_POST['clave'];
                header('location: Interfaz/PaginaPrincipal.php');
            }else{
                $_SESSION['respuesta'] = "El usuario o la contraseña son incorrectos";
                header('location: index.php');
            }
        }else{
            $_SESSION['respuesta'] = "No se ha ingresado el usuario o la contraseña";
            header('location: index.php');
        }
    }
    public function usuarioExiste($nombre,$contraseña){
        // aqui hacemos la verificacion en el archivo de ususario
    }

 }

 if(isset($_POST['nombre'])){
     $control = new incioSesion();
     $control->validarUsuario();
 }

?>