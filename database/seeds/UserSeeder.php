<?php

use App\User;
use Carbon\Carbon;
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
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'no_hp' => '088225035926',
            'slug' => 'admin'
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Andi',
            'email' => 'andika@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'no_hp' => '08777777772',
            'slug' => 'andi'
        ]);

        $user->assignRole('user');
    }
}
