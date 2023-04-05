<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //diatur tampil 5 baris per page
        $data = Category::orderBy('name','asc')->paginate(5);
        return view('categories/index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);

        $request->validate([
            'name' => 'required',
        ]);
        // //simpan data baru ke database
        // $data = new Category();
        // $data->name = $request->name;
        // $data->save();

        // alternative dgn create method, namun membutuhkan fillable atau guarded di Model
        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Berhasil create data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Category::findOrFail($id);
        return view('categories/show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // Menampilkan detail data dengan menampilkan form edit
         $data = Category::findOrFail($id);

         // Menampilkan form edit
         return view('categories/edit', ['data' => $data]);
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
        // Validasi Form
        $request->validate([
            'name' => 'required',
        ],['name.required' => 'Nama Category Wajib Diisi',
        ]);

        // Menampilkan detail data dengan menampilkan form edit
        $data = Category::findOrFail($id);

        // Mengupdate data
        $data->update($request->all());

        // Redirect dengan pesan sukses
        Session::flash('success', 'Category updated successfully!');

        // Redirect ke halaman categories
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Menampilkan detail data dengan menampilkan form edit
        $data = Category::findOrFail($id);

        // Menghapus data
        $data->delete();

        // Redirect dengan pesan sukses
        Session::flash('success', 'Category deleted successfully!');

        // Redirect ke halaman categories
        return redirect()->route('categories.index'); 
    }
}