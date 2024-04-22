<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pageProductEmployee()
    {
        $data = Product::latest()->get();
        return view('Employee.product_employee', compact('data'));
    }

    public function search(Request $request)
    {


    }

    public function index(Request $request)
    {
        $data=[];

        if ($search = $request->q) {
                $data = Product::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('stock', 'LIKE', "%$search%");
                })->get();

        }else{
            $data = Product::latest()->get();
        }
        return view('product.product', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $photo = $request->file('photo');

        // Buat nama unik untuk file gambar
        $imgName = $request->name . '-' . now()->timestamp . '.' . $photo->getClientOriginalExtension();


        if (!Storage::exists('cover')) {
            Storage::makeDirectory('cover');
        }

        $photo->move('storage/public/cover', $imgName);

        // Simpan data produk ke dalam database
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo' => $imgName,
        ]);

        return redirect()->route('pageProduct');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $data = Product::where('id', $id)->first();
        return view('product.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photo = $request->file('photo');

        // Buat nama unik untuk file gambar
        $imgName = $request->name . '-' . now()->timestamp . '.' . $photo->getClientOriginalExtension();

        Product::where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'photo' => $imgName,
        ]);

        if (!Storage::exists('cover')) {
            Storage::makeDirectory('cover');
        }
        $photo->storeAs('public/cover', $imgName);

        return redirect()->route('pageProduct');
    }

    public function pageStock($id)
    {
        $data = Product::where('id', $id)->first();
        return view('product.stock', compact('data'));
    }
    public function updateStock(Request $request, Product $product, $id)
    {
        $request->validate([
            'stock' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->increment('stock', $request->stock);

        return redirect()->route('pageProduct');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('pageProduct');
    }
}
