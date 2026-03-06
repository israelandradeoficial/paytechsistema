<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'slug' => 'manage_users',
                'name' => 'Gestão de Usuários',
                'description' => 'Permite criar, editar e excluir usuários do sistema.',
            ],
            [
                'slug' => 'manage_clients',
                'name' => 'Gestão de Clientes',
                'description' => 'Permite gerenciar o cadastro de clientes e assinaturas.',
            ],
            [
                'slug' => 'use_simulator',
                'name' => 'Acesso ao Simulador',
                'description' => 'Permite utilizar o simulador de empréstimos.',
            ],
            [
                'slug' => 'manage_rates',
                'name' => 'Gestão de Taxas',
                'description' => 'Permite configurar as taxas de juros do sistema.',
            ],
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::updateOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }
    }
}
