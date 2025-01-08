<?php

namespace App\School\Repositories;

use App\School\Entities\Degrees;

interface IDegreesRepository{
    public function save(Degrees $degrees);
    public function findByName($name);
}