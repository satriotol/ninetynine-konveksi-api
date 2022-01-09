<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ResponseFormatter;
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
        
    }
}
