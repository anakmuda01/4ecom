@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-5">
        @if (session('mantap'))
            <div class="alert alert-success">
                {{ session('mantap') }}
            </div>
        @endif
        @if (session('kosong'))
            <div class="alert alert-danger">
                {{ session('kosong') }}
            </div>
        @endif
        @if (session()->has('oke'))
          <div class="alert alert-success">
            {{session()->get('oke')}}
          </div>
        @endif
        @if (Session::has('msg'))
          <div class="alert alert-success">{{ Session::get('msg') }}</div>
        @endif
        <div class="row">
          <div class="col-md-12 profile-warp table-responsive-sm">
            <h1 class="text-center">PROFILE ANDA</h1>
            <table class="table">
              <tbody>
                <tr>
                  <td><span>Nama</span></td>
                  <td><span>:</span></td>
                  <td><span>
                    @if (!$profile->nama_user)
                      Belum diisi
                    @endif
                    {{$profile->nama_user}}
                  </span></td>
                </tr>
                <tr>
                  <td><span>Telp/HP</span></td>
                  <td><span>:</span></td>
                  <td><span>
                    @if (!$profile->no_telpon)
                      Belum diisi
                    @endif
                    {{$profile->no_telpon}}
                  </span></td>
                </tr>
                <tr>
                  <td><span>Alamat</span></td>
                  <td><span>:</span></td>
                  <td><span>
                    @if (!$profile->alamat_user)
                      Belum diisi
                    @endif
                    {{$profile->alamat_user}}
                  </span></td>
                </tr>
                <td><span>Ubah Password</span></td>
                <td><span>:</span></td>
                <td><span>
                  <a href="/gantipassword" class="btn btn-secondary">Klik Disini</a>
                </span></td>
              </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-12 tombol-ubah-warp">
            <a href="/profile/{{$profile->id}}/edit" class="btn btn-success btn-block align-bottom">Ubah Profile</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
