<?php
    if(isset($_POST['cerrar'])){
        if($_POST['cerrar'] == 1){
            $cont = new cerrarSesion();
            $cont->cerrar();
        }
    }
    class cerrarSesion{

        public function cerrarSesion(){}

        public function cerrar(){
            session_start();
            if(isset($_SESSION['user'])){
                session_destroy();
                header('location:../index.php');
            }
        }
    } 

?>