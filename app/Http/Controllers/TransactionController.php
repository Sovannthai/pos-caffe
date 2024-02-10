<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // public function index(Request $request)
    // {
    //     $customers = Customer::all();
    //     $transactions = Transaction::all();
    //     $totalpaid = $transactions->sum('total_paid');
    //     $subtotal = $transactions->sum('subtotal');
    //     $total_amount = $transactions->sum('total');
    //     $discount = $transactions->sum('discount');
    //     if ($request->start_date) {
    //         $transactions = $transactions->where('created_at', '>=', $request->start_date);
    //     }
    //     if ($request->end_date) {
    //         $transactions = $transactions->where('created_at', '<=', $request->end_date . ' 23:59:59');
    //     }

    //     $transactions = Transaction::query();
    //     if ($request->has('status') && $request->status !== '') {
    //         $transactions->where('status', $request->status);
    //     }
    //     if ($request->has('customer') && $request->customer !== '') {
    //         $transactions->where('customer_id', $request->customer);
    //     }
    //     $transactions = $transactions->get();

    //     return view('sale.index', compact('transactions', 'customers','totalpaid','subtotal','total_amount','discount'));
    // }
    public function index(Request $request)
    {
        $customers = Customer::all();
        $transactions = Transaction::query();
        if ($request->start_date) {
            $transactions->where('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $transactions->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        if ($request->has('status') && $request->status !== '') {
            $transactions->where('status', $request->status);
        }

        if ($request->has('customer') && $request->customer !== '') {
            $transactions->where('customer_id', $request->customer);
        }

        $total_amount = $transactions->sum('total');
        $transactions = $transactions->get();
        $totalpaid = $transactions->sum('total_paid');
        $subtotal = $transactions->sum('subtotal');
        $discount = $transactions->sum('discount');

        return view('sale.index', compact('transactions', 'customers', 'totalpaid', 'subtotal', 'total_amount', 'discount'));
    }
}
