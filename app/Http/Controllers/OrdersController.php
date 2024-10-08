<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $data = Products::all();
        return view('front_office.orders.index', [
            'data' => $data,
            'title' => 'Pesan Produk'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'products.*' => 'required|integer|exists:products,id',
            'quantities.*' => 'required|integer|min:1',
            'prices.*' => 'required|string'
        ]);

        $prices = array_map(function ($price) {
            return str_replace([',', '.'], '', $price);
        }, $request->prices);

        $order = new Orders();
        $order->customer_id = auth()->guard('customers')->user()->id;
        $order->save();

        foreach ($request->products as $index => $productId) {
            $orderItem = new OrderItems();
            $orderItem->order_id = $order->id;
            $orderItem->products_id = $productId;
            $orderItem->quantity = $request->quantities[$index];
            $orderItem->price = $prices[$index];
            $orderItem->save();
        }
        return response()->json(['message' => 'Order saved successfully']);
    }
}
