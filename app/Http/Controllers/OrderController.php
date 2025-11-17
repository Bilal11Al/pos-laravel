<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::all();
        $title = 'All Transaction';
        return view('order.index', compact('title', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $lastNumber = 0;
        $prefix = 'ODR';
        $date = now()->format('Ymd');
        $lastTransaction = Order::whereDate('created_at', now()->toDateString())->orderBy('id', 'DESC')->first();
        if ($lastTransaction) {
            $lastNumber = (int) substr($lastTransaction->order_code, -4);
        }
        $runingNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        $order_code = $prefix . "-" . $date . "-" . $runingNumber;
        return view('order.create', compact('category', 'order_code'));
    }
    public function getProduct()
    {
        try {
            $product = Product::with('category')->get();
            return response()->json($product);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'fetch Product faild',
                'status' => false,
                'data' => $th->getMessage(),
            ]);
        }
        // $product = Product::with('category')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $order = Order::create([
                'order_code' => $request->orderCode,
                'order_amount' => $request->order_amount,
                'order_status' => 1,
                'order_subtotal' => $request->grandTotal,
            ]);
            foreach ($request->cart as $item) {
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'qty' => $item['quantity'],
                    'order_price' => $item['product_price'],
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'order_code' => $request->order_code,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function paymentCashless(Request $request)
    {
        try {
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');
            $itemDetails = [];
            foreach ($request->cart as $item) {
                $itemDetails[] = [
                    'id' => $item['id'],
                    'price' => $item['product_price'],
                    'quantity' => $item['quantity'],
                    'name' => substr($item['product_name'], 0, 50),
                ];
            }
            $payload = [
                'transaction_details' => [
                    'order_id' => $request->orderCode,
                    'gross_amount' => $request->grandTotal
                ],
                'customer_details' => [
                    'first_name' => 'customer',
                    'email' => 'customer@gmail.com'
                ],
                'item_details' => $itemDetails,
            ];
            $snapToken = Snap::getSnapToken($payload);
            return response()->json([
                'status' => 'success',
                'snapToken' => $snapToken,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
