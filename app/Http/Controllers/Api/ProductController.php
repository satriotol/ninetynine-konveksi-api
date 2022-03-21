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
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('image', ['disk' => 'public']);
        }
        $product = Product::create($data);

        return ResponseFormatter::success($product);
    }
    public function show(Product $product)
    {
        return ResponseFormatter::success($product);
    }
    public function update(CreateProductRequest $request, Product $product)
    {
        $data = $request->only(['name', 'start_price']);
        if ($request->file('image')) {
            $image = $request->file('image')->store('image', ['disk' => 'public']);
            $product->deleteImage();
            $data['image'] = $image;
        }
        $product->update($data);
        return ResponseFormatter::success($product);
    }
    public function destroy(Product $product)
    {
        $product->deleteImage();
        $product->delete();
        return ResponseFormatter::success($product);
    }
}
