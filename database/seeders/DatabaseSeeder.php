<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!Role::where('alias', 'admin')->first()) {
            $roleAdmin = Role::factory()->create([
                'name'  => 'Admin',
                'alias' => 'admin',
            ]);

            $admin = User::factory()->create([
                'name'     => 'Admin',
                'email'    => 'admin@test.com',
                'password' => bcrypt('12345')
            ]);

            UserRole::factory()->create([
                'user_id' => $admin->id,
                'role_id' => $roleAdmin->id
            ]);
        }

        if (!Role::where('alias', 'user')->first()) {
            $roleUser = Role::factory()->create([
                'name'  => 'User',
                'alias' => 'user',
            ]);

            $user = User::factory()->create([
                'name'     => 'User',
                'email'    => 'user@test.com',
                'password' => bcrypt('12345')
            ]);

            UserRole::factory()->create([
                'user_id' => $user->id,
                'role_id' => $roleUser->id
            ]);
        }
    }
}
