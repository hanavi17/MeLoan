<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['kode_transaksi', 'anggota_id', 'id_alat', 'tgl_pinjam', 'tgl_kembali', 'status', 'keterangan'];
    
    public function anggota()
    {
    	return $this->belongsTo(Anggota::class);
    }

    public function alat()
    {
        //return $this->belongsTo(Alat::class);
        return $this->belongsTo('App\Alat', 'id_alat');
    }
}
