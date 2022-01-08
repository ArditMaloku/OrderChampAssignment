<?php

namespace App\Interfaces\Services;

use App\Http\Requests\UserStoreRequest;

interface UserServiceInterface
{
    public function create(UserStoreRequest $request);
}
