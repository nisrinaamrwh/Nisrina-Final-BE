<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // if(Auth::user()->role == 'Member'){
        //     $movies = Movie::where('user_id', Auth::user()->id)->get();
        // }else{
        //     $movies = Movie::all();
        // }
        $products = Auth::user()->role == 'Member' ? Product::where('user_id', Auth::user()->id)->get() : Product::all();
        return view('products.index', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'thumbnail' => 'required',
            'title' => 'required|min:5',
            'description' => 'required|min:10|max:300',
            'tahun_rilis' => 'required',
            'category' => 'required',
            'harga'=>'required'
        ]);

        // File Processing
        $files = $request->file('thumbnail');
        $fullFileName = $files->getClientOriginalName();
        $fileName = pathinfo($fullFileName)['filename'];
        $extension = $files->getClientOriginalExtension();
        $thumbnail = $fileName . '-' . date('YmdHis') . '.' . $extension;
        $files->storeAs('public/products/', $thumbnail);

        // Insert Data
        Product::Create([
            'thumbnail' => $thumbnail,
            'title' => $request->title,
            'description' => $request->description,
            'tahun_rilis' => $request->tahun_rilis,
            'harga' => $request->harga,
            'genre_id' => $request->category,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/product')->with('success_msg', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('product.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->file('thumbnail' == null)) {
            // Validasi
            $request->validate([
                'title' => 'required|min:5',
                'description' => 'required|min:10|max:300',
                'tahun_rilis' => 'required',
                'category' => 'required',
                'harga'=>'required'
            ]);

            // Temukan Movie yang mau di update dan update
            $product = Product::findOrFail($id);
            $product->update([
                'title' => $request->title,
                'description' => $request->description,
                'tahun_rilis' => $request->tahun_rilis,
                'harga' => $request->harga,
                'genre_id' => $request->category,
            ]);

            return redirect('/product')->with('success_msg', 'Barang berhasil diedit');
        } else {
            // Validasi
            $request->validate([
                'thumbnail' => 'required',
                'title' => 'required|min:5',
                'description' => 'required|min:10|max:300',
                'tahun_rilis' => 'required',
                'category' => 'required',
                'harga'=>'required'
            ]);

            // File Processing
            $files = $request->file('thumbnail');
            $fullFileName = $files->getClientOriginalName();
            $fileName = pathinfo($fullFileName)['filename'];
            $extension = $files->getClientOriginalExtension();
            $thumbnail = $fileName . '-' . date('YmdHis') . '.' . $extension;
            $files->storeAs('public/products/', $thumbnail);

            // Temukan Movie yang mau di update dan update
            $product = Product::findOrFail($id);
            if (Storage::exists('public/products/' . $product->thumbnail)) {
                Storage::delete('public/products/' . $product->thumbnail);
            }
            $product->update([
                'thumbnail' => $thumbnail,
                'title' => $request->title,
                'description' => $request->description,
                'tahun_rilis' => $request->tahun_rilis,
                'harga' => $request->harga,
                'genre_id' => $request->category,
            ]);

            return redirect('/product')->with('success_msg', 'Barang berhasil diedit');
        }
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if (Storage::exists('public/products/' . $product->thumbnail)) {
            Storage::delete('public/products/' . $product->thumbnail);
        }
        $product->delete();

        return redirect('/product')->with('success_msg', 'Barang berhasil dihapus');
    }

    public function acceptProduct($id)
    {
        Product::findOrFail($id)->update([
            'status' => 'Accepted'
        ]);
        return redirect('/product')->with('success_msg', 'Barang berhasil ditambahkan');
    }
}
