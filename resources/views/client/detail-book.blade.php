@extends('layouts/main')

@section('content')

<!-- Title Halaman -->
@section('title','Detail Buku')

<!-- Membuat Card Detail Buku -->
<div class="card p-4">
  <div class="table">
    <div class="row">
      <div class="col-md-3">
        <!-- Jika terdapat cover buku maka tampilkan, jika tidak tampilkan cover default -->
        @if($data->cover)
        <img id="img-cover" class="img-thumbnail" src="{{ asset('storage/covers/' . $data->cover) }}" alt="{{ $data->title }}" width="100%">
        @else
        <img id="img-cover" class="img-thumbnail" src="https://islandpress.org/sites/default/files/default_book_cover_2015.jpg" alt="{{ $data->title }}" width="100%">
        @endif
      </div>
      <div class="col-md-9">
        <div class="card-body">
          <h1 class="card-title">{{ $data->title }}</h1>
          <hr>
          <table>
            <tr>
              <td>Kode Buku</td>
              <td>:</td>
              <td>
                &nbsp;{{ $data->book_code }}
              </td>
            </tr>
            <tr>
              <td>Penulis</td>
              <td>:</td>
              <td>&nbsp;{{ $data->author }}</td>
            </tr>
            <tr>
              <td>Penerbit</td>
              <td>:</td>
              <td>&nbsp;{{ $data->publisher }}</td>
            </tr>
            <tr>
              <td>Tahun</td>
              <td>:</td>
              <td>&nbsp;{{ $data->year }}</td>
            </tr>
          </table>
          <p class="card-text mt-1"><small class="text-muted">
              Data diambil dari database pada tanggal {{ date('d-m-Y') }}
            </small></p>
          <!-- Tombol Pinjam -->
          <a href="{{ url('/borrow-book/' . $data->id) }}" class="btn btn-sm btn-primary mt-4">Pinjam</a>
          <a href="{{ url('/list-books') }}" class="btn btn-sm btn-danger mt-4">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection