<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;
    protected $mockUserRepository;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a mock instance of UserRepository
        $this->mockUserRepository = Mockery::mock(UserRepository::class);

        // Create an instance of UserService with the mock repository
        $this->userService = new UserService($this->mockUserRepository);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        
        // Close the Mockery instance
        Mockery::close();
    }

    /**
     * Test to ensure that getUsersByRolePaginated returns users with a specific role.
     *
     * @return void
     */
    public function test_getUsersByRolePaginated_returns_users_with_role()
    {
        $this->seed();
        $userService = new UserService(new UserRepository);
        $users = $userService->getUsers(30, null);
        $this->assertEquals(30, $users->count());
    }

    /**
     * Test to ensure that createUser method creates a user with specified roles.
     *
     * @return void
     */
    public function test_createUser_creates_user_with_roles()
    {
        // Seed the database with roles
        $this->seed();
    
        // Create a user
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    
        // Sample role IDs
        $roleIds = [1, 2, 3];
    
        // Ensure that the provided role IDs exist in the roles table
        foreach ($roleIds as $roleId) {
            $this->assertNotNull(Role::find($roleId), "Role with ID $roleId does not exist.");
        }
    
         // Mock the UserRepository create method to return a mock user instance
        $mockedUser = Mockery::mock(User::class);
        $mockedUser->shouldReceive('getAttribute')
            ->andReturnUsing(function ($attribute) use ($user) {
                return $user->{$attribute};
            });
        $this->mockUserRepository->shouldReceive('create')
            ->once()
            ->with($user->toArray())
            ->andReturn($mockedUser);

        // Mock the roles relationship and attach method
        $rolesRelationMock = Mockery::mock(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class);
        $mockedUser->shouldReceive('getAttribute')
            ->andReturn('mockedAttributeValue');
        $mockedUser->shouldReceive('roles')
            ->once()
            ->andReturn($rolesRelationMock);
        $rolesRelationMock->shouldReceive('attach')
            ->once()
            ->with($roleIds);

        // Call the createUser method
        $createdUser = $this->userService->createUser($user->toArray(), $roleIds);

        // Assertions
        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals($user->name, $createdUser->name);
        $this->assertEquals($user->email, $createdUser->email);
    }
}
