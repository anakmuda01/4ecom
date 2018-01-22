@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-6">
        <h1>Lengkapi Profile Anda</h1>
        <form method="POST" action="/profile/{{$profile->id}}">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="nama">Nama</label>
            @if ($errors->has('nama'))
              <span>{{$errors->first('nama')}}</span>
            @endif
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap Anda ..." value="{{(old('nama')) ? old('nama') : $profile->nama_user}}">
          </div>
          <div class="form-group">
            <label for="no-telpon">No Telpon</label>
            @if ($errors->has('no_telpon'))
              <span style="color:red;">{{$errors->first('no_telpon')}}</span>
            @endif
            <input type="number" class="form-control" id="no-telpon" name="no_telpon" placeholder="Masukkan Nomor yang bisa dihubungi ..." value="{{(old('no_telpon')) ? old('no_telpon') : $profile->no_telpon}}">
          </div>
          <div class="form-group">
            <label for="no-telpon">Alamat Lengkap</label>
            @if ($errors->has('alamat'))
              <span style="color:red;">{{$errors->first('alamat')}}</span>
            @endif
             <textarea rows="10" class="form-control" name="alamat" id="alamat" rows="20">{{(old('alamat')) ? old('alamat') : $profile->alamat_user}}</textarea>
          </div>
          <input type="hidden" name="_method" value="PUT">
          <button type="submit" class="btn btn-block btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection
