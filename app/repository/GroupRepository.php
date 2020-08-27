<?php

namespace App\repository;

use App\Models\Group;
use Illuminate\Support\Collection;

class GroupRepository
{

    protected $group;

    public function __construct(Group $group)
    {
        $this->group = $group;

    }

    public function getAll()
    {
        $groups = Group::query();

        return $groups;
    }



}
