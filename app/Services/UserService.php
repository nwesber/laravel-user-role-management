<?php

namespace App\Services;

use App\Repositories\UserRepository;

/**
 * Class UserService
 *
 * Service class for managing user-related operations.
 */
class UserService
{
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository The user repository instance.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get users by role paginated.
     *
     * Retrieve users based on the specified role ID and paginate the results.
     *
     * @param int|null $roleId The ID of the role to filter users by.
     * @param int $perPage The number of users per page.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator The paginated list of users.
     */
    public function getUsers(int $perPage, int $roleId = null)
    {
        return $this->userRepository->getUsers($perPage, $roleId);
    }

    /**
     * Create a new user with the provided data and assign roles.
     *
     * @param array $userData The data to create the user.
     * @param array $roleIds The role IDs to assign to the user.
     * @return \App\Models\User|null The created user instance, or null if creation failed.
     */
    public function createUser(array $userData, array $roleIds)
    {
        $user = $this->userRepository->create($userData);
        $user->roles()->attach($roleIds);
        return $user;
    }

    /**
     * Update a user with the provided data.
     *
     * @param int $userId The ID of the user to update.
     * @param array $userData The data to update the user.
     * @return bool Whether the update was successful or not.
     */
    public function updateUser(int $userId, array $userData, array $roleIds)
    {
        $user = $this->userRepository->update($userId, $userData);
        $user->roles()->sync($roleIds);
        return $user;
    }

    /**
     * Delete the user with the provided ID.
     *
     * @param int $userId The ID of the user to be deleted.
     * @return bool True if the user was deleted successfully, otherwise false.
     */
    public function deleteUser(int $userId)
    {
        return $this->userRepository->delete($userId);
    }
}
