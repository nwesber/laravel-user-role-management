<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

/**
 * Class UserRepository
 *
 * Repository class for managing user data operations.
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
    public function getUsers(int $perPage, int $roleId = null): LengthAwarePaginator
    {
        try {
            $query = User::query()->with('roles');

            if ($roleId !== null) {
                $query->whereHas('roles', function ($subQuery) use ($roleId) {
                    $subQuery->where('roles.id', (int) $roleId);
                });
            }

            $query->orderBy('id', 'desc');
            return $query->paginate($perPage);
        } catch (\Exception $exception) {
            Log::error('Error fetching users by role: ' . $exception->getMessage());
            throw $exception;
        }
    }

    /**
     * Create a new user with the provided data.
     *
     * @param array $data The data to create the user.
     * @return \App\Models\User The created user instance.
     */
    public function create(array $data): User
    {
        try {
            return User::create($data);
        } catch (\Exception $exception) {
            Log::error('Error creating user: ' . $exception->getMessage());
            throw $exception;
        }
    }

    /**
     * Retrieves the user with the provided ID.
     *
     * This function attempts to find and return the user with the specified ID. If the user cannot be found,
     * an exception is thrown and logged, indicating that the user with the provided ID does not exist.
     *
     * @param int $userId The ID of the user to be retrieved.
     * @return User The user object if found successfully.
     * @throws \Exception If the user cannot be found or if an error occurs during the retrieval process.
     */
    public function show(int $userId): User
    {
        try {
            return User::findOrFail($userId);
        } catch (\Exception $exception) {
            Log::error('Error deleting user: ' . $exception->getMessage());
            throw $exception;
        }
    }

    /**
     * Update the user with the provided ID and data.
     *
     * @param int $userId The ID of the user to update.
     * @param array $userData The data to update the user.
     * @return \App\Models\User The updated user instance.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the user is not found.
     */
    public function update(int $userId, array $userData): User
    {
        try {
            $user = User::findOrFail($userId);
            $user->update($userData);

            return $user;
        } catch (ModelNotFoundException $exception) {
            Log::error('Error updating user: ' . $exception->getMessage());
            throw new ModelNotFoundException("User with ID {$userId} not found.");
        }
    }

    /**
     * Delete the user with the provided ID.
     *
     * @param int $userId The ID of the user to be deleted.
     * @return bool True if the user was deleted successfully, otherwise false.
     * @throws \Exception If an error occurs during the deletion process.
     */
    public function delete(int $userId): bool
    {
        try {
            $user = User::findOrFail($userId);
            return $user->delete();
        } catch (\Exception $exception) {
            Log::error('Error deleting user: ' . $exception->getMessage());
            throw $exception;
        }
    }
}
