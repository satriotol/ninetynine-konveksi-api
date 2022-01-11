<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderDetailRequest;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function store(CreateOrderDetailRequest $request)
    {
        $data = $request->all();
        $order_detail = OrderDetail::create($data);
        return ResponseFormatter::success($order_detail);
    }
    public function show(OrderDetail $order_detail)
    {
        return ResponseFormatter::success($order_detail);
    }
    public function update(CreateOrderDetailRequest $request, OrderDetail $order_detail)
    {
        $data = $request->all();
        $order_detail->update($data);
        return ResponseFormatter::success($order_detail);
    }
    public function destroy(OrderDetail $order_detail)
    {
        $order_detail->delete();
        return ResponseFormatter::success($order_detail);
    }
}
