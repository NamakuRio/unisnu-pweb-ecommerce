<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * List of Product
     */
    public function index(Request $request)
    {
        $products = Product::with('category')->get();

        return view('pages.product.index', compact('products'));
    }

    /**
     * Form Create Product
     */
    public function create()
    {
        $categories = Category::all();

        return view('pages.product.form-create', compact('categories'));
    }

    /**
     * Process Store Product to Database
     */
    public function store(Request $request)
    {
        $categoryId = $request->input('category_id');
        $name = $request->input('name');
        $slug = Str::slug($name);
        $price = $request->input('price');
        $stock = $request->input('stock');

        /** Check Slug is already exists */
        $count = 1;
        while (true) {
            if (Product::whereSlug($slug)->first()) {
                $slug = "$slug-$count";
                $count++;
            } else {
                break;
            }
        }

        try {
            DB::beginTransaction();

            // Simpan gambar
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = $slug . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/product_images', $imageName);
            }

            $data = [
                'name' => $name,
                'slug' => $slug,
                'price' => $price,
                'stock' => $stock,
                'photo_url' => $imageName ?? null,
            ];

            $category = Category::find($categoryId);
            $product = $category->products()->create($data);

            DB::commit();
            Log::info('success store product', [$product]);

            return redirect()->route('product.show', $product)->with('status', 'success')->with('message', 'Berhasil Menambahkan Produk baru');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('error store product', [$e->getMessage()]);
            return redirect()->route('product.index')->with('status', 'error')->with('message', 'Gagal Menambahkan Produk baru');
        }
    }

    /**
     * Show detail of Product
     */
    public function show(Product $product)
    {
        return view('pages.product.detail', compact('product'));
    }

    /**
     * Form Edit Product
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('pages.product.form-edit', compact('product', 'categories'));
    }

    /**
     * Proces Update Product
     */
    public function update(Request $request, Product $product)
    {
        $categoryId = $request->input('category_id');
        $name = $request->input('name');
        $slug = Str::slug($name);
        $price = $request->input('price');
        $stock = $request->input('stock');

        /** Check Slug is already exists */
        $count = 1;
        while (true) {
            if (Product::whereSlug($slug)->where('id', '!=', $product->id)->first()) {
                $slug = "$slug-$count";
                $count++;
            } else {
                break;
            }
        }

        try {
            DB::beginTransaction();

            // Simpan gambar baru jika ada
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = Str::slug($name) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/product_images', $imageName);
                $product->photo = $imageName;
            }

            // Update data produk
            $product->category_id = $categoryId;
            $product->name = $name;
            $product->price = $price;
            $product->stock = $stock;
            $product->save();

            DB::commit();
            Log::info('success update product', [$product]);

            return redirect()->route('product.show', $product)->with('status', 'success')->with('message', 'Berhasil Memperbarui Data Produk');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('error update product', [$e->getMessage()]);
            return redirect()->route('product.show', $product)->with('status', 'error')->with('message', 'Gagal Memperbarui Data Produk');
        }
    }

    /**
     * Destroy Product
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->with('status', 'success')->with('message', 'Berhasil Menghapus Produk');
    }
}
