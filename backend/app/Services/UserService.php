<?php

namespace App\Services;

use App\Http\Requests\UserStoreRequest;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(UserStoreRequest $request)
    {
        return $this->userRepository->create($request->all());
    }
}
