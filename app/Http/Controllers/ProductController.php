<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        } elseif ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        } elseif ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->paginate(12)->withQueryString();

        if ($request->ajax()) {
            return view('partials.product-list', compact('products'))->render();
        }

        return view('product', [
            'products' => $products,
            'search' => $request->search,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
        ]);
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        return view('product-detail', compact('product'));
    }
}
