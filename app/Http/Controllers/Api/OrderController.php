<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Mail\SendEmail;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $order_query = Order::when($request->customer_name, function ($q) use ($request) {
            $q->whereHas('customer', function ($sq) use ($request) {
                $sq->where('name', 'like', "%" . $request->customer_name . "%");
            });
        })->when($request->user_name, function ($q) use ($request) {
            $q->whereHas('user', function ($sq) use ($request) {
                $sq->where('name', 'like', "%" . $request->user_name . "%");
            });
        });
        if (Auth::user()->role->name == 'user') {
            $orders = $order_query->where('user_id', Auth::user()->id)->orderBy('id', 'desc');
        } else {
            $orders = $order_query->orderBy('id', 'desc');
        }
        return ResponseFormatter::success(
            [
                'orders' => $orders->paginate(5),
                'total_order' => $orders->count(),
                'total_money' => $orders->with(['order_payments' => function ($q) {
                    $q->sum('nominal');
                }])->get()
            ]
        );
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
        $order->order_details()->delete();
        $order->order_payments()->delete();
        return ResponseFormatter::success($order);
    }
    public function printpdf($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView('pdf_test', compact('order'));
        return $pdf->download("INV-" . $order->id . ".pdf");
    }
    public function sendemail(Order $order)
    {
        Mail::to($order->customer->email)->send(new SendEmail($order));
    }
}
