<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    private $counter = 1;
    public function index(Request $request)
    {
        $data = Products::latest();
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('no', function ($data) {
                    return $this->counter++;
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('description', function ($data) {
                    return $data->description;
                })
                ->addColumn('price', function ($data) {
                    return number_format($data->price, 0, ',', '.');
                })
                ->addColumn('category', function ($data) {
                    return $data->category;
                })
                ->addColumn('action', function ($data) {
                    return "<div class='dropdown btn-aksi'>
                        <button class='btn btn-sm btn-outline-info' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                            <i class='ri-more-line'></i>
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                            <li><button onclick='editData(" . json_encode($data) . ")' aria-expanded='false' class='btn'><i class='ri-pencil-line'></i> Ubah Data</button></li>
                            <li><button onclick='deleteData($data->id)' aria-expanded='false' class='btn'><i class='ri-close-line'></i> Hapus Data</button></li>
                        </ul>
                    </div>";
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        $getData = $data->get();
        $storeUrl = 'products.store';
        $deleteUrl = 'products.destroy';
        $updateUrl = 'products.update';
        $title = "Data Produk";
        $formTitle = "Produk";
        return view('back_office.products.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category' => 'required',
        ], [
            'name.required' => 'Nama Produk Diperlukan',
            'price.required' => 'Harga diperlukan',
            'price.numeric' => 'Harga harus berupa angka',
            'description.required' => 'Deskripsi Diperlukan',
            'category.required' => 'Kategori Diperlukan',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();

        $validatedData['price'] = str_replace('.', '', $validatedData['price']);

        Products::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $data = Products::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category' => 'required',
        ], [
            'name.required' => 'Nama Produk Diperlukan',
            'price.required' => 'Harga diperlukan',
            'price.numeric' => 'Harga harus berupa angka',
            'description.required' => 'Deskripsi Diperlukan',
            'category.required' => 'Kategori Diperlukan',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();

        $validatedData['price'] = str_replace('.', '', $validatedData['price']);

        $data->update($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function destroy($id)
    {
        $productsData = Products::findOrFail($id);
        $productsData->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
    public function dashboard()
    {
        $totalRupiah = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereDate('orders.created_at', Carbon::today())
            ->sum(DB::raw('order_items.quantity * order_items.price'));

        $totalRupiah = 'Rp. ' . number_format($totalRupiah, 2, ',', '.');

        return view('back_office.dashboard', [
            'totalRupiah' => $totalRupiah,
            'title' => 'Total Rupiah Penjualan Produk Hari Ini'
        ]);
    }
}
