<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = 'alat';
    protected $fillable = ['nama_alat', 'jumlah_alat', 'deskripsi', 'foto_alat'];

    public function mobil(){
        return $this->hasMany('App\Transaksi', 'id');
    }
}
