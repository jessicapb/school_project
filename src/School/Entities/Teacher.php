<?php

namespace App\School\Entities;

// Fitxers utilitzats
use App\School\Exceptions\BuildExceptions;
use App\School\Checks\Check;
use App\School\Checks\PatternChecker;

class Teacher{
    protected ?int $id = null;
    protected string $name;
    protected string $surname;
    protected string $dni;
    protected string $email;
    protected ?int $department_id = null;

    public function __construct(string $name, string $surname, string $dni, string $email){
        $message = "";
        $error = 0;
        
        if(($error = $this->setName($name)) !=0){
            $message .="Bad name, ";
        }
        
        if(($error = $this->setSurname($surname)) !=0){
            $message .="Bad surname, ";
        }
        
        if (($error = $this->setDni($dni)) != 0){
            $message .= "Bad DNI";
        }
        
        if(($error = $this->setEmail($email)) !=0){
            $message .= "Bad email";
        }
        
        if (strlen($message) > 0) {
            throw new BuildExceptions("No es pot crear " . $message);
        }
    }

    public function getId(): ?int{
        return $this->id;
    }
    
    public function setId(?int $id): int{
        $this->id = $id;
        return 0;
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
    
    public function getDni(): string {
        return $this->dni;
    }
    
    public function setDni(string $dni): int {
        if(Check::isNull($dni) == true){
            return -1;
        }
        
        if(Check::minLenght($dni, 3) !=0){
            return -2;
        }
        
        if(PatternChecker::checkDNI($dni) == false){
            return -8;
        }
        $this->dni = $dni;
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
    
    public function getDepartmentId(): ?int {
        return $this->department_id;
    }
    
    public function setDepartamentId(?int $department_id): int {
        $this->department_id = $department_id;
        return 0;
    }
}

