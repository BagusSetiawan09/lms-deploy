<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Role (Aman, tidak akan duplikat)
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $rolePendidik = Role::firstOrCreate(['name' => 'pendidik']);
        $roleUser = Role::firstOrCreate(['name' => 'user']);
        $rolePembimbing = Role::firstOrCreate(['name' => 'pembimbing']);

        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('12344321'),
                'email_verified_at' => now(),
            ]
        );
        $user->assignRole($roleUser);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], 
            [
                'name' => 'Super Admin',
                'password' => Hash::make('12344321'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($roleAdmin);

        $pembimbing = User::firstOrCreate(
            ['email' => 'pendidik@example.com'], 
            [
                'name' => 'Bapak Pendidik',
                'password' => Hash::make('12344321'),
                'email_verified_at' => now(),
            ]
        );
        $pembimbing->assignRole($rolePembimbing);
    }
}