<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function getAllOrders()
    {
        return Order::orderBy('created_at', 'desc')->get();
    }

    public function createOrder(array $data)
    {
        return Order::create($data);
    }

    public function updateOrder($id, array $data)
    {
        $order = Order::findOrFail($id);
        $order->update($data);
        return $order;
    }

    public function deleteOrder($id)
    {
        return Order::destroy($id);
    }
}