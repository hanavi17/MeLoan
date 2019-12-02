<?php

use Illuminate\Database\Seeder;

class AlatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Alat::insert([
            [
              'id'  			=> 1,
              'nama_alat'  			=> 'Kursi Roda',
              'penyedia'        => 'Rumah Sakit Saiful Anwar',
              'jumlah_alat'		=> 20,
              'deskripsi'		=> 'Kursi yang ada rodanya untuk mempermudah pasien bepindah tempat',
              'foto_alat'		=> '83316-2019-11-23-07-57-13.jpg',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 2,
                'nama_alat'  		=> 'Tongkat',
                'penyedia'      => 'Rumah Sakit Saiful Anwar',
                'jumlah_alat'	=> 50,
                'deskripsi'		=> 'Tongkat untuk menyangga',
                'foto_alat'		=> '19707-2019-11-23-07-58-25.jpg',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 3,
                'nama_alat'  		=> 'Tensimeter',
                'penyedia'      => 'Rumah Sakit Lavalette',
                'jumlah_alat'	=> 15,
                'deskripsi'		=> 'Untuk mengukur tensi darah',
                'foto_alat'		=> '89764-2019-11-23-08-14-31.jpg',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 4,
                'nama_alat'  		=> 'Termometer',
                'penyedia'      => 'Rumah Sakit Lavalette',
                'jumlah_alat'	=> 25,
                'deskripsi'		=> 'Untuk mengukur suhu',
                'foto_alat'		=> '79493-2019-11-23-08-16-01.jpg',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
            ],
        ]);
    }
}
