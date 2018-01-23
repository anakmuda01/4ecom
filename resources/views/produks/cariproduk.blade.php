@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    </div>
    <div class="col-md-12 katalog-warpper">
      <div class="row">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12 hasil-cari">
          <span>
          @if(!empty($count))
            {{$count}}
             item ditemukan
          @else
            0 item ditemukan
          @endif
        </span>
        </div>
        <div class="col-md-2 kat">
            <div class="col-md-12 tempat-kat">
              <div class="row">
                <div class="col-md-12">
                  <div class="dropdown">
                    <button type="button" class="btn btn-success btn-block dropdown-toggle" data-toggle="dropdown">
                      Urut Berdasarkan
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="/produk/terbaru">Terbaru</a>
                      <a class="dropdown-item" href="/produk/termurah">Termurah</a>
                      <a class="dropdown-item" href="/produk/termahal">Termahal</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-10 katalog-warp">
          <div class="row katalog">
            @foreach ($produks as $produk)
            <div class="col-sm-6 col-md-4">
              <div class="card produk">
                <img class="card-img-top" src="{{$produk->gambar_produk}}" alt="{{$produk->nama_produk}}">
                <div class="card-body">
                  <h5 class="card-title judul-produk">{{$produk->nama_produk}}</h5>
                  <span>Kategori :
                    @foreach ($produk->tags as $tag)
                      {{$tag->nama_tag}}
                    @endforeach
                  </span> <br>
                  <span>Rp. </span><span id="price" class="card-text">{{number_format("$produk->harga_produk",2,",",".")}}</span>
                </div>
                <a href="/produk/{{$produk->slug_produk}}" class="btn btn-block">Order Sekarang</a>
              </div>
            </div>
            @endforeach
          </div>
          <div class="row justify-content-md-center">
          {{ $produks->links() }}
          </div
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
