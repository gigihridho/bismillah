<?php

use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fasilitas')->insert([
            [
                'nama' => 'Meja',
            ],
            [
                'nama' => 'Kursi',
            ],
            [
                'nama' => 'Kamar Mandi Dalam',
            ],
            [
                'nama' => 'Kamar Mandi Luar',
            ],
            [
                'nama' => 'Kasur',
            ],
            [
                'nama' => 'Kipas Angin'
            ],
        ]);
    }
}
