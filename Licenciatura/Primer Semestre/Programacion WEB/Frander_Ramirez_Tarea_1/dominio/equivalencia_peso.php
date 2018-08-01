<?php 

    class equivalencia_peso{
        var $nombre;
        var $gramos;
        var $kilogramos;
        var $onzas;
        var $libras;
     
        function equivalencia_peso($nombre,$gramos,$kilogramos,$onzas,$libras)
        {
            
            $this->nombre = $nombre;
            $this->gramos = $gramos;
            $this->kilogramos = $kilogramos;
            $this->onzas = $onzas;            
            $this->libras = $libras;
        }

        public function getNombre(){
            return $this->nombre;
        }
        public function getGramos(){
            return $this->gramos;
        }
        public function getKilogramos(){
            return $this->kilogramos;
        }
        public function getOnzas(){
            return $this->onzas;
        }
        public function getLibras(){
            return $this->libras;
        }
    }
?>