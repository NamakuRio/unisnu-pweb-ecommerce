<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * List of Category
     */
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();

        return view('pages.category.index', compact('categories'));
    }

    /**
     * Form Create Category
     */
    public function create()
    {
        return view('pages.category.form-create');
    }

    /**
     * Process Store Category to Database
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $slug = Str::slug($name);

        /** Check Slug is already exists */
        $count = 1;
        while (true) {
            if (Category::whereSlug($slug)->first()) {
                $slug = "$slug-$count";
                $count++;
            } else {
                break;
            }
        }

        try {
            DB::beginTransaction();

            $data = [
                'name' => $name,
                'slug' => $slug,
            ];

            $category = Category::create($data);

            DB::commit();
            Log::info('success store category', [$category]);

            return redirect()->route('category.show', $category)->with('status', 'success')->with('message', 'Berhasil Menambahkan Kategori baru');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('error store category', [$e->getMessage()]);
            return redirect()->route('category.index')->with('status', 'error')->with('message', 'Gagal Menambahkan Kategori baru');
        }
    }

    /**
     * Show detail of Category
     */
    public function show(Category $category)
    {
        return view('pages.category.detail', compact('category'));
    }

    /**
     * Form Edit Category
     */
    public function edit(Category $category)
    {
        return view('pages.category.form-edit', compact('category'));
    }

    /**
     * Proces Update Category
     */
    public function update(Request $request, Category $category)
    {
        $name = $request->input('name');
        $slug = Str::slug($name);

        /** Check Slug is already exists */
        $count = 1;
        while (true) {
            if (Category::whereSlug($slug)->where('id', '!=', $category->id)->first()) {
                $slug = "$slug-$count";
                $count++;
            } else {
                break;
            }
        }

        try {
            DB::beginTransaction();

            $data = [
                'name' => $name,
                'slug' => $slug,
            ];

            $category->update($data);
            $category->refresh();

            DB::commit();
            Log::info('success update category', [$category]);

            return redirect()->route('category.show', $category)->with('status', 'success')->with('message', 'Berhasil Memperbarui Data Kategori');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('error update category', [$e->getMessage()]);
            return redirect()->route('category.show', $category)->with('status', 'error')->with('message', 'Gagal Memperbarui Data Kategori');
        }
    }

    /**
     * Destroy Category
     */
    public function destroy(Category $category)
    {
        $category->products()->delete();
        $category->delete();

        return redirect()->route('category.index')->with('status', 'success')->with('message', 'Berhasil Menghapus Kategori');
    }
}
