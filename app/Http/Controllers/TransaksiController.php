<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Alat;
use App\Anggota;
use App\Transaksi;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->level == 'user')
        {
            $datas = Transaksi::where('anggota_id', Auth::user()->anggota->id)->get();
        } else {
            $datas = Transaksi::get();
        }
        return view('transaksi.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "TR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "TR0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "TR000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "TR00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "TR0".''.($lastId->id + 1);
            } else {
                    $kode = "TR".''.($lastId->id + 1);
            }
        }

        $alats = Alat::where('jumlah_alat', '>', 0)->get();
        $anggotas = Anggota::get();
        return view('transaksi.create', compact('alats', 'kode', 'anggotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_transaksi' => 'required|string|max:255',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'id_alat' => 'required',
            'anggota_id' => 'required',
            //'keterangan' => 'required'

        ]);

        $transaksi = Transaksi::create([
                'kode_transaksi' => $request->get('kode_transaksi'),
                'tgl_pinjam' => $request->get('tgl_pinjam'),
                'tgl_kembali' => $request->get('tgl_kembali'),
                'id_alat' => $request->get('id_alat'),
                'anggota_id' => $request->get('anggota_id'),
                'keterangan' => $request->get('keterangan'),
                'status' => 'pinjam'
            ]);

        $transaksi->alat->where('id', $transaksi->alat->id)
                        ->update([
                            'jumlah_alat' => ($transaksi->alat->jumlah_alat - 1),
                            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');
        return redirect()->route('transaksi.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Transaksi::findOrFail($id);


        if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }


        return view('transaksi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data = Transaksi::findOrFail($id);

        if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        return view('alat.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        $transaksi->update([
                'status' => 'kembali'
                ]);

        $transaksi->alat->where('id', $transaksi->alat->id)
                        ->update([
                            'jumlah_alat' => ($transaksi->alat->jumlah_alat + 1),
                            ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('transaksi.index');
    }
}
