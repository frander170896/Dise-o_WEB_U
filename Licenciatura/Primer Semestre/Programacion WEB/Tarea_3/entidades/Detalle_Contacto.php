<?php

    class Detalle_Contacto{
        private $work;
        private $mobile;
        private $email;
        private $address;
       
        public function Detalle_Contacto($work,$mobile,$email,$address){
        
            $this->work = $work;
            $this->mobile = $mobile;
            $this->email = $email;
            $this->address = $address;
            
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


    }


?>