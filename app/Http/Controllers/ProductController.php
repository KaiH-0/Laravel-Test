<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */

     public function index()
    {
        $products = Product::with('categories')->get();
        return response()->json($products);
    }

    public function create()
    {
        return Inertia::render('Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->categories()->attach($request->input('categories')); // Attach selected categories
        return response()->json($product);
    }
}
