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
            <a class="nav-link" href="/admin/produk">Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/admin/order">Order  <span class="sr-only">(current)</span></a>
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
                  <a class="nav-link active" href="/admin/order">List Order</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

       <div class="col-md-12 admin-list-produk-warp">
         <table class="table table-sm table-responsive-sm">
           <thead>
             <tr>
               <th scope="col">Id Order</th>
               <th scope="col">User Email</th>
               <th scope="col">Kode Pembayaran</th>
               <th scope="col">Status</th>
               <th colspan="2" scope="col" class="text-center">Action</th>
             </tr>
           </thead>
           <tbody>
             @foreach ($orders as $order)
               <tr>
                 <th scope="row">{{$order->id}}</th>
                 <td>{{$order->user->email}}</td>
                 <td>{{$order->kode_random}}</td>
                 <td>
                   @foreach ($order->user->pesans as $up )
                     {{$up->tipe_pesan}}
                   @endforeach
                 </td>
                 <td><a href="/admin/order/{{$order->id}}" target="_blank" class="btn btn-primary btn-block" role="button" aria-pressed="true">Lihat</a></td>
                 {{-- <td>
                   <form method="POST" action="/admin/order/{{$order->id}}">
                     {{ csrf_field() }}
                     <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" name="submit" class="btn btn-danger">Hapus</button>
                   </form>
                 </td> --}}
               </tr>
             @endforeach
           </tbody>
         </table>
     </div>
     <div class="col-md-12">
       {{ $orders->links() }}
     </div>
    </main>
  </div>
</div>
@endsection
