<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        $transaction = Transaction::with('transactionItems.product')->findOrFail($id);

        $pdf = PDF::loadView('reports.invoice', compact('transaction'));

        return $pdf->download('invoice-' . $transaction->id . '.pdf');
    }
}
