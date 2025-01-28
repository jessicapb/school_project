<?php 

namespace App\School\Entities;

use App\School\Entities\Subject;
use App\School\Checks\Check;
use App\School\Exceptions\BuildExceptions;

class Course{
    protected int $id;
    protected string $name;
    protected string $description;
    protected string $degree;
    protected array $subjects = [];

    public function __construct(string $name, string $description, string $degree, array $subjects){
        $message = "";
        $error = 0;
        if(($error = $this->setName($name)) !=0){
            $message .= "Bad name";
        }
        
        if(($error = $this->setDescription($description)) !=0){
            $message .="Bad description";
        }
        
        if(($error = $this->setDegree($degree)) !=0){
            $message .="Bad degree";
        }
        
        $this->subjects = $subjects;
        if(strlen($message)>0){
            throw new BuildExceptions("No es pot crear" . $message);
        }
    }
    
    public function getId(): int{
        return $this->id;
    }
    
    public function setId(int $id) {
        $this->id = $id;
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
    
    public function getDescription (): string{
        return $this->description;
    }
    
    public function setDescription(string $description): int{
        if(Check::isNull($description) == true){
            return -1;
        }
        
        if(Check::minLenght($description, 3) !=0){
            return -2;
        }
        $this->description = $description;
        return 0;
    }

    public function getDegree(): string{
        return $this->name;
    }
    
    public function setDegree(string $degree): int{
        if(Check::isNull($degree) == true){
            return -1;
        }
        
        if(Check::minLenght($degree, 1) !=0){
            return -2;
        }
        $this->degree = $degree;
        return 0;
    }
    
    public function getSubjects(): array{
        return $this->subjects;
    }
    
    /*public function setSubjects(array $subjects): int{
        if(Check::isNull($subjects) == true){
            return -1;
        }
        
        if(Check::minLenght($subjects, 3) !=0){
            return -2;
        }
        $this->subjects = $subjects;
        return 0;
    }*/
    
    public function addSubject(Subject $subject){
        $this->subjects[]=$subject;
        return $this;
    }
}