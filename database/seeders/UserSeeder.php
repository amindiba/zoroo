<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $producerRole = Role::where('slug', 'producer')->first();


        User::updateOrCreate(
            [
                'email' => 'producer@zoroo.test'
            ],
            [
                'name' => 'Producer Test',
                'password' => Hash::make('password'),
                'role_id' => $producerRole->id,
            ]
        );
    }
}
