<?php

namespace App\Http\Controllers;

use App\Models\Pos;
use App\Models\Unit;
use App\Models\Order;
use App\Models\Table;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transactionsaleline;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PosController extends Controller
{
    public function index(Request $request)
    {

        $tables = Table::all();
        $customers = Customer::all();
        $products = Product::where('status',1)->get();
        $units = Unit::all();
        $pos = Order::with('customers')->get();
        return view('pos.index', compact('customers', 'products', 'units', 'tables'));
    }


    public function checkout(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $subtotal = $request->input('subtotal');
            $totalPaid = $request->input('total_paid');

            $status = 'due';
            if ($totalPaid > 0 && $totalPaid < $subtotal) {
                $status = 'partial';
            } elseif ($totalPaid == $subtotal) {
                $status = 'paid';
            }
            $transaction = new Transaction;
            $transaction->total_qty = $request->input('total_qty');
            $transaction->subtotal = $request->input('subtotal');
            $transaction->discount = $request->input('discount');
            $transaction->total = $request->input('total');
            $transaction->total_paid = $request->input('total_paid');
            $transaction->status = $status;
            $transaction->table_id = $request->input('table_id');
            $transaction->saler_id = auth()->user()->id;
            $transaction->customer_id = $request->input('customer_id');
            $transaction->save();

            foreach ($request->input('products') as $product) {
                $saleLine = new TransactionSaleLine;
                $saleLine->transaction_id = $transaction->id;
                $saleLine->product_id = $product['product_id'];
                $saleLine->qty = $product['qty'];
                $saleLine->unit_price = $product['unit_price'];
                $saleLine->subtotal = $product['subtotal'];
                $saleLine->save();
            }

            DB::commit();
            return redirect()->route('pos.index')->with('success', 'Data saved successfully !');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('pos.index')->with('error', 'Something went wrong!');
        }
    }
}
