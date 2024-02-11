<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::count();
        $transactions = Transaction::count();
        $transaction = Transaction::all();
        $total_income = $transaction->sum('total');
        $customers = Customer::count();
        $total_paid = $transaction->sum('total_paid');
        $total_amount_today = $transaction->sum('total');
        $total_due = 0;
        foreach ($transaction as $trans) {
            $total_due += $trans->total - $trans->total_paid;
        }
        return view('home', compact('product', 'transactions', 'total_income', 'total_amount_today', 'customers', 'total_paid','total_due'));
    }
}
