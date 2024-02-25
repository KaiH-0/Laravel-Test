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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); // Get original file name
            $image->storeAs('public/images/products/', $imageName); // Store image
            $imageurl = url('storage/images/products/' . $imageName); // Set image URL
            //$image->move('storage/images/products/', $imageName);
        }
        $product = Product::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'price'=> $request->price,
            'quantity'=> $request->quantity,
            'image'=> $imageurl,
        ]);
        $product->categories()->attach($request->input('categories')); // Attach selected categories
        return response()->json($product);
    }
}
