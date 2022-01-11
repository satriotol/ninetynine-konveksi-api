<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return ResponseFormatter::success($orders);
    }

    public function store(CreateOrderRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $order = Order::create($data);

        return ResponseFormatter::success($order);
    }
}
