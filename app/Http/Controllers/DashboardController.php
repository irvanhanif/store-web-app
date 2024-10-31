<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                                    ->whereHas('product', function($product) {
                                        $product->where('users_id', Auth::user()->id);
                                    });
        $revenue = $transactions->get()->reduce(function ($carry, $item) {
            return $carry + $item->price;
        });

        $customer = DB::table('transaction_details')
                        ->selectRaw('DISTINCT transactions.users_id')
                        ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
                        ->get();

        return view('pages.dashboard', [
            'transactions_count' => $transactions->count(),
            'transactions_data' => $transactions->get(),
            'revenue' => $revenue,
            'customer' => $customer->count()
        ]);
    }
}
