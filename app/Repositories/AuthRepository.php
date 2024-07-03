<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    public function create(array $user)
    {
        return User::create($user);
    }
}