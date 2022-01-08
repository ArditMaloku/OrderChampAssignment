<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function  __construct(User $user)
    {
        parent::__construct($user);
    }
}
