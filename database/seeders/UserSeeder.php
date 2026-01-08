<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $pendidik=User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('12344321'),
            'nama_pembimbing' => 'joko',
            'role'=>'user'
        ]);

        $pendidik->assignRole('user');

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12344321'),
            'role' => 'admin',
        ]);

        $admin->assignRole('admin');

        $pembimbing = User::factory()->create([
            'name' => 'Pendidik',
            'email' => 'pendidik@example.com',
            'role' => 'pembimbing',
            'password' => bcrypt('12344321'),
        ]);

        $pembimbing->assignRole('pembimbing');
    }
}
