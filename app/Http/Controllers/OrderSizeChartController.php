<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ResponseFormatter;
use App\Http\Requests\Api\CreateOrderSizeChartRequest;
use App\Models\OrderSizeChart;
use Illuminate\Http\Request;

class OrderSizeChartController extends Controller
{
    public function index(Request $request)
    {
        $order_size_charts = OrderSizeChart::where('order_id', $request->order_id)->get();
        return ResponseFormatter::success($order_size_charts);
    }
    public function create(CreateOrderSizeChartRequest $request)
    {
        $data = $request->all();
        foreach ($request->file('file') as $file) {
            $data['file'] = $file->store('file', ['disk' => 'public']);
            $order_size_chart = OrderSizeChart::create([
                'order_id' => $request->order_id,
                'file' => $data['file']
            ]);
        }
        return ResponseFormatter::success($order_size_chart);
    }
    public function destroy(OrderSizeChart $order_size_chart)
    {
        $order_size_chart->deleteFile();
        $order_size_chart->delete();

        return ResponseFormatter::success($order_size_chart);
    }
}
