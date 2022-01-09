<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return ResponseFormatter::success($products);
    }
    public function store(CreateProductRequest $request)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store('public/image'); 
        $product = Product::create($data);

        return ResponseFormatter::success($product);
    }
    public function show(Product $product)
    {
        return ResponseFormatter::success($product);
    }
    public function update(CreateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        return ResponseFormatter::success($product);
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return ResponseFormatter::success($product);
    }
}
