<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'Author'],
            ['id' => 2, 'name' => 'Editor'],
            ['id' => 3, 'name' => 'Subscriber'],
            ['id' => 4, 'name' => 'Administrator'],
        ];

        // Insert roles into database
        Role::insert($roles);
    }
}
