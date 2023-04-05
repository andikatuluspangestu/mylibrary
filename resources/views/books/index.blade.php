@extends('layouts/main')

@section('title','Books')
@section('content')

    <h1 class="h3">Books</h1>
    <a href="{{route('books.create')}}">
        <button type="button" class="btn btn-primary btn-sm float-end">+Tambah Data</button>
    </a>

    <table class="table">
        <thead>
            <tr>
                <th>Book Code</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Year</th>
                <th>Cover</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->book_code }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->author }}</td>
                    <td>{{ $item->publisher }}</td>
                    <td>{{ $item->year }}</td>
                    <td>
                        {{-- Jika image tidak ada, maka tampilkan gambar default --}}
                            @if ($item->cover == null)
                            <img src="{{ Storage::url('public/covers/cover-not-found.jpg')}}" class="rounded" style="object-fit: cover; width: 40px; height: 60px;">
                        @else
                            <img src="{{ Storage::url('public/covers/') . $item->cover }}" class="rounded" style="object-fit: cover; width: 40px; height: 60px;">
                        @endif
                    </td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ route('books.show', [$item->id]) }}" class="btn btn-secondary btn-sm">Detail</a>
                        
                        <a href="{{ route('books.edit', [$item->id]) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form class="d-inline" action="{{route('books.destroy', [$item->id])}}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
@endsection