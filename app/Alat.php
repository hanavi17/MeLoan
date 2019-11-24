<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    protected $fillable = ['judul', 'penyedia', 'jumlah_alat', 'deskripsi', 'foto_alat'];

    /**
     * Method One To Many 
     */
    public function transaksi()
    {
        //return $this->hasMany(Transaksi::class);
        return $this->hasMany('App\Transaksi', 'id');
    }
}
