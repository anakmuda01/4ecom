@extends('layouts.paneladmin')

@section('content')

<div class="container-fluid">
  <div class="row">
    @if (Session::has('msg'))
      <div class="alert alert-success">{{ Session::get('msg') }}</div>
    @endif
      <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a class="nav-link" href="/admin">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/produk">Produk </span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/admin/order">Order <span class="sr-only">(current)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">?</a>
          </li>
        </ul>
      </nav>

      <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3 form-produk">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h3>Data Pelanggan</h3>
                  <table class="table table-responsive-sm">
                    <thead>
                      <tr>
                        <th scope="col">ID Pelanggan</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">No Telpon</th>
                        <th scope="col">Alamat</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td>{{$order->user->id}}</td>
                          <td>{{$order->user->profile->nama_user}}</td>
                          <td>{{$order->user->profile->no_telpon}}1</td>
                          <td>
                            {{$order->user->profile->alamat_user}}
                          </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-8">
                  <h3>Data Order Pelanggan</h3>
                  <div class="list-order-user">

                    <table class="table table-responsive-sm">
                      <thead>
                        <tr>
                          <th scope="col">Nama Produk</th>
                          <th scope="col">Harga Produk</th>
                          <th scope="col">Jumlah Beli</th>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($order->cartItems as $or)
                        <tr>
                          <td>{{$or->produk->nama_produk}}</td>
                          <td>{{$or->produk->harga_produk}}</td>
                          <td>{{$or->jumlah_beli}}</td>
                          <td>{{$or->harga_total}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
                <div class="col-md-12">
                  <br>
                  <div class="col-md-12">
                    <Span>Total yang dibayar : Rp. {{number_format($hartot,2,",",".")}}</Span>
                  </div>
                  <div class="col-md-12">
                    <Span>Kirim Pada Tanggal : {{$order->tgl_kirim}}</Span>
                  </div>
                  <div class="col-md-12">
                    <hr>
                    <form method="POST" action="/notif/{{$order->user->id}}">
                         {{ csrf_field() }}
                     @if(session('pesan_error'))
                       <p style="color:red;">{{session('pesan_error')}}</p>
                     @endif
                     @if (session()->has('wow'))
                       <div class="alert alert-success">
                         {{session()->get('wow')}}
                       </div>
                     @endif
                      <span>Pesan untuk Pelanggan :</span>
                      @foreach ($user->pesans as $oldpesan)
                        <select class="form-control" name="pesan_admin[]" id="pesan_admin">
                          <option value="0">Pilih Kategori</option>
                          @foreach ($pesans as $pesan)
                            <option value="{{$pesan->id}}"
                              @if ($oldpesan->id == $pesan->id)
                                selected="selected"
                              @endif
                              >{{$pesan->tipe_pesan}}</option>
                          @endforeach
                        </select>
                      @endforeach
                      <button type="submit" name="submit" class="btn btn-outline-primary btn-block">Submit Pesan</button>
                    </form>
                  </div>
                </div>

              </div>
            </div>
      </main>
  </div>
</div>
@endsection
