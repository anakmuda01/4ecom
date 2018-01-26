@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid banner">
  <div class="container kk">
    <h1 class="display-4 text-center">Cathering Online Shop</h1>
    <h2 class="display-4 text-center">Projek UAS VISUAL 3</h2>
    <div class="row gg">
      <div class="col-md-12">
        <p class="lead text-center">Fathurrahman Sholihin (15.63.0674)</p>
      </div>
    </div>
  </div>
</div>

<div class="container katlog">
  <div class="row">
    <div class="col-md-12 kategori">
      <div class="row list-kategori">
        @foreach ($tags as $tag)
          <div class="col-md-4 ">
            <div class="card gambar-warpper">
              <div class="card-body">
              <h5 class="card-title judul-produk text-center">{{$tag->nama_tag}}</h5>
                <div class="hover01 inilo">
                  <div>
                    <figure>
                      <img class="card-img-top" src="{{$tag->gambar_tag}}" alt="Card image cap">
                    </figure>
                  </div>
                </div>
              </div>
              <a href="/produk/kategori/{{$tag->slug_tag}}" class="btn btn-block">Lihat</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <div class="col-md-12 katalog-home">
      <div>
        <h3>Random Produk</h3>
      </div>
      <div class="row">
        @foreach ($produks as $produk)
          <div class="col-md-3 col-sm-6">
            <div class="card gambar-warpper">
              <div class="card-body">
                <div class="hover01 ini">
                  <div>
                    <figure>
                      <img class="card-img-top" src="{{$produk->gambar_produk}}" alt="Card image cap">
                    </figure>
                  </div>
                  <div class="detail-home-produk">
                    <h5 class="card-title judul-produk">{{$produk->nama_produk}}</h5>
                    <div>
                      <span>Rp. </span><span id="price" class="card-text">{{number_format("$produk->harga_produk",2,",",".")}}</span>
                    </div>
                  </div>
                  <a href="/produk/{{$produk->slug_produk}}" class="btn btn-success">Order Sekarang</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <div class="col-md-12">
      <a href="/produk" class="btn btn-block btn-success">Lihat Produk Lainnya</a>
    </div>
  </div>
</div>
@endsection
