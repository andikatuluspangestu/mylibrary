<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::orderBy('id', 'asc')->paginate(5);
        return view('books.index', ['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // eksekusi perintah pembuatan folder storage di public
        // php artisan storage:link

        // silakan dibuat session request yg lengkap
        Session::flash('book_code', $request->book_code);
        Session::flash('title', $request->title);
        Session::flash('author', $request->author);
        Session::flash('publisher', $request->publisher);
        Session::flash('year', $request->year);


        //validasi silakan dilengkapi dengan atribute lainnya
        $request->validate([
            'book_code' => 'required|unique:books|max:7',
            'title' => 'required|max:100',
            'author' => 'required|max:50',
            'publisher' => 'required|max:50',
            'year' => 'required|integer',
            'image'  => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika image terisi, maka upload image
        if ($request->hasFile('image')) {

            // Mengambil file image yang diupload
            $uploaded_image = $request->file('image');

            // Mengambil extension file image
            $extension = $uploaded_image->getClientOriginalExtension();

            // Membuat nama file image secara random berikut extension
            $filename = md5(time()) . '.' . $extension;

            // Menyimpan image ke folder public/covers
            $path = $uploaded_image->storeAs('public/covers', $filename);

            // Insert data ke table books, value cover berisi filename dr image yg diupload
            Book::create([
                'cover' => $filename,
                'book_code' => $request->book_code,
                'title' => $request->title,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'year' => $request->year,
            ]);
        } else {
            // Jika image tidak terisi, insert data ke table books dgn value cover adalah cover-not-found.jpg
            Book::create([
                'cover' => 'cover-not-found.jpg',
                'book_code' => $request->book_code,
                'title' => $request->title,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'year' => $request->year,
            ]);
        }

        return redirect()->route('books.index')->with('success', 'Berhasil create data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books/show', ['data' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //coba
        {
            $data = Book::findOrFail($id);
            return view('books/edit', ['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //coba
        {
            $request->validate([

                'book_code' => 'required',
                'title' => 'required',
                'author' => 'required',
                'publisher' => 'required',
                'year' => 'required',

            ], [

                'book_code.required' => 'Book Code Buku Wajib Diisi',
                'title.required' => 'Judul Buku Wajib Diisi',
                'author.required' => 'author Buku Wajib Diisi',
                'publisher.required' => 'publisher Buku Wajib Diisi',
                'year.required' => 'year Buku Wajib Diisi',

            ]);

            Book::where('id', $id)
                ->update([
                    'book_code' => $request->book_code, 'title' => $request->title,
                    'author' => $request->author, 'publisher' => $request->publisher, 'year' => $request->year,
                    'cover' => $request->cover
                ]);



            return redirect()->route('books.index')->with('success', 'Berhasil update data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::where('id', $id)->delete();
        return redirect()->route('books.index')->with('success', 'Berhasil Hapus data');
    }
}
