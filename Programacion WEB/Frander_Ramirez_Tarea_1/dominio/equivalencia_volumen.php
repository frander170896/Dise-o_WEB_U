<?php 

    class equivalencia_volumen{
        var $nombre;
        var $pulgadas;
        var $pies;
        var $yardas;
        var $centimetros;
        var $decimetro;
        var $metros;
        

        function equivalencia_volumen($nombre,$pulgadas,$pies,$yardas,$centimetros,$decimetro,$metros)
        {
            
            $this->nombre = $nombre;
            $this->pulgadas = $pulgadas;
            $this->pies = $pies;
            $this->yardas = $yardas;            
            $this->centimetros = $centimetros;
            $this->decimetro = $decimetro;
            $this->decimetro = $decimetro;
            
        }

        public function getNombre(){
            return $this->nombre;
        }
        public function getDecimetro(){
            return $this->decimetro;
        }
        public function getCentimetros(){
            return $this->centimetros;
        }
        public function getMetros(){
            return $this->metros;
        }
        public function getPulgadas(){
            return $this->pulgadas;
        }
        public function getPies(){
            return $this->pies;
        }
        public function getYardas(){
            return $this->yardas;
        }
    }
?>