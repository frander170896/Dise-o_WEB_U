<?php
    class unidad{

        var $valor;
        var $nombre;

        public function unidad($valor1,$nombre1){
            $this->valor = $valor1;
            $this->nombre = $nombre1;
        }

        public function getValor(){
            return $this->valor;
        }
        public function getNombre(){
            return $this->nombre;
        }
      

    }

?>