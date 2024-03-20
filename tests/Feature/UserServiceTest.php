<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_getUsersByRolePaginated_returns_users_with_role()
    {
        $this->seed();
        $userService = new UserService();
        $users = $userService->getUsersByRolePaginated(null, 30);
        $this->assertEquals(30, $users->count());
    }
}
