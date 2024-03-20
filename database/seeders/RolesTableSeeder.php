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
            ['name' => 'Author'],
            ['name' => 'Editor'],
            ['name' => 'Subscriber'],
            ['name' => 'Administrator'],
        ];

        // Insert roles into database
        Role::insert($roles);
    }
}
