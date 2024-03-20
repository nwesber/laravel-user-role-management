<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
    public function getUsersByRolePaginated($roleId = null, $perPage)
    {
        $query = User::query()->with('roles');
        
        if ($roleId !== null) {
            $query->whereHas('roles', function ($subQuery) use ($roleId) {
                $subQuery->where('id', $roleId);
            });
        }
    
        return $query->paginate($perPage);
    }
}
