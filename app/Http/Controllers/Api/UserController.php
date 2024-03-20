<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

/**
 * Controller class for managing user-related actions.
 *
 * This controller handles CRUD operations for users, including
 * fetching user data, creating new users, updating existing users,
 * deleting users, and assigning user roles.
 */
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
            
            if (!filter_var($roleId, FILTER_VALIDATE_INT)) {
                $roleId = null;
            }

            $usersByRole = $this->userService->getUsers($perPage, $roleId);

            return UserResource::collection($usersByRole);
        } catch (\Exception $e) {
            Log::error('Error fetching users by role: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve users',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
            return response()->json([
                'message' => 'Failed to create user',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update an existing user.
     *
     * @param UpdateUserRequest $request The request containing the updated user data.
     * @param User $user The user instance to be updated.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the updated user resource.
     */
    public function update(UpdateUserRequest $request, User $user) {
        try {
            $validatedData = $request->validated();
            $roleIds = $validatedData['role_ids'] ?? [];
            unset($validatedData['role_ids']);

            $user = $this->userService->updateUser($user->id, $validatedData, $roleIds);

            return (new UserResource($user))
                ->response()
                ->setStatusCode(200)
                ->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            Log::error('Error creating user with role: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete an existing user.
     *
     * @param User $user The user instance to be deleted.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating success or failure.
     */
    public function destroy(User $user)
    {
        try {
            $this->userService->deleteUser($user->id);
            return response()->json(['message' => 'User deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to delete user',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
