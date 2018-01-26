@extends('layouts.paneladmin')

@section('content')
<div class="container-fluid">
  <div class="row">
      <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="/admin">Dashboard <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/produk">Produk</a>
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
                <h1>Dashboard</h1>
                <h1>Halo Selamat Datang  !</h1>
                <h2>Web PROJEK UAS VISUAL 3</h2>
                <h2>Fathurrahman Sholihin</h2>
                <h2>15.63.0674</h2>
      </main>

  </div>
</div>
@endsection
