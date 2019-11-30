<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MeLoan login</title>
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/logan.css')}}">
    <link rel="stylesheet" href="{{asset('css/res.css')}}">

    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
    
</head>
<body>
    <div class="wrapper">
        <div class="header">
             <span>Peminjaman alat kesehatan no.1</span>
          </div>
      <div class="form"> 
        <form method="POST" action="{{ route('login') }}" >
            {{ csrf_field() }}
            <div class="head">
                <!-- <img src="materials/favicon.ico" alt=""> -->
            <span class="jub">MeLoan</span>
            </div>
            <div class="formin">
                <span>Hai!</span>
                <p class="pe">Selamat datang kembali, silahkan login</p>
              <div class="input">
                  <input type="text" name="email" id="email"  class="" placeholder="username" value="{{ old('email') }}" required>
                  @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  <input type="password" name="password" id="password"  class="" placeholder="password" required>
                  @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
              </div>           
              
              <div class="submit">
                  <input type="submit" name="" value="Login" class="login">
                  
              </div>
            </div>
        </form>
      </div>
     </div>


     <script src="js/jquery.js"></script>
</body>
</html>