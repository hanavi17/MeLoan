@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })
        </script>
@stop

@extends('layouts.app')

@section('content')

<form action="{{ route('alat.update', $data->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit Alat <b>{{$data->nama_alat}}</b> </h4>
                      <form class="forms-sample">
                        <div class="form-group{{ $errors->has('nama_alat') ? ' has-error' : '' }}">
                            <label for="nama_alat" class="col-md-4 control-label">Nama</label>
                            <div class="col-md-6">
                                <input id="nama_alat" type="text" class="form-control" name="nama_alat" value="{{ $data->nama_alat }}" required>
                                @if ($errors->has('nama_alat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_alat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group{{ $errors->has('nomor_anggota') ? ' has-error' : '' }}">
                            <label for="penyedia" class="col-md-4 control-label">Penyedia</label>
                            <div class="col-md-6">
                                <input id="penyedia" type="text" class="form-control" name="penyedia" value="{{ $data->penyedia }}" required>
                                @if ($errors->has('penyedia'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('penyedia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        <div class="form-group{{ $errors->has('jumlah_alat') ? ' has-error' : '' }}">
                            <label for="jumlah_alat" class="col-md-4 control-label">Jumlah Alat</label>
                            <div class="col-md-6">
                                <input id="jumlah_alat" type="number" maxlength="4" class="form-control" name="jumlah_alat" value="{{ $data->jumlah_alat }}" required>
                                @if ($errors->has('jumlah_alat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_alat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
                            <label for="deskripsi" class="col-md-4 control-label">Deskripsi</label>
                            <div class="col-md-12">
                                <input id="deskripsi" type="text" class="form-control" name="deskripsi" value="{{ $data->deskripsi }}" >
                                @if ($errors->has('deskripsi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Foto Alat</label>
                            <div class="col-md-6">
                                <img width="200" height="200" @if($data->foto_alat) src="{{ asset('images/alat/'.$data->foto_alat) }}" @endif />
                                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="foto_alat">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Update
                        </button>
                        <a href="{{route('alat.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
@endsection