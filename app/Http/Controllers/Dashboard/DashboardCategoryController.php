<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('pages.admin.dataCategory.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.dataCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'unique:categories|string|required|max:255',
            'slug' => 'unique:categories|string|required|max:255'
        ]);

        $category = Category::create($data);

        if($category) {
            return redirect()->route('data_categories.index')->with('success', 'Kategori berhasil ditambahkan!');
        } else {
            return redirect()->route('data_categories.index')->with('error', 'Kategori gagal dibuat!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.admin.dataCategory.edit', ['category' => $category]);
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
        $dataValid = $request->validate([
            'nama_kategori' => 'unique:categories|string|required|max:255',
            'slug' => 'unique:categories|string|required|max:255'
        ]);

        $category = Category::find($id)->update($dataValid);

        if ($category) {
            return redirect()->route('data_categories.index')->with('success', 'Kategori berhasil diubah!');
        } else {
            return redirect()->route('data_categories.index')->with('error', 'Kategori gagal diubah!');
        }
    }

    public function slug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('data_categories.index')->with('error', 'Kategori berhasil dihapus!');
    }
}
