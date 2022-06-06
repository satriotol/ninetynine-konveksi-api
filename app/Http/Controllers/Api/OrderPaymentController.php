<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderPaymentRequest;
use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderPaymentController extends Controller
{
    public function index()
    {
        $order_payment_query = OrderPayment::orderBy('id', 'desc')->orderBy('id', 'desc');
        if (Auth::user()->role->name == 'user') {
            $order_payments = $order_payment_query->whereHas('order', function ($q) {
                $q->where('user_id', Auth::user()->id);
            });
        } else {
            $order_payments = $order_payment_query;
        }
        return ResponseFormatter::success($order_payments->paginate(5));
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
