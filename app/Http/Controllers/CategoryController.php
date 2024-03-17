<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        $hardwareProductsCount = Product::where('category_id', 1)->count();
        $softwareProductsCount = Product::where('category_id', 2)->count();

        return view('dashboard.pages.backoffice_admin.produk.produk', compact('categories', 'hardwareProductsCount', 'softwareProductsCount', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_category' => 'required|string|max:255',
            'nama_category' => 'required|string|max:255',
        ]);

        Category::create([
            'kode_category' => $request->kode_category,
            'nama_category' => $request->nama_category,
        ]);

        return redirect()->route('produk.index')->with('success', 'Category berhasil ditambahkan');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'kode_category' => 'required|string|max:255',
            'nama_category' => 'required|string|max:255',
        ]);

        $category->update([
            'kode_category' => $request->input('kode_category'),
            'nama_category' => $request->input('nama_category'),
        ]);

        return redirect()->route('category.index')->with('update', 'Category berhasil diperbarui');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('produk.index')->with('delete', 'Category berhasil dihapus');
    }
}
