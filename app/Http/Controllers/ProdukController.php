<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();

        $hardwareProductsCount = Product::where('category_id', 1)->count();
        $softwareProductsCount = Product::where('category_id', 2)->count();

        return view('dashboard.pages.backoffice_admin.produk.produk', compact('categories', 'products', 'hardwareProductsCount', 'softwareProductsCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_product' => 'required|string|max:255',
            'nama_product' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'pajak' => 'required|numeric',
        ]);
        // $request->merge(['kode_product' => 'SYC-' . $request->input('kode_product')]);
        Product::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Product berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('produk.index')->with('error', 'Product not found');
        }

        $request->validate([
            'kode_product' => 'required|string|max:255',
            'nama_product' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'pajak' => 'required|numeric',
        ]);

        $product->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Product berhasil diupdate');
    }



    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('produk.index')->with('error', 'Product not found');
        }

        $product->delete();
        return redirect()->route('produk.index')->with('success', 'Product berhasil dihapus');
    }


    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('nama_product', 'like', "%$search%")->get();

        return view('dashboard.pages.backoffice_admin.produk.produk', compact('products'));
    }
}
