<?php

namespace App\Infrastructure\Persistence;
use App\School\Repositories\IUserRepository;
use App\School\Entities\User;

class UserRepository implements IUserRepository{
    private \PDO $db;

    function __construct(\PDO $db){
        $this->db = $db;
    }

    function saveUser(User $user){
        try {
            $sql = $this->db->prepare("INSERT INTO users(name, surname, password, phonenumber, email, ident) 
                                VALUES(:name, :surname, :password, :phonenumber, :email, :ident)");
            $sql->execute([
                'name' => $user->getName(),
                'surname' => $user->getSurname(),
                'password' => $user->getPassword(),
                'phonenumber' => $user->getPhonenumber(),
                'email' => $user->getEmail(),
                'ident' => $user->getIdent()
            ]);

            $lastId = $this->db->lastInsertId();
            return $lastId;
        }  catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar l'usuari: " . $e->getMessage());
        }
    }

    function findById(string $id):User{
        try {
            $sql = $this->db->prepare("SELECT * FROM users WHERE id=:id");
            $sql->execute([
                'id' => $id
            ]);
            return $sql->fetchObject(User::class);
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar l'estudiant: " . $e->getMessage());
        }
    }
}