<?php

namespace App\School\Entities; //agrupa classes

// Fitxers utilitzats
use App\School\Exceptions\BuildExceptions;
use App\School\Checks\Check;
use App\School\Checks\PatternChecker;

class User{
    protected string $name;
    protected string $surname;
    protected string $password;
    protected string $phonenumber;
    protected string $email;
    protected string $ident;
    
    public function __construct(string $name, string $surname, string $password, string $phonenumber, string $email, string $ident) {
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
            throw new BuildExceptions("No es pot crear " . $message);
        }
    }
    
    public function getName():string {
        return $this->name;
    }
    
    public function setName(string $name) {
        if(Check::isNull($name) == true){
            return -1;
        }
        
        if(Check::minLenght($name, 3) !=0){
            return -2;
        }
        $this->name = $name;
        return 0;
    }

    public function getSurname():string {
        return $this->surname;
    }
    
    public function setSurname(string $surname):int {
        if(Check::isNull($surname) == true){
            return -1;
        }
        
        if(Check::minLenght($surname, 3) !=0){
            return -2;
        }
        $this->surname = $surname;
        return 0;
    }
    
    public function getPassword():string {
        return $this->password;
    }

    public function setPassword(string $password):int {
        if(Check::isNull($password) == true){
            return -1;
        }
        
        if(Check::minLenght($password, 7) !=0){
            return -2;
        }
        $this->password = $password;
        return 0;
    }
    
    public function getPhonenumber():string {
        return $this->phonenumber;
    }

    public function setPhonenumber(string $phonenumber): int {
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
    
    public function getEmail():string {
        return $this->email;
    }

    public function setEmail(string $email): int {
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

    public function getIdent():string {
        return $this->ident;
    }

    public function setIdent(string $ident): int {
        if(Check::isNull($ident) == true){
            return -1;
        }
        
        if(Check::minLenght($ident, 10) !=0 ){
            return -2;
        }
        $this->ident = $ident;
        return 0;
    }
}