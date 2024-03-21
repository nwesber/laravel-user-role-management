<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * @param int $perPage The number of users per page.
     * @param int|null $roleId The ID of the role to filter users by.
     * @return LengthAwarePaginator The paginated list of users.
     */
    public function getUsers(int $perPage, int $roleId = null): LengthAwarePaginator
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
    public function createUser(array $userData, array $roleIds): ?User
    {
        $user = $this->userRepository->create($userData);
        $user->roles()->attach($roleIds);
        return $user;
    }

    /**
     * Retrieves a user by their ID.
     *
     * This method uses the repository's show function to retrieve a user. If the user is not found,
     * an exception will be thrown by the repository method.
     *
     * @param int $userId The ID of the user to retrieve.
     * @return User The retrieved user object.
     * @throws \Exception If the user cannot be found or if an error occurs during the retrieval process.
     */
    public function getUserById(int $userId): User
    {
        return $this->userRepository->show($userId);
    }

    /**
     * Update a user with the provided data.
     *
     * @param int $userId The ID of the user to update.
     * @param array $userData The data to update the user.
     * @return \App\Models\User The updated user instance.
     */
    public function updateUser(int $userId, array $userData, array $roleIds): User
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
    public function deleteUser(int $userId): bool
    {
        return $this->userRepository->delete($userId);
    }
}
