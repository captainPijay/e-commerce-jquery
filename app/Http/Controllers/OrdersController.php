<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'products.*' => 'required|integer|exists:products,id',
            'quantities.*' => 'required|integer|min:1',
            'prices.*' => 'required|string'
        ]);

        // Proses input prices untuk menghilangkan tanda koma atau titik
        $prices = array_map(function ($price) {
            // Ganti koma atau titik dengan string kosong untuk menghilangkan pemisah ribuan
            return str_replace([',', '.'], '', $price);
        }, $request->prices);

        // Simpan order
        $order = Orders::create(); // Hanya menyimpan ID

        // Simpan order items
        foreach ($request->products as $index => $productId) {
            $orderItem = new OrderItems();
            $orderItem->order_id = $order->id;
            $orderItem->products_id = $productId;
            $orderItem->quantity = $request->quantities[$index];
            $orderItem->price = $prices[$index]; // Harga tanpa pemisah ribuan
            $orderItem->save();
        }
        // Flash message untuk konfirmasi
        return response()->json(['message' => 'Order saved successfully']);
    }
}
