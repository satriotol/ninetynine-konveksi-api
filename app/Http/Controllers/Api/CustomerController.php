<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(5);
        return ResponseFormatter::success($customers);
    }
    public function indexGetId()
    {
        $customers = Customer::all(['id', 'name']);
        return ResponseFormatter::success($customers);
    }
    public function store(CreateCustomerRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $customer = Customer::create($data);
        return ResponseFormatter::success($customer);
    }
    public function show($customer)
    {
        $customer = Customer::where('id', $customer)
            ->with('orders')
            ->first();
        return ResponseFormatter::success($customer);
    }
    public function update(CreateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
        return ResponseFormatter::success($customer);
    }
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return ResponseFormatter::success($customer);
    }
}
