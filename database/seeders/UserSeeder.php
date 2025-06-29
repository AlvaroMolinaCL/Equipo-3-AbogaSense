<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'abogasense@example.com'],
            [
                'name' => 'Super Administrador',
                'email_verified_at' => now(),
                'password' => Hash::make('asdf1234'),
                'remember_token' => Str::random(60),
            ]
        );

        if (!$user->hasRole('Super Admin')) {
            $user->assignRole('Super Admin');
        }

        $user->createToken('authToken')->accessToken;
    }
}
