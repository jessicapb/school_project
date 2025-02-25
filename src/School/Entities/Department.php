<?php

namespace App\School\Entities;

use App\School\Exceptions\BuildExceptions;
use App\School\Checks\Check;
use App\School\Checks\PatternChecker;

class Department{
    protected ?int $id = null;
    protected string $name;
    protected string $people;

    public function __construct(string $name, string $people){
        $message = "";
        $error = 0;
        if(($error = $this->setName($name)) !=0){
            $message .= "Bad name";
        }
        
        if(($error = $this->setPeople($people)) !=0){
            $message .= "Bad number of people";
        }        
        
        
        if(strlen($message) > 0){
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
    
    public function getPeople(): string{
        return $this->people;
    }
    
    public function setPeople(string $people): int{
        if(Check::isNull($people) == true){
            return -1;
        }
        
        if(Check::minLenght($people, 1) !=0){
            return -2;
        }
        $this->people = $people;
        return 0;
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
}