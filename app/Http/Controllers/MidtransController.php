<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . config('services.midtrans.server_key'));

        if ($notification->signature_key != $validSignatureKey) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Find transaction by the Midtrans order ID
        $transaction = Transaction::where('midtrans_order_id', $notification->order_id)->firstOrFail();
        $transaction->status = $this->mapPaymentStatus($notification->transaction_status);
        $transaction->save();

        return response()->json(['message' => 'Notification handled']);
    }

    private function mapPaymentStatus($midtransStatus)
    {
        $statusMap = [
            'capture' => 'PAID',
            'settlement' => 'PAID',
            'pending' => 'PENDING',
            'deny' => 'CANCELLED',
            'expire' => 'CANCELLED',
            'cancel' => 'CANCELLED',
        ];

        return $statusMap[$midtransStatus] ?? 'PENDING';
    }
}
