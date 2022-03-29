<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $customers = Customer::all();
        $products = Product::all();
        $orders = Order::all();
        $order_payments = OrderPayment::all()->sum('nominal');
        $end_date = Order::all(['end_date']);

        return ResponseFormatter::success([
            'total_user' => $users->count(),
            'total_customer' => $customers->count(),
            'total_product' => $products->count(),
            'total_order' => $orders->count(),
            'total_money' => $orders->sum('total_money'),
            'order_payments' => $order_payments,
            'end_date' => $end_date,
        ]);
    }
}
