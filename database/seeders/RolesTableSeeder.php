<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definindo as roles
        $roles = [
            'admin',
            'suporte',
            'shark',
            'lion',
            'bear',
        ];

        // Criando as roles no banco de dados
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
