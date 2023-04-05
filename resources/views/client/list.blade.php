@extends('layouts/main')

@section('content')
<div class="container">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card p-4 shadow-sm rounded border-0">
        <h3 class="fw-bold mb-3">Daftar Buku</h3>
        <table class="table table-striped" id="example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>
                        @if($book->cover)
                        <img class="img-thumbnail" src="{{ asset('storage/covers/' . $book->cover) }}" alt="{{ $book->title }}" width="20%">
                        @else
                        <img class="img-thumbnail" src="https://islandpress.org/sites/default/files/default_book_cover_2015.jpg" alt="{{ $book->title }}" width="20%">
                        @endif
                    </td>
                    <td>{{ $book->book_code }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->year }}</td>
                    <td>
                        <!-- Tombol Modal detail buku -->
                        <a href="{{ url('/detail-book/' . $book->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    {{ $data->links() }}

</div>
@endsection