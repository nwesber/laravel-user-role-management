<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

/**
 * Class UserRepository
 *
 * Repository class for managing user data retrieval.
 */
class UserRepository
{
    /**
     * Get users with roles paginated.
     *
     * @param int|null $roleId The ID of the role to filter by.
     * @param int $perPage The number of users per page.
     * @return LengthAwarePaginator Paginated list of users with roles.
     */
    public function getUsers($roleId = null, $perPage)
    {
        try {
            $query = User::query()->with('roles');
            
            if ($roleId !== null) {
                $query->whereHas('roles', function ($subQuery) use ($roleId) {
                    $subQuery->where('roles.id', (int) $roleId);
                });
            }
        
            return $query->paginate($perPage);
        } catch (\Exception $e) {
            Log::error('Error fetching users by role: ' . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Create a new user with the provided data.
     *
     * @param array $data The data to create the user.
     * @return \App\Models\User The created user instance.
     */
    public function create(array $data)
    {
        try {
            return User::create($data);
        } catch(\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            throw $e;
        }
    }
}
