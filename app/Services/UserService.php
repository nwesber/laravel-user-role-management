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
    public function getUsersByRolePaginated($roleId = null, $perPage)
    {
        return $this->userRepository->getUsersByRolePaginated($roleId, $perPage);
    }
}
