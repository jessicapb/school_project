<?php

namespace App\School\Entities;

use App\School\Exceptions\BuildExceptions;
use App\School\Checks\Check;

class Degrees{
    protected string $name;
    protected int $duration_years;

    public function __construct(string $name, int $duration_years){
        $message = "";
        $error = 0;
        
        if(($error = $this->setName($name)) !=0){
            $message .= "Bad name";
        }
        
        if(($error = $this->setDurationYears($duration_years)) !=0){
            $message .= "Bad duration years";
        }
        
        if(strlen($message) > 0){
            throw new BuildExceptions("No es pot crear " . $message);
        }
    }
    
    public function getName(): string{
        return $this->name;
    }
    
    public function setName(string $name): int{
        if(Check::isNull($name) == true){
            return -1;
        }
        
        if(Check::minLenght($name, 3) !=0){
            return -2;
        }
        $this->name = $name;
        return 0;
    }
    
    public function getDurationYears(): int{
        return $this->duration_years;
    }
    
    public function setDurationYears(int $duration_years): int{
        if(Check::isNull($duration_years) == true){
            return -1;
        }
        
        if(Check::minLenght($duration_years,1) !=0){
            return -2;
        }
        $this->duration_years = $duration_years;
        return 0;
    }
}