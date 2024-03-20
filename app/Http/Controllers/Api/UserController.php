<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{   

    /**
     * The user service instance.
     *
     * @var UserService
     */
    protected $userService;

    /**
     * UserService constructor.
     *
     * @param UserService $userService The user service instance.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $perPage = $request->input('per_page', 30);
            $roleId = $request->input('role_id');

            $usersByRole = $this->userService
                ->getUsers($perPage, $roleId);

            return UserResource::collection($usersByRole);
        } catch (\Exception $e) {
            Log::error('Error fetching users by role: ' . $e->getMessage());
            return response()->json(
                ['error' => 'An error occurred while fetching users.'], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Create a new user.
     *
     * @param CreateUserRequest $request The request containing user data.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the created user resource.
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $roleIds = $validatedData['role_ids'] ?? [];
            unset($validatedData['role_ids']);
    
            $user = $this->userService->createUser($validatedData, $roleIds);
    
            return (new UserResource($user))
                ->response()
                ->setStatusCode(201)
                ->header('Content-Type', 'application/json');

        } catch (\Exception $e) {
            Log::error('Error creating user with role: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to create user', 'error' => $e->getMessage()], 500);
        }
    }
}
