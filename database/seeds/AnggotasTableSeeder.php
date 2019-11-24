<?php

use Illuminate\Database\Seeder;

class AnggotasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Anggota::insert([
            [
              'id'  			=> 1,
              'user_id'  		=> 1,
              'nomor_anggota'	=> 10000353,
              'nama' 			=> 'Admin',
              'tempat_lahir'	=> 'Probolinggo',
              'tgl_lahir'		=> '2002-02-02',
              'jk'				=> 'L',
              'alamat'			=> 'Malang',
              'telp' => '082234567890',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'user_id'  		=> 2,
              'nomor_anggota'				=> 10000375,
              'nama' 			=> 'User',
              'tempat_lahir'	=> 'Kediri',
              'tgl_lahir'		=> '2001-01-01',
              'jk'				=> 'L',
              'alamat'			=> 'Kediri',
              'telp' => '082432765098',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
        ]);
    }
}
