<?php

namespace App\School\Entities;

use App\School\Checks\Check;
use App\School\Exceptions\BuildExceptions;

class Subject{
    protected ?int $id = null;
    protected string $name;
    protected string $description;
    protected ?int $course_id = null;

    public function __construct(string $name, string $description){
        $message = "";
        $error = 0;
        if(($error = $this->setName($name)) !=0){
            $message .= "Bad name";
        }
        
        if(($error = $this->setDescription($description)) !=0){
            $message .= "Bad description";
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
        
        if(Check::minLenght($name,3) !=0){
            return -2;
        }
        $this->name = $name;
        return 0;
    }
    
    public function getDescription(): string{
        return $this->description;
    }
    
    public function setDescription(string $description): int{
        if(Check::isNull($description) == true){
            return -1;
        }
        
        if(Check::minLenght($description, 3)){
            return -2;
        }
        $this->description = $description;
        return 0;
    }
    
    public function getId(): ?int{
        return $this->id;
    }
    
    public function setId(?int $id): int{
        $this->id = $id;
        return 0;
    }
    
    public function getCourseId(): ?int{
        return $this->course_id;
    }

    public function setCourseId(?int $course_id): int{
        $this->course_id = $course_id;
        return 0;
    }
}