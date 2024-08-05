<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface CreateInterface
{
    public function create(array $data): ?Model;
}
