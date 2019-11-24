@section('js')
 <script type="text/javascript">
   $(document).on('click', '.pilih', function (e) {
                document.getElementById("alat_judul").value = $(this).attr('data-alat_judul');
                document.getElementById("id_alat").value = $(this).attr('data-id_alat');
                $('#myModal').modal('hide');
            });

            $(document).on('click', '.pilih_anggota', function (e) {
                document.getElementById("anggota_id").value = $(this).attr('data-anggota_id');
                document.getElementById("anggota_nama").value = $(this).attr('data-anggota_nama');
                $('#myModal2').modal('hide');
            });
          
             $(function () {
                $("#lookup, #lookup2").dataTable();
            });

        </script>

@stop
@section('css')

@stop
@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Tambah Transaksi baru</h4>
                    
                        <div class="form-group{{ $errors->has('kode_transaksi') ? ' has-error' : '' }}">
                            <label for="kode_transaksi" class="col-md-4 control-label">Kode Transaksi</label>
                            <div class="col-md-6">
                                <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi" value="{{ $kode }}" required readonly="">
                                @if ($errors->has('kode_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_transaksi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                            <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
                            <div class="col-md-3">
                                <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required @if(Auth::user()->level == 'user') readonly @endif>
                                @if ($errors->has('tgl_pinjam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_pinjam') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
                            <label for="tgl_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
                            <div class="col-md-3">
                                <input id="tgl_kembali" type="date"  class="form-control" name="tgl_kembali" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(5)->toDateString())) }}" required="" @if(Auth::user()->level == 'user') readonly @endif>
                                @if ($errors->has('tgl_kembali'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_kembali') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('id_alat') ? ' has-error' : '' }}">
                            <label for="id_alat" class="col-md-4 control-label">Alat</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <input id="alat_judul" type="text" class="form-control" readonly="" required>
                                <input id="id_alat" type="hidden" name="id_alat" value="{{ old('id_alat') }}" required readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari alat</b> <span class="fa fa-search"></span></button>
                                </span>
                                </div>
                                @if ($errors->has('id_alat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_alat') }}</strong>
                                    </span>
                                @endif
                                 
                            </div>
                        </div>
                        

                        @if(Auth::user()->level == 'admin')
                        <div class="form-group{{ $errors->has('anggota_id') ? ' has-error' : '' }}">
                            <label for="anggota_id" class="col-md-4 control-label">Anggota</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <input id="anggota_nama" type="text" class="form-control" readonly="" required>
                                <input id="anggota_id" type="hidden" name="anggota_id" value="{{ old('anggota_id') }}" required readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-warning btn-secondary" data-toggle="modal" data-target="#myModal2"><b>Cari Anggota</b> <span class="fa fa-search"></span></button>
                                </span>
                                </div>
                                @if ($errors->has('anggota_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('anggota_id') }}</strong>
                                    </span>
                                @endif
                                 
                            </div>
                        </div>
                        @else
                        <div class="form-group{{ $errors->has('anggota_id') ? ' has-error' : '' }}">
                            <label for="anggota_id" class="col-md-4 control-label">Anggota</label>
                            <div class="col-md-6">
                                <input id="anggota_nama" type="text" class="form-control" readonly="" value="{{Auth::user()->anggota->nama}}" required>
                                <input id="anggota_id" type="hidden" name="anggota_id" value="{{ Auth::user()->anggota->id }}" required readonly="">
                              
                                @if ($errors->has('anggota_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('anggota_id') }}</strong>
                                    </span>
                                @endif
                                 
                            </div>
                        </div>
                        @endif

                        <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                            <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-6">
                                <input id="keterangan" type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}">
                                @if ($errors->has('keterangan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Submit
                        </button>
                        <button type="reset" class="btn btn-danger">
                                    Reset
                        </button>
                        <a href="{{route('transaksi.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>


  <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari alat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Penyedia</th>                                    
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alats as $data)
                                <tr class="pilih" data-id_alat="<?php echo $data->id; ?>" data-alat_judul="<?php echo $data->judul; ?>" >
                                    <td>@if($data->foto_alat)
                            <img src="{{url('images/alat/'. $data->foto_alat)}}" alt="image" style="margin-right: 10px;" />
                          @else
                            <img src="{{url('images/alat/default.png')}}" alt="image" style="margin-right: 10px;" />
                          @endif
                          {{$data->judul}}</td>
                                    <td>{{$data->penyedia}}</td>                                    
                                    <td>{{$data->jumlah_alat}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>


  <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                        <tr>
                          <th>
                            Nama
                          </th>
                          <th>
                            Nomor Anggota
                          </th>                          
                          <th>
                            Jenis Kelamin
                          </th>
                        </tr>
                      </thead>
                            <tbody>
                                @foreach($anggotas as $data)
                                <tr class="pilih_anggota" data-anggota_id="<?php echo $data->id; ?>" data-anggota_nama="<?php echo $data->nama; ?>" >
                                    <td class="py-1">
                          @if($data->user->foto)
                            <img src="{{url('images/user', $data->user->foto)}}" alt="image" style="margin-right: 10px;" />
                          @else
                            <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px;" />
                          @endif

                            {{$data->nama}}
                          </td>
                          <td>
                            {{$data->nomor_anggota}}
                          </td>

                          
                          <td>
                            {{$data->jk === "L" ? "Laki - Laki" : "Perempuan"}}
                          </td>
                        </tr>
                                @endforeach
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>
@endsection