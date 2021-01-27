<?php

use App\User;
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
            'email' => 'griyakenyo@gmail.com',
            'password' => bcrypt('12345678'),
            'no_hp' => '088225035926',
            'slug' => 'admin'
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Andi',
            'email' => 'andika@gmail.com',
            'password' => bcrypt('12345678'),
            'no_hp' => '08777777772',
            'slug' => 'andi'
        ]);

        $user->assignRole('user');
    }
}
