<?php 

namespace App\School\Entities;

use App\School\Entities\Subject;
use App\School\Checks\Check;
use App\School\Exceptions\BuildExceptions;

class Course{
    protected string $name;
    protected string $degree;
    protected $subjects=[];

    function __construct(string $degree, string $grau){
        $message = "";
        $error = 0;
        $this->name=$name;
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
    
    public function getDegree(): string{
        return $this->name;
    }
    
    public function setDegree(string $degree): int{
        if(Check::isNull($degree) == true){
            return -1;
        }
        
        if(Check::minLenght($degree, 1))
        $this->degree = $degree;
        return 0;
    }
    
    public function addSubject(Subject $subject){
        $this->subjects[]=$subject;
        return $this;
    }
}