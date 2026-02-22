<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number' => 'required|string|unique:orders,order_number',
            'item_name' => 'required|string|max:255',
        ]);

        $this->orderService->createOrder($validated);

        return response()->json(['message' => 'Order berhasil ditambahkan']);
    }

    public function destroy($id)
    {
        $this->orderService->deleteOrder($id);
        return response()->json(['message' => 'Order berhasil dihapus']);
    }
}