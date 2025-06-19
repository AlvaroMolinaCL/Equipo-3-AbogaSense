<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class TenantInitialSetupSeeder extends Seeder
{
    protected string $name;
    protected string $email;
    protected string $password;

    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function run(): void
    {
        // Crear rol si no existe
        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);

        // Crear usuario inicial
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        $user->assignRole('Admin');
    }
}
