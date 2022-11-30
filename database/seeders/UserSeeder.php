<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole('admin');

        $admin = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole('user');
    }
}
