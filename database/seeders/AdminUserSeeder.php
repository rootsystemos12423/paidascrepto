<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user = User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make(env('ADMIN_PASSWORD')), // Defina uma senha forte
            'email_verified_at' => now(),
        ]);

        $role = Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole($role);
    }
}
