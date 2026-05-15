<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Show list of products
     */
    public function index()
    {
        $userId = session('user_id');
        $products = Product::where('merchant_id', $userId)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $userId = session('user_id');
        $categories = Category::where('merchant_id', $userId)->get();

        return view('products.create', compact('categories'));
    }

    /**
     * Store product to database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:102040',
        ], [
            'name.required' => 'Nama produk harus diisi',
            'name.min' => 'Nama produk minimal 3 karakter',
            'category_id.required' => 'Kategori harus dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'stock.required' => 'Stok harus diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'photo.required' => 'Foto produk harus diunggah',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'photo.max' => 'Ukuran gambar maksimal 10MB',
        ]);

        // Upload photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $photoPath = $file->storeAs('products', $filename, 'public');
        }

        Product::create([
            'merchant_id' => session('user_id'),
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'photo' => $photoPath,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Show edit form
     */
    public function edit(Product $product)
    {
        // Ensure user owns this product
        if ($product->merchant_id != session('user_id')) {
            abort(403, 'Anda tidak memiliki akses ke produk ini');
        }

        $userId = session('user_id');
        $categories = Category::where('merchant_id', $userId)->get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        // Ensure user owns this product
        if ($product->merchant_id != session('user_id')) {
            abort(403, 'Anda tidak memiliki akses ke produk ini');
        }

        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102040',
        ], [
            'name.required' => 'Nama produk harus diisi',
            'name.min' => 'Nama produk minimal 3 karakter',
            'category_id.required' => 'Kategori harus dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'stock.required' => 'Stok harus diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'photo.max' => 'Ukuran gambar maksimal 10MB',
        ]);

        // Handle photo update
        $photoPath = $product->photo;
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $photoPath = $file->storeAs('products', $filename, 'public');
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'photo' => $photoPath,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        // Ensure user owns this product
        if ($product->merchant_id != session('user_id')) {
            abort(403, 'Anda tidak memiliki akses ke produk ini');
        }

        // Delete photo if exists
        if ($product->photo && Storage::disk('public')->exists($product->photo)) {
            Storage::disk('public')->delete($product->photo);
        }

        $productName = $product->name;
        $product->delete();

        return redirect()->route('products.index')->with('success', "Produk '$productName' berhasil dihapus");
    }
}
