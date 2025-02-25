<?php

namespace App\School\Services;

use App\Infrastructure\Persistence\UserRepository;
use App\School\Entities\User;
class UserServices{
    private \PDO $db;
    private UserRepository $UserRepository;

    function __construct(\PDO $db, UserRepository $UserRepository){
        $this->db = $db;
        $this->UserRepository = $UserRepository;
    }

    function saves(User $user){
        $userId = $this->UserRepository->saveUser($user);  
        return $userId; 
    }

    function findById($id){
        return $this->UserRepository->findById($id);
    }
}