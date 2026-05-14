<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Show list of categories
     */
    public function index()
    {
        $userId = session('user_id');
        $categories = Category::where('merchant_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store category to database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|unique:categories,name',
            'description' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.min' => 'Nama kategori minimal 3 karakter',
            'name.unique' => 'Nama kategori sudah ada',
            'description.max' => 'Deskripsi maksimal 500 karakter',
        ]);

        Category::create([
            'merchant_id' => session('user_id'),
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Show edit form
     */
    public function edit(Category $category)
    {
        // Ensure user owns this category
        if ($category->merchant_id != session('user_id')) {
            abort(403, 'Anda tidak memiliki akses ke kategori ini');
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update category
     */
    public function update(Request $request, Category $category)
    {
        // Ensure user owns this category
        if ($category->merchant_id != session('user_id')) {
            abort(403, 'Anda tidak memiliki akses ke kategori ini');
        }

        $validated = $request->validate([
            'name' => 'required|string|min:3|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.min' => 'Nama kategori minimal 3 karakter',
            'name.unique' => 'Nama kategori sudah ada',
            'description.max' => 'Deskripsi maksimal 500 karakter',
        ]);

        $category->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Delete category
     */
    public function destroy(Category $category)
    {
        // Ensure user owns this category
        if ($category->merchant_id != session('user_id')) {
            abort(403, 'Anda tidak memiliki akses ke kategori ini');
        }

        $categoryName = $category->name;
        $category->delete();

        return redirect()->route('categories.index')->with('success', "Kategori '$categoryName' berhasil dihapus");
    }
}
