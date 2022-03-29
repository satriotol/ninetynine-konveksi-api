<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderPaymentRequest;
use App\Models\OrderPayment;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public function index()
    {
        $order_payments = OrderPayment::paginate(5);
        return ResponseFormatter::success($order_payments);
    }
    public function store(CreateOrderPaymentRequest $request)
    {
        $data = $request->all();
        $order_payment = OrderPayment::create($data);
        return ResponseFormatter::success($order_payment);
    }
    public function show(OrderPayment $order_payment)
    {
        return ResponseFormatter::success($order_payment);
    }
    public function update(CreateOrderPaymentRequest $request, OrderPayment $order_payment)
    {
        $data = $request->all();
        $order_payment->update($data);
        return ResponseFormatter::success($order_payment);
    }
    public function destroy(OrderPayment $order_payment)
    {
        $order_payment->delete();
        return ResponseFormatter::success($order_payment);
    }
}
