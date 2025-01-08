<?php

namespace App\School\Entities;

// Fitxers utilitzats
use App\School\Exceptions\BuildExceptions;
use App\School\Checks\Check;
use App\School\Checks\PatternChecker;

class Exam{
    protected string $nom;
    protected string $descripcio;
    protected \DateTime $dia;
    
    public function __construct(string $nom, string $descripcio, string $dia){
        $message = "";
        $error = 0;
        if(($error = $this->setNom($nom)) !=0){
            $message .= "Bad name"; 
        }
        
        if(($error = $this->setDescripcio($descripcio)) !=0){
            $message .= "Bad description";
        }
        
        if(($error = $this->setDia($dia)) !=0){
            $message .= "Bad day";
        }
        
        if (strlen($message) > 0) {
            throw new BuildExceptions("No es pot crear " . $message);
        }
    }
    
    public function getNom(): string{
        return $this->nom;
    }
    
    public function setNom(string $nom): int{
        if(Check::isNull($nom) == true){
            return -1;
        }
        
        if(Check::minLenght($nom,3) !=0){
            return -2;
        }
        $this->nom = $nom;
        return 0;
    }
    
    public function getDescripcio(): string{
        return $this->descripcio;
    }
    
    public function setDescripcio(string $descripcio): int{
        if(Check::isNull($descripcio) == true){
            return -1;
        }
        
        if(Check::minLenght($descripcio,2) !=0){
            return -2;
        }
        $this->descripcio = $descripcio;
        return 0;
    }
    
    public function getDia():string {
        return $this->dia->format('Y-m-d');
    }
    
    public function setDia(string $dia): int {
        try{
            $this->dia = PatternChecker::checkDate($dia);
        }catch (DateException){
            return -6; 
        }
        return 0;
    }
}