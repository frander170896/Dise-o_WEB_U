<?php 

    class equivalencia_superficie{
        var $nombre;
        var $milimetros;
        var $centimetros;
        var $metros;
        var $kilometros;
        var $pulgadas;
        var $pies;
        var $yardas;
        var $hectareas;
        var $millas;
        
    
        function equivalencia_superficie($nombre,$milimetros, $centimetros,$metros,$kilometros,$pulgadas,$pies,$yardas,$hectareas,$millas)
        {
            
            $this->nombre = $nombre;
            $this->centimetros = $centimetros;
            $this->metros = $metros;
            $this->kilometros = $kilometros;
            $this->pulgadas = $pulgadas;
            $this->pies = $pies;
            $this->yardas = $yardas;
            $this->milimetros = $milimetros;
            $this->hectareas = $hectareas;
            $this->millas = $millas;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getCentimetros(){
            return $this->centimetros;
        }
        public function getMetros(){
            return $this->metros;
        }
        public function getKilometros(){
            return $this->kilometros;
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
        public function getMilimetros(){
            return $this->milimetros;
        }
        public function getHectareas(){
            return $this->hectareas;
        }
        public function getMillas(){
            return $this->millas;
        }
       
    }
?>