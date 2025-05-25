<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

  public function index()
    {
        // Načtěte produkty z databáze
        $products = Product::all();

        // Předání produktů do view
        return view('home', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
      public function show($id)
    {
        // Načte produkt podle ID
        $product = Product::findOrFail($id);

        // Předá produkt do view
        return view('products.show', compact('product'));
    }
    public function search(Request $request)
        {
            $query = $request->input('query');
            $products = Product::where('name', 'LIKE', "%{$query}%")->get();
            return view('products.index', compact('products'));
        }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
