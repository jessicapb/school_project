<?php

namespace App\School\Entities;

// Fitxers utilitzats
use App\School\Exceptions\BuildExceptions;
use App\School\Checks\Check;
use App\School\Checks\PatternChecker;
use App\School\Entities\User;

class Student extends User{
    protected ?int $id = null;
    protected string $dni;
    protected \DateTime $enrollment;
    protected int $user_id;

    public function __construct(string $name, string $surname, string $password, string $phonenumber, string $email, int $ident, string $dni, string $enrollment) {
        $message = "";
        $error = 0;
        
        try{
            parent::__construct($name, $surname, $password, $phonenumber, $email, $ident);
        } catch (BuildExceptions $ex) {
            $message .= $ex->getMessage();
        }
        
        if(($error = $this->setEnrollment($enrollment)) !=0){
            $message .= "Bad enrollment"; 
        }
        
        if (($error = $this->setDni($dni)) != 0){
            $message .= "Bad DNI";
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
    
    public function getEnrollment():string {
        return $this->enrollment->format('Y-m-d');
    }
    
    public function setEnrollment(string $enrollment): int {
        try{
            $this->enrollment = PatternChecker::checkDate($enrollment);
        }catch (DateException){
            return -6; 
        }
        return 0;
    }

    public function getUser_id(): int {
        return $this->user_id;
    }

    public function setUser_id($user_id):int{
        $this->user_id = $user_id;
        return 0;
    }
}