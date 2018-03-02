<?php

class contacto{

    private $id;
    private $name;
    private $work;
    private $mobile;
    private $email;
    private $address;
    private $state;

    public function contacto($name,$work,$mobile,$email,$address,$state,$id){
        $this->id = $id;
        $this->name = $name;
        $this->work = $work;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->address = $address;
        $this->state = $state;
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getWork(){
        return $this->work;
    }
    public function getMobile(){
        return $this->mobile;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getAddress(){
        return $this->address;
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
    public function setWork($work){
        $this->work = $work;
    }
    public function setMobile($mobile){
        $this->mobile = $mobile;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setAddress($address){
        $this->address = $address;
    }
    public function setState($state){
        $this->state = $state;
    }
}


?>