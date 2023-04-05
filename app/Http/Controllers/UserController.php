<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;

class UserController extends Controller
{
    public function profile()
    {
        // Ambil data jumlah buku yang ada di database
        $book_count = Book::count();
        // Ambil data jumlah kategori yang ada di database
        $category_count = Category::count();
        // Ambil data jumlah user yang ada di database
        $user_count = User::count();

        return view('dashboard', ['book_count' => $book_count, 'category_count' => $category_count, 'user_count' => $user_count]);

        return view('profile');
    }
}
