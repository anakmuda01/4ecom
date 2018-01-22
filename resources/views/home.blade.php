@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-12 banner">
      banner
    </div>

    <div class="col-md-12 carol">
      <div class="title-carol">
        <h3>Hot Produk</h3>
      </div>
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
           <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
           <li data-target="#myCarousel" data-slide-to="1"></li>
           <li data-target="#myCarousel" data-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
           <div class="carousel-item active">
             <a href="/"><img class="first-slide" src="{{asset('img/food1.png')}}" alt="First slide"></a>
           </div>
           <div class="carousel-item">
             <a href="/"><img class="second-slide" src="{{asset('img/food2.jpg')}}" alt="Second slide"></a>
           </div>
           <div class="carousel-item">
             <a href="/"><img class="third-slide" src="{{asset('img/food3.jpg')}}" alt="Third slide"></a>
           </div>
         </div>
         <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
           <i class="fa fa-arrow-left fa-lg" aria-hidden="true"></i>
           <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
           <i class="fa fa-arrow-right fa-lg" aria-hidden="true"></i>
           <span class="sr-only">Next</span>
         </a>
       </div>
    </div>

    <div class="col-md-12 kategori">
      <div class="title-kategori">
        <h3>Kategori</h3>
      </div>
      <div class="row list-kategori">
        @foreach ($tags as $tag)
          <div class="col-md-3">
            <div style="min-height:21em" class="card">
              <div class="card-body">
              <h5 class="card-title judul-produk text-center">{{$tag->nama_tag}}</h5>
              <img class="card-img-top" src="{{$tag->gambar_tag}}" alt="Card image cap">
              </div>
              <a href="/produk/kategori/{{$tag->slug_tag}}" class="btn btn-block">Lihat</a>
            </div>
          </div>
        @endforeach

        {{-- <div class="col-md-3">
          <div class="card">
            <div class="card-body">
            <h5 class="card-title judul-produk text-center">Nasi Kotak</h5>
            <img class="card-img-top" src="{{asset('img/nasi.jpg')}}" alt="Card image cap">
            </div>
            <a href="#" class="btn btn-block">Lihat</a>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
            <h5 class="card-title judul-produk text-center">Kue</h5>
            <img class="card-img-top" src="{{asset('img/nasi.jpg')}}" alt="Card image cap">
            </div>
            <a href="#" class="btn btn-block">Lihat</a>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
            <h5 class="card-title judul-produk text-center">Snack</h5>
            <img class="card-img-top" src="{{asset('img/nasi.jpg')}}" alt="Card image cap">
            </div>
            <a href="#" class="btn btn-block">Lihat</a>
          </div>
        </div> --}}

      </div>
    </div>

  </div>
</div>
@endsection
