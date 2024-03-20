<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{   

    protected $userService;

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
            // Retrieve the number of users per page from the request, defaulting to 30 if not provided
            $perPage = $request->input('per_page', 30);

            // Retrieve the role ID from the request
            $roleId = $request->input('role_id');

            // Call the UserService to fetch users by role, paginated
            $usersByRole = $this->userService
                ->getUsersByRolePaginated($roleId, $perPage);
            
            // Return a collection of User resources
            return UserResource::collection($usersByRole);
        } catch (\Exception $e) {
            // If an exception occurs, return an error response with an appropriate message and status code
            return response()->json(
                ['error' => 'An error occurred while fetching users.'], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
