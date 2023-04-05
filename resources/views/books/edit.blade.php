@extends('layouts/main')

@section('title','Books')
@section('content')
    <h1 class="h3">Book | Input Data</h1><br/>
    <form action="{{route('books.update', [$data->id])}}" method="POST">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="book_code" class="form-label">Book Code</label>
            <input type="text" class="form-control" id="book_code" name="book_code" value="{{ $data->book_code }}">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $data->author }}">
        </div>
        <div class="mb-3">
            <label for="publisher" class="form-label">Publisher</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $data->publisher }}">
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Publication Year</label>
            <input type="text" class="form-control" id="year" name="year" value="{{ $data->year }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Cover</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="mb-3">
            <a href="{{route('books.index')}}" class="btn btn-secondary"><< Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endsection