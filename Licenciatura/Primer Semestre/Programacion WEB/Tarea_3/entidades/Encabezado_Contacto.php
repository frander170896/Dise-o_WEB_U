<?php

class Encabezado_Contacto{

    private $id;
    private $name;
    private $state;

    public function Encabezado_Contacto($name,$id,$state){
        $this->id = $id;
        $this->name = $name;
        $this->state = $state;
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getState(){
        return $this->state;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setState($state){
        $this->state = $state;
    }
}


?>