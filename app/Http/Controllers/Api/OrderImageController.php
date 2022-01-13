<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderImageRequest;
use App\Models\OrderImage;
use Illuminate\Http\Request;

class OrderImageController extends Controller
{
    public function index(Request $request)
    {
        $order_images = OrderImage::where('order_id', $request->order_id)->get();
        return ResponseFormatter::success($order_images);
    }
    public function create(CreateOrderImageRequest $request)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store('image', ['disk' => 'public']);
        $order_image = OrderImage::create([
            'order_id' => $request->order_id,
            'image' => $data['image']
        ]);
        return ResponseFormatter::success($order_image);
    }
    public function destroy(OrderImage $order_image)
    {
        $order_image->deleteImage();
        $order_image->delete();

        return ResponseFormatter::success($order_image);
    }
}
