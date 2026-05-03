<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $items = Product::all();
        return view('Product.index', compact('items'));
    }

    public function create()
    {
        return view('Product.create');
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('Product.index');
    }

    public function show(Product $item)
    {
        return view('Product.show', compact('item'));
    }

    public function edit(Product $item)
    {
        return view('Product.edit', compact('item'));
    }

    public function update(ProductRequest $request, Product $item)
    {
        $item->update($request->validated());
        return redirect()->route('Product.index');
    }

    public function destroy(Product $item)
    {
        $item->delete();
        return redirect()->route('Product.index');
    }
}
