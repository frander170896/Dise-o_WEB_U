<?php 

    class equivalencia_velocidad{
        var $nombre;
        var $kilometros_h;
        var $kilometros_s;
        var $metros;
        var $milimetros;
        var $nudos;
        var $millas_s;
        var $millas_h;
        
    
        function equivalencia_velocidad($nombre,$kilometros_h, $metros,$kilometros_s,$milimetros,$nudos,$millas_h,$millas_s)
        {
            
            $this->nombre = $nombre;
            $this->kilometros_h = $kilometros_h;
            $this->metros = $metros;
            $this->kilometros_s = $kilometros_s;
            $this->milimetros = $milimetros;
            $this->nudos = $nudos;
            $this->millas_h = $millas_h;
            $this->millas_s = $millas_s;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getKilometros_s(){
            return $this->kilometros_s;
        }
        public function getMetros(){
            return $this->metros;
        }
        public function getKilometros_h(){
            return $this->kilometros_h;
        }
        public function getMilimetros(){
            return $this->milimetros;
        }
        public function getNudos(){
            return $this->nudos;
        }
        public function getMillas_h(){
            return $this->millas_h;
        }
        public function getMillas_s(){
            return $this->millas_s;
        }
    }
?>