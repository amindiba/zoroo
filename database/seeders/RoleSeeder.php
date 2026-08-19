<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [

            [
                'name' => 'Admin',
                'slug' => 'admin',
            ],

            [
                'name' => 'Producer',
                'slug' => 'producer',
            ],

            [
                'name' => 'Buyer',
                'slug' => 'buyer',
            ],

        ];


        foreach ($roles as $role) {

            Role::updateOrCreate(
                [
                    'slug' => $role['slug']
                ],
                $role
            );

        }
    }
}
