<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display listing of products
     */
    public function index(Request $request)
    {
        $query = Product::active();

        // Filter by category
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Search by name
        if ($request->has('search')) {
            $search = $request->search;
            $locale = app()->getLocale();
            $nameColumn = $locale === 'en' ? 'name_en' : 'name_id';
            $query->where($nameColumn, 'like', "%{$search}%");
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        $query = match ($sort) {
            'price_asc' => $query->orderBy('price_idr', 'asc'),
            'price_desc' => $query->orderBy('price_idr', 'desc'),
            'popular' => $query->orderBy('views', 'desc'),
            'latest' => $query->latest(),
            default => $query->latest(),
        };

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Display a single product
     */
    public function show(Product $product)
    {
        // Increment view count
        $product->increment('views');

        // Get related products
        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    /**
     * Get featured products (API)
     */
    public function featured()
    {
        $products = Product::featured()->limit(8)->get();

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }
}
