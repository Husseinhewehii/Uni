<?php

namespace App\repository;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;

    }

    public function getAll(Request $request)
    {
        $users = User::query();

        if ($request->filled("type")) {
            $users->where('type', '=', $request->get('type'));
        }

        return $users;
    }



}
