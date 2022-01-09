<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateProductMaterialRequest;
use App\Models\ProductMaterial;
use Illuminate\Http\Request;

class ProductMaterialController extends Controller
{
    public function index()
    {
        $product_materials = ProductMaterial::all();
        return ResponseFormatter::success($product_materials);
    }
    public function store(CreateProductMaterialRequest $request)
    {
        $data = $request->all();
        $product_material = ProductMaterial::create($data);

        return ResponseFormatter::success($product_material);
    }
    public function show(ProductMaterial $product_material)
    {
        return ResponseFormatter::success($product_material);
    }
    public function update(CreateProductMaterialRequest $request, ProductMaterial $product_material)
    {
        $data = $request->all();
        $product_material->update($data);
        return ResponseFormatter::success($product_material);
    }
    public function destroy(ProductMaterial $product_material)
    {
        $product_material->delete();
        return ResponseFormatter::success($product_material);
    }
}
