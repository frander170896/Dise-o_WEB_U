<?php

class contacto{
    private $name;
    private $work;
    private $mobile;
    private $email;
    private $address;
    private $state;

    public function contacto($name,$work,$mobile,$email,$address){
        $this->name = $name;
        $this->work = $work;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->address = $address;

    }


}


?>