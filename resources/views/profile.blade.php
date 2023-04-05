@extends('layouts/main')

@section('title','Profile')
@section('content')

<div class="row mt-5">
  <div class="col-lg-4">
    <div class="card-data rounded book">
      <div class="row">
        <div class="col-6"><i class="bi bi-journal-bookmark-fill"></i></div>
        <div class="col-6 d-flex flex-column justify-content-center align-items-end">
          <div class="card-desc">Books</div>
          <div class="card-count">
            {{ $book_count }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card-data rounded bg-primary">
      <div class="row">
        <div class="col-6"><i class="bi bi-list-check"></i></div>
        <div class="col-6 d-flex flex-column justify-content-center align-items-end">
          <div class="card-desc">Categories</div>
          <div class="card-count">
            {{ $category_count }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card-data rounded bg-secondary">
      <div class="row">
        <div class="col-6"><i class="bi bi-people"></i></div>
        <div class="col-6 d-flex flex-column justify-content-center align-items-end">
          <div class="card-desc">Publisher</div>
          <div class="card-count">
            {{ $user_count }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


@endsection