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
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'photo_ktp' => "https://picsum.photos/200/150",
            'no_hp' => '088225035926',
            'address' => 'Jakarta',
            'profession' => 'Admin',
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Reyna',
            'email' => 'reyna@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'no_hp' => '08777777772',
            'photo_ktp' => "https://picsum.photos/200/150",
            'address' => 'Jakarta',
            'profession' => 'Guru',
        ],
        [
            'name' => 'Susanti',
            'email' => 'susanti@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'no_hp' => '085152512',
            'address' => 'Jogjakarta',
            'profession' => 'Mahasiswi',
        ]);

        $user->assignRole('user');
    }
}
