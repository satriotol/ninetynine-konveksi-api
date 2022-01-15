<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return ResponseFormatter::success($customers);
    }
    public function store(CreateCustomerRequest $request)
    {
        $customer = Customer::create($request->all());
        return ResponseFormatter::success($customer);
    }
    public function show(Customer $customer)
    {
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
