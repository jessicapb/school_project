<?php

namespace App\School\Checks; //agrupa classes

use App\School\Exceptions\DateExceptions;

class PatternChecker {
    public static function checkEmail(string $email): bool {
        $RE = '/^[^_,-.](\\w+)(.?){10,15}[^.][@][a-z]{5,7}[.][a-z]{2,10}$/';
        if (preg_match($RE, $email)) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkPhone(string $phone): bool {
        $RE = '/^34 6[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}$/';
        if (preg_match($RE, $phone)) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkDNI(string $dni):bool{
        $RE = '/^\d{8}[A-Z]{1}$/'; 
        if (preg_match($RE, $dni)) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkYear(string $year):bool{
        $RE = '/^\d{4}$/';
        if(preg_match($RE, $year)){
            return true;
        }else{
            return false;
        }
    }

    public static function checkDate(string $date): \DateTime {
        $patron = "~^\d{4}-\d{2}-\d{2}$~"; 
        
        if (!preg_match($patron, $date)) {
            throw new DateException("La data proporcionada no és correcta. El format ha de ser YYYY-MM-DD.");
        }
    
        $fechaCorrecta = \DateTime::createFromFormat('Y-m-d', $date);
        if (!$fechaCorrecta) {
            throw new DateException("La data proporcionada no és vàlida.");
        }
        return $fechaCorrecta;
    }

    public static function getErrorMessage(int $e): string {
        switch ($e) {
            case 0: return "Done";
            case -5: return "Bad pattern Email";
            case -6: return "Bad pattern Date";
            case -7: return "Bad pattern Phone";
            case -8: return "Bad pattern DNI";
            case -9: return "Bad pattern Year";
        }
    }
}