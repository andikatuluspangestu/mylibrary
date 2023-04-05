<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\BookController;


class ClientController extends Controller
{
    // method index untuk menampilkan list buku
    public function index()
    {
        $data = Book::orderBy('id', 'asc')->paginate(5);
        return view('client.list', ['data' => $data]);
    }

    // method detailBook untuk menampilkan detail buku
    public function detailBook($id)
    {
        $data = Book::find($id);
        $title = 'Detail Buku';
        return view('client.detail-book', compact('data', 'title'));
    }

}
