<?php

namespace App\School\Repositories;

use App\School\Entities\User;

interface IUserRepository{
    public function saveUser(User $user);
    public function findById(string $id);
}