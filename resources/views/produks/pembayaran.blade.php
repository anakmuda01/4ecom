@extends('layouts.app')

@section('content')
@if ($order)
  <div class="container">
    <div class="row pembayaran">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            Detail Pembayaran Order Anda
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-sm">
                  <tbody>
                    <tr>
                      <td>Kode Pembayaran</td>
                      <td>:</td>
                      <td>{{$order->kode_random}}</td>
                    </tr>
                    <tr>
                      <td>Total yang harus dibayar</td>
                      <td>:</td>
                      <td>Rp. {{number_format($hartot,2,',','.')}}</td>
                    </tr>
                    <tr>
                      <td>Pesanan dikirim pada Tanggal</td>
                      <td>:</td>
                      <td>{{$order->tgl_kirim}}</td>
                    </tr>
                    <tr>
                      <td>Status Pesanan</td>
                      <td>:</td>
                      <td>{{$pesan}}</td>
                    </tr>
                    <tr>
                      <td>Detail Order</td>
                      <td>:</td>
                      <td>
                        <button style="width:10em;" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#detail_order">
                          Klik disini
                        </button>
                      </td>
                    </tr>
                  </tbody>
              </table>
            </div>
            <span>Ingin Membatalkan ?</span>
            <form method="POST" action="/pembayaran/{{Auth::user()->id}}">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" name="submit" class="btn btn-danger">Batalkan Pesanan</button>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="detail_order" tabindex="-1" role="dialog" aria-labelledby="detail_order" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detail_order">Detail Order dari {{Auth::user()->email}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive-sm">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th scope="col">Gambar Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Jumlah Beli</th>
                            <th scope="col">Total Harga</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($order->cartItems as $item)
                            <tr>
                              <td><img class="modal-img" src="{{$item->produk->gambar_produk}}" alt="{{$item->produk->nama_produk}}"></td>
                              <td>
                                <p>{{$item->produk->nama_produk}}</p>
                                <p>Rp. {{$item->produk->harga_produk}}</p>
                              </td>
                              <td>{{$item->jumlah_beli}}</td>
                              <td>Rp. {{number_format($item->harga_total,2,',','.')}}</td>
                            </tr>
                          @endforeach
                          <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>Rp. {{number_format($hartot,2,',','.')}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>
      <!-- end Modal -->
      <div class="col-md-6">
        <div class="card" style="width: 30rem;">
          <div class="card-body">
            <p class="card-text"><span>Silahkan Lakukan Pembayaran dengan cara :</span> </p>
            <p class="card-text"><span>1. Transfer Bank ke Rek : 123456789000011</span> </p>
            <p class="card-text"><span>2. Lakukan Konfirmasi Transfer dengan cara : </span></p>
            <p>
              <span>
                Mengirimkan Pesan ke nomor WA 085247711065
                dengan format :
              </span>
            </p>
            <p>
              <span>
                 Email Anda # Kode Pembayaran # Bukti Transfer (Berupa Foto)
              </span>
            </p>
            <p><span>
              Contoh Konfirmasi :
            </span></p>
            <p><span>
              sholihin@gmail.com # 12DhP # Foto Transfer
            </span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
@else
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12 justify-content-md-center belum-ada">
        <h1 class="text-center"> <span> Belum ada Notifikasi</span></h1>
      </div>
    </div>
  </div>
@endif
@endsection
