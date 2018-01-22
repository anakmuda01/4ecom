@extends('layouts.paneladmin')

@section('content')
<div class="container-fluid">
  <div class="row">
      <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a class="nav-link" href="/admin">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/admin/produk">Produk <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/order">Order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">?</a>
          </li>
        </ul>
      </nav>

      <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              @if (Session::has('msg'))
                <div class="alert alert-success">{{ Session::get('msg') }}</div>
              @endif
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" href="/admin/produk">List Produk</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/admin/create">Tambah Produk</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

       <div class="col-md-12 admin-list-produk-warp">
         <table class="table table-responsive-sm-12 table-striped">
           <thead>
             <tr class="d-flex">
               <th class="col-sm-1">Gambar</th>
               <th class="col-sm-6">Nama Produk</th>
               <th class="col-sm-2">Kategori</th>
               <th class="col-sm-3 text-center">Action</th>
             </tr>
           </thead>
         <tbody>
           @foreach ($produks as $produk)
             <tr class="post_tersimpan d-flex">
               <td class="col-sm-1 admin_produk_img"> <img src="{{$produk->gambar_produk}}" alt="{{$produk->nama_produk}}"></td>
               <td class="col-sm-6"> <h4 class="text-left"> {{$produk->nama_produk}} </h4> </td>
               <td class="col-sm-2">
                 <h4 class="text-left">
                   @foreach ($produk->tags as $tag)
                     {{$tag->nama_tag}}
                   @endforeach
                 </h4>
               </td>
               <td class="col-sm-1"><a href="/produk/{{$produk->slug_produk}}" target="_blank" class="btn btn-primary btn-block" role="button" aria-pressed="true">Lihat</a></td>
               <td class="col-sm-1"><a href="/admin/{{$produk->id}}/edit" class="btn btn-warning btn-block" role="button" aria-pressed="true">Edit</a></td>
               <td class="col-sm-1">
                 <form method="POST" action="/admin/{{$produk->id}}">
                   {{ csrf_field() }}
                   <input type="hidden" name="_method" value="DELETE">
                   <button type="submit" name="submit" class="btn btn-danger">Hapus</button>
                 </form>
               </td>
             </tr>
           @endforeach
         </tbody>
       </table>
     </div>
     <div class="col-md-12">
       {{ $produks->links() }}
     </div>
    </main>
  </div>
</div>
@endsection
