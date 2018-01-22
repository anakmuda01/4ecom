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
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" href="/admin/produk">List Produk</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/admin/create">Tambah Produk</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="/admin/{{$produk->id}}/edit">Edit Produk</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <form method="POST" action="/admin/{{$produk->id}}">
             {{ csrf_field() }}
             <div class="container">
               <div class="row justify-content-between">
                 {{-- kolom post --}}
                 <div class="col-md-8">
                   <br>
                   <div class="form-group">
                     <label for="nama_produk">Nama Produk</label>
                     @if ($errors->has('nama_produk'))
                       <br>
                       <span style="color:red;">{{$errors->first('nama_produk')}}</span>
                     @endif
                     <input type="text" name="nama_produk" class="form-control" id="nama_produk" placeholder="Masukkan Link ..." value="{{(old('nama_produk')) ? old('nama_produk') : $produk->nama_produk}}">
                   </div>
                     <div class="form-group">
                       <label for="deskripsi_produk">Deskripsi Produk</label>
                       @if ($errors->has('deskripsi_produk'))
                         <br>
                         <span style="color:red;">{{$errors->first('deskripsi_produk')}}</span>
                       @endif
                       <textarea class="form-control" name="deskripsi_produk" id="deskripsi_produk" rows="20">{{(old('deskripsi_produk')) ? old('deskripsi_produk') : $produk->deskripsi_produk}}</textarea>
                     </div>
                 </div>
                 {{-- end kolom post --}}

                 {{-- kolom featured --}}
                 <div class="col-md-4">
                   <br>
                   <div class="form-group">
                     <label for="harga_produk">Harga Produk (Rp.)</label>
                     @if ($errors->has('harga_produk'))
                       <br>
                       <span style="color:red;">{{$errors->first('harga_produk')}}</span>
                     @endif
                     <input type="number" name="harga_produk" class="form-control" id="harga_produk" placeholder="Masukkan Harga Produk ..." value="{{(old('harga_produk')) ? old('nama_produk') : $produk->harga_produk}}">
                   </div>
                   <div class="form-group">
                     <label for="kategori_produk">Kategori</label>
                     @if(session('tag_error'))
                       <br>
                       <span style="color:red;">{{session('tag_error')}}</span>
                     @endif

                      @foreach ($produk->tags as $oldtag)
                        <select class="form-control" name="kategori_produk[]" id="kategori_produk">
                          @foreach ($tags as $tag)
                            <option value="{{$tag->id}}"

                              @if ($oldtag->id == $tag->id)
                                selected="selected"
                              @endif

                              >{{$tag->nama_tag}}</option>
                          @endforeach
                        </select>
                      @endforeach

                   </div>
                   <div class="form-group">
                     <label for="thumbnail">Gambar Produk</label>
                     @if ($errors->has('gambar_produk'))
                       <br>
                        <span style="color:red;">{{$errors->first('gambar_produk')}}</span>
                      @endif
                     <div class="input-group">
                       <span class="input-group-btn">
                         <a id="lfm1" data-input="thumbnail" data-preview="holder" class="btn btn-outline-primary">
                           <i class="fa fa-picture-o"></i> Choose
                         </a>
                       </span>
                       <input id="thumbnail" class="form-control" type="text" name="gambar_produk" value="{{(old('gambar_produk')) ? old('gambar_produk') : $produk->gambar_produk}}" readonly>
                     </div>
                   </div>
                   <div class="row justify-content-md-center">
                     <div class="col-md-9">
                       <div class="featured_img_holder">
                         <img alt="{{$produk->nama_produk}}" src="{{(old('gambar_produk')) ? old('gambar_produk') : $produk->gambar_produk}}" id="holder" style="margin-top:15px;min-height:170px;max-height:170px; max-width:245px">
                       </div>
                     </div>
                   </div>
                   <br>
                   <input type="hidden" name="_method" value="PUT">
                   <button type="submit" name="submit" class="btn btn-outline-primary btn-block">Submit Produk</button>
                 </div>
      </main>
  </div>
</div>
@endsection
