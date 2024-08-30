<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Orders;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrderItemsController extends Controller
{
    private $counter = 1;
    public function index(Request $request)
    {
        if (Auth::guard('customers')->check()) {
            $data = Orders::with('customers')->where('customer_id', auth()->guard('customers')->id());
        } else {
            $data = Orders::with('customers')->latest();
        }
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereHas('customers', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword%");
                    });
                })
                ->addColumn('no', function ($data) {
                    return $this->counter++;
                })
                ->addColumn('name', function ($data) {
                    return $data->customers->name;
                })
                ->addColumn('created_at', function ($data) {
                    return  Carbon::parse($data->created_at)->format('d F Y/h.iA');
                })
                ->addColumn('action', function ($data) {
                    return "
                            <button onclick='redirectDetail($data->id)' class='btn btn-primary'>Detail Pesanan</button>
                            <button onclick='deleteData($data->id)' class='btn btn-danger text-white'>Hapus Data</button>
                    ";
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        $getData = $data->get();
        $deleteUrl = 'orderItem.delete';
        $title = "Data Pemesanan";
        return view('order.index', compact('request', 'getData', 'title', 'deleteUrl'));
    }
    public function show(Request $request, $id)
    {
        $data = OrderItems::with(['products', 'order'])->where('order_id', $id);
        if ($request->filter == 'terbaru') {
            $data->orderBy('created_at', 'desc');
        }
        if ($request->filter == 'terbaru') {
            $data->orderBy('created_at', 'asc');
        }
        if (Auth::guard('customers')->check()) {
            $user = Auth::guard('customers')->user();

            $cek = OrderItems::with(['products', 'order'])
                ->whereHas('order', function ($query) use ($user) {
                    $query->where('customer_id', $user->id);
                })
                ->where('order_id', $id)
                ->first();
            if (!$cek) {
                abort(403, 'Unauthorized action.');
            }
        }

        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereHas('products', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword%");
                    });
                })
                ->addColumn('no', function ($data) {
                    return $this->counter++;
                })
                ->addColumn('name', function ($data) {
                    return $data->products->name;
                })
                ->addColumn('quantity', function ($data) {
                    return $data->quantity;
                })
                ->addColumn('price', function ($data) {
                    return number_format($data->price, 0, ',', '.');
                })
                ->addColumn('action', function ($data) {
                    return "<div class='dropdown btn-aksi'>
                        <button class='btn btn-sm btn-outline-info' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                            <i class='ri-more-line'></i>
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                            <li><button onclick='deleteData($data->id)' aria-expanded='false' class='btn'><i class='ri-close-line'></i> Hapus Data</button></li>
                        </ul>
                    </div>";
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        $getData = $data->get();
        $deleteUrl = 'orderItem.destroy';
        $title = "Detail Pesanan";
        $formTitle = "Pesanan";
        return view('pesanan.index', compact('request', 'deleteUrl', 'getData', 'title', 'id'));
    }
    public function destroy($id)
    {
        $data = OrderItems::findOrFail($id);
        $data->delete();

        flash('Berhasil Menghapus Data');
        return back();
    }
    public function delete($id)
    {
        $order = Orders::findOrFail($id);

        foreach ($order->OrderItems as $item) {
            $item->delete();
        }

        $order->delete();

        flash('Berhasil Menghapus Data');
        return back();
    }
}
