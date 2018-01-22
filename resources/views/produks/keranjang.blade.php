@extends('layouts.app')

@section('content')

@if (Auth::user()->cart->status == 2)
    <div class="container">
      <div class="row">
        <div class="col-md-12 justify-content-md-center">
          <h1 class="text-center">Silahkan selesaikan proses Pembayaran <a href="/pembayaran" class="btn btn-success" role="button" aria-pressed="true"> Klik disini untuk Menuju Melakukan Pembayaran</a></h1>
        </div>
      </div>
    </div>

@elseif($items->count()==0)
  <div class="container">
    <div class="row">
      <div class="col-md-12 justify-content-md-center belum-ada">
        <h1 class="text-center"> <span> Belum ada Order</span></h1>
      </div>
    </div>
  </div>

@else
    <form method="POST" action="/order/{{Auth::user()->cart->id}}">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-10 col-sm-4 table-responsive-sm">
            <table class="table table-sm tabel-keranjang">
              <thead>
                <tr>
                  <th>Gambar Produk</th>
                  <th>Nama Produk</th>
                  <th>Jumlah Beli</th>
                  <th>Total Harga</th>
                </tr>
              </thead>
              <tbody>

                @foreach($items as $item)
                  <tr>
                    <td><img class="card-img-top" src="{{$item->produk->gambar_produk}}" alt="Card image cap"></td>
                    <td><span><a href="/produk/{{$item->produk->slug_produk}}">{{$item->produk->nama_produk}}</a></span></td>
                    <td><span>{{$item->jumlah_beli}}</span></td>
                    <td><span>Rp. {{number_format($item->harga_total,2,",",".")}}</span></td>
                  </tr>
                @endforeach

                <tr>
                  <td colspan="3" class="text-right"><span>Sub Total</span></td>

                  <td><span>
                    Rp. {{number_format($subtotal,2,",",".")}}
                    </span>
                  </td>
                </tr>
                <tr>
                  <td colspan="1" class="text-left"><span>Kirim ke Alamat</span></td>
                  <td style="width:10%;">
                  @if (empty(Auth::user()->profile->alamat_user))
                    <span style="color:red;">
                    Alamat belum diisi pada profile anda <a href="/profile/{{Auth::user()->profile->id}}/edit" class="btn btn-success" role="button" aria-pressed="true"> Klik disini untuk Mengisi Alamat</a>
                    </span>
                  @else
                    <span>
                    {{Auth::user()->profile->alamat_user}}
                    </span>
                  @endif
                  </td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="1" class="text-left"><span>No. Telpon/HP anda</span></td>
                  <td colspan="3" >
                  @if (empty(Auth::user()->profile->alamat_user))
                    <span style="color:red;">
                    No Telpon/HP belum diisi pada profile anda <a href="/profile/{{Auth::user()->profile->id}}/edit" class="btn btn-success" role="button" aria-pressed="true"> Klik disini untuk Mengisi No Telpon/HP</a>
                    </span>
                  @else
                    <span>
                    {{Auth::user()->profile->no_telpon}}
                    </span>
                  @endif
                  </td>
                </tr>

                <tr>
                  <td colspan="1" class="left"><span>Kirim Pada Tanggal</span></td>
                  <td colspan="1"><span><Datepicker class="tgl-kirim" id="tgl" placeholder="Masukkan Tanggal" name="tanggal_kirim" language="id"></Datepicker></span>
                    @if ($errors->has('tanggal_kirim'))
                      <span style="color:red;">Silahkan Masukkan Kapan Pesanan Akan dikirim</span>
                    @endif
                  </td>
                  <td colspan="1" class="text-right"><span>Biaya Pengiriman</span></td>
                  <td><span>Rp. 50.000</span></td>
                </tr>
                <tr>
                  <td colspan="3" class="text-right"><span>Total Bayar</span></td>

                  <td><span>Rp. {{number_format($totalbayar,2,",",".")}}</span></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-12">
            *catatan : pemesanan minimal 2 hari sebelumnya
          </div>
          <div class="col-md-12">

                {{ csrf_field() }}
              <button type="submit" class="btn btn-block btn-success">Lanjut ke Proses Pembayaran</button>

          </div>
        </div>
      </div>
    </form>

@endif

@endsection
