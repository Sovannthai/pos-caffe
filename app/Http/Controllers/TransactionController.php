<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Transactionsaleline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::all();
        $transactions = Transaction::query();
        $transactionss = Transaction::count();
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
        $total_due = $transactions->sum('total_due');
        $total_amount = $transactions->sum('total');
        $transactions = $transactions->get();
        $totalpaid = $transactions->sum('total_paid');
        $subtotal = $transactions->sum('subtotal');
        $discount = $transactions->sum('discount');
        return view('sale.index', compact('transactions', 'customers', 'totalpaid', 'subtotal', 'total_amount', 'discount', 'transactionss','total_due'));
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Transactionsaleline::where('transaction_id', $id)->delete();
            Transaction::find($id)->delete();

            DB::commit();
            return redirect()->route('transaction.index')->with('success', 'Transaction deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('transaction.index')->with('error', 'Failed to delete transaction!');
        }
    }
}
