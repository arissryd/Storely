<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show dashboard
     */
    public function index()
    {
        $userName = session('user_name');
        $userId = session('user_id');

        // Get statistics
        $totalCategories = Category::where('merchant_id', $userId)->count();
        $totalProducts = Product::where('merchant_id', $userId)->count();
        $recentProducts = Product::where('merchant_id', $userId)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'userName',
            'totalCategories',
            'totalProducts',
            'recentProducts'
        ));
    }
}
