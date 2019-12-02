<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Alat;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class AlatController extends Controller
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
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $datas = Alat::get();
        
        return view('alat.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        return view('alat.create');
    }

    public function format()
    {
        $data = [['nama_alat' => null, 'penyedia' => null, 'jumlah_alat' => null, 'deskripsi' => null]];
            $fileName = 'format-alat';
            

        $export = Excel::create($fileName.date('Y-m-d_H-i-s'), function($excel) use($data){
            $excel->sheet('alat', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        });

        return $export->download('xlsx');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'importalat' => 'required'
        ]);

        if ($request->hasFile('importalat')) {
            $path = $request->file('importalat')->getRealPath();

            $data = Excel::load($path, function($reader){})->get();
            $a = collect($data);

            if (!empty($a) && $a->count()) {
                foreach ($a as $key => $value) {
                    $insert[] = [
                            'nama_alat' => $value->nama_alat, 
                            'penyedia' => $value->penyedia, 
                            'jumlah_alat' => $value->jumlah_alat, 
                            'deskripsi' => $value->deskripsi, 
                            'foto_alat' => NULL];

                    Alat::create($insert[$key]);
                        
                    }
                  
            };
        }
        alert()->success('Berhasil.','Data telah diimport!');
        return back();
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
            'nama_alat' => 'required|string|max:255',
            'penyedia' => 'required|string'
        ]);

        if($request->file('foto_alat')) {
            $file = $request->file('foto_alat');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('foto_alat')->move("images/alat", $fileName);
            $foto_alat = $fileName;
        } else {
            $foto_alat = NULL;
        }

        Alat::create([
                'nama_alat' => $request->get('nama_alat'),
                'penyedia' => $request->get('penyedia'),
                'jumlah_alat' => $request->get('jumlah_alat'),
                'deskripsi' => $request->get('deskripsi'),
                'foto_alat' => $foto_alat
            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');

        return redirect()->route('alat.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->level == 'user') {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        $data = alat::findOrFail($id);

        return view('alat.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if(Auth::user()->level == 'user') {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        $data = alat::findOrFail($id);
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
        if($request->file('foto_alat')) {
            $file = $request->file('foto_alat');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('foto_alat')->move("images/alat", $fileName);
            $foto_alat = $fileName;

            Alat::find($id)->update([
                'nama_alat' => $request->get('nama_alat'),
                   'penyedia' => $request->get('penyedia'),
                   'jumlah_alat' => $request->get('jumlah_alat'),
                   'deskripsi' => $request->get('deskripsi'),
                   'foto_alat' => $foto_alat
                   ]);
        }

        Alat::find($id)->update([
             'nama_alat' => $request->get('nama_alat'),
                'penyedia' => $request->get('penyedia'),
                'jumlah_alat' => $request->get('jumlah_alat'),
                'deskripsi' => $request->get('deskripsi'),
                ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('alat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alat::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('alat.index');
    }
}
