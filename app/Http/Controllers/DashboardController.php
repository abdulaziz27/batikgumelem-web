<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
     return view('dashboard');
    }

    public function transactionIndex()
    {
        $transactions = auth()->user()->transactions()->latest()->paginate(10);
        return view('pages.dashboard.transaction.index', compact('transactions'));
    }

    public function transactionShow($id)
    {
        $transaction = Transaction::with('transactionItems.product')->findOrFail($id);
        // $this->authorize('view', $transaction);
        return view('pages.dashboard.transaction.show', compact('transaction'));
    }

    public function trackingIndex(Request $request)
    {
        $recentTransactions = auth()->user()->transactions()->latest()->take(5)->get();

        if ($request->has('transaction_id')) {
            return redirect()->route('dashboard.tracking.show', $request->transaction_id);
        }

        return view('pages.dashboard.tracking.index', compact('recentTransactions'));
    }

    public function trackingShow($id)
    {
        $transaction = Transaction::with('transactionItems.product')->findOrFail($id);
        // $this->authorize('view', $transaction);
        return view('pages.dashboard.tracking.show', compact('transaction'));
    }
}
