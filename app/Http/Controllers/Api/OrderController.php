<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
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
    public function show($order)
    {
        $order = Order::where('id', $order)
            ->with('order_payments', 'order_details', 'order_images', 'order_size_charts')
            ->first();
        return ResponseFormatter::success($order);
    }
    public function update(CreateOrderRequest $request, Order $order)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $order->update($data);

        return ResponseFormatter::success($order);
    }
    public function destroy(Order $order)
    {
        $order->delete();
        return ResponseFormatter::success($order);
    }
    public function printpdf($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView('pdf_test',compact('order'));
        return $pdf->download("INV-".$order->id.".pdf");
    }
}
