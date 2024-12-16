<?php

namespace App\School\Entities; //agrupa classes

// Fitxers utilitzats
use App\School\Exceptions\BuildExceptions;
use App\School\Checks\Check;
use App\School\Checks\PatternChecker;

abstract class User{
    protected $name;
    protected $surname;
    protected $password;
    protected $phonenumber;
    protected $email;
    protected $ident;
    protected ?\DateTime $createdAt=null; //emagatzema la bd
    protected ?\DateTime $updatedAt=null; // emmagatzema la bd
    
    public function __construct($name, $surname, $password, $phonenumber, $email, $ident) {
        $message = "";
        $error = 0;
        
        if($error = $this->setName($name) !=0){
            $message .="Bad name, ";
        }
        
        if($error = $this->setSurname($surname) !=0){
            $message .="Bad surname, ";
        }
        
        if($error = $this->setPassword($password) !=0){
            $message .="Bad password, ";
        }
       
        if($error = $this->setPhonenumber($phonenumber) !=0){
            $message .= "Bad phonenumber";
        }
       
        if($error = $this->setEmail($email) !=0){
            $message .= "Bad email";
        }
        
        if($error = $this->setIdent($ident) !=0){
            $message .= "Bad ident";
        }
          
        if (strlen($message) > 0) {
            throw new BuildExceptions("Not posible create the object: " . $message);
        }
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name): int {
        if(Check::isNull($name) == true){
            return -1;
        }
        
        if(Check::minLenght($name, 3) !=0){
            return -2;
        }
        $this->name = $name;
        return 0;
    }

    public function getSurname() {
        return $this->surname;
    }
    
    public function setSurname($surname): int {
        if(Check::isNull($surname) == true){
            return -1;
        }
        
        if(Check::minLenght($surname, 3) !=0){
            return -2;
        }
        $this->surname = $surname;
        return 0;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password): int {
        if(Check::isNull($password) == true){
            return -1;
        }
        
        if(Check::minLenght($password, 7) !=0){
            return -2;
        }
        
        if(Check::isNegative($password, -1) !=0){
            return -3;
        }
        $this->password = $password;
        return 0;
    }
    
    public function getPhonenumber() {
        return $this->phonenumber;
    }

    public function setPhonenumber($phonenumber): int {
        if(Check::isNull($phonenumber) == true){
            return -1;
        }
        
        if(Check::minLenght($phonenumber, 1) !=0){
            return -2;
        }
        
        if(PatternChecker::checkPhone($phonenumber) == false){
            return -7;
        }
        $this->phonenumber = $phonenumber;
        return 0;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email): int {
        if(Check::isNull($email) == true){
            return -1;
        }
        
        if(Check::minLenght($email, 1) !=0){
            return -2;
        }
        
        if(PatternChecker::checkEmail($email) == false){
            return -5;
        }
        $this->email = $email;
        return 0;
    }

    public function getIdent() {
        return $this->ident;
    }

    public function setIdent($ident): int {
        if(Check::isNull($ident) == true){
            return -1;
        }
        
        if(Check::minLenght($ident, 5) !=0 ){
            return -2;
        }
        
        if(Check::isNegative($ident, -1) !=0){
            return -3;
        }
        $this->ident = $ident;
        return 0;
    }
}