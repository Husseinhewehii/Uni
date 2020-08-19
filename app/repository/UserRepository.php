<?php

namespace App\repository;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;

    }

    public function getAll()
    {
        $users = User::query();
        return $users;
    }



}
