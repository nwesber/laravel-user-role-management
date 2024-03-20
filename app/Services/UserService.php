<?php

namespace App\Services;

use App\Models\User;

class UserService
{
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
