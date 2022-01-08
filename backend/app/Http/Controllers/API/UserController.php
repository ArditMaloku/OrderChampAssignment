<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserStoreRequest;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request)
    {
        return response()->json($this->userService->create($request), JsonResponse::HTTP_CREATED);
    }
}
