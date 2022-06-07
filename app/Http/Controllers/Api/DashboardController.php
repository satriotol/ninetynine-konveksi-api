<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_name == 'user') {
            $this_user = Auth::user()->id;
            $orders = Order::where('user_id', $this_user)->get();
            $users = User::where('id', $this_user)->get();
            $customers = Customer::where('user_id', $this_user)->get();
            $end_date = Order::where('user_id', $this_user)->get(['end_date']);
            $order_payments = Order::where('user_id', $this_user)->with('order_payments', function ($q) use ($this_user){
                $q->sum('nominal');
            })->get();
        } else {
            $users = User::all();
            $customers = Customer::all();
            $orders = Order::all();
            $end_date = Order::all(['end_date']);
            $order_payments = OrderPayment::all()->sum('nominal');
        }
        $products = Product::all();

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
