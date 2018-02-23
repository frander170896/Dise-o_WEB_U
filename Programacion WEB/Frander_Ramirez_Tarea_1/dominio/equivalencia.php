<?php 

    class equivalencia{
        var $nombre;
        var $centimetros;
        var $metros;
        var $kilometros;
        var $pulgadas;
        var $pies;
        var $yardas;
        var $milimetros;
        var $brazas;
        var $millas_tierra;
        var $millas_mar_eu;
        var $millas_mar_ru;

        function equivalencia($nombre,$centimetros, $metros,$kilometros,$pulgadas,$pies,$yardas,$milimetros,$brazas,$millas_tierra,$millas_mar_eu,$millas_mar_ru)
        {
            
            $this->nombre = $nombre;
            $this->centimetros = $centimetros;
            $this->metros = $metros;
            $this->kilometros = $kilometros;
            $this->pulgadas = $pulgadas;
            $this->pies = $pies;
            $this->yardas = $yardas;
            $this->milimetros = $milimetros;
            $this->brazas = $brazas;
            $this->millas_tierra = $millas_tierra;
            $this->millas_mar_eu = $millas_mar_eu;
            $this->millas_mar_ru = $millas_mar_ru;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getBrazas(){
            return $this->brazas;
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
        public function getMillasTierra(){
            return $this->millas_tierra;
        }
        public function getMillasMarEU(){
            return $this->millas_mar_eu;
        }
        public function getMillasMarRU(){
            return $this->millas_mar_ru;
        }
    }
?>