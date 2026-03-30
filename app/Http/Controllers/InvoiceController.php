<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Download invoice PDF for a payment.
     * Accessible by the member who owns the payment, and admin/superuser.
     */
    public function download($id)
    {
        $payment = Payment::with(['user', 'order.alat.category'])->findOrFail($id);

        // Access control: owner member OR admin/superuser (role >= 1)
        if (Auth::user()->role === 0 && $payment->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        // Only allow download when payment is confirmed (status 3 or 4)
        if ($payment->status < 3) {
            return back()->with('error', 'Invoice hanya tersedia setelah pembayaran dikonfirmasi.');
        }

        $detail = Order::where('payment_id', $id)->where('status', 2)->get();

        $pdf = Pdf::loadView('invoices.invoice', [
            'payment' => $payment,
            'detail'  => $detail,
            'total'   => $payment->total,
        ]);

        $pdf->setPaper('A4', 'portrait');

        $filename = 'Invoice-' . str_replace('/', '_', $payment->no_invoice) . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Preview invoice in browser (for admin/member).
     */
    public function preview($id)
    {
        $payment = Payment::with(['user', 'order.alat.category'])->findOrFail($id);

        if (Auth::user()->role === 0 && $payment->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        if ($payment->status < 3) {
            return back()->with('error', 'Invoice hanya tersedia setelah pembayaran dikonfirmasi.');
        }

        $detail = Order::where('payment_id', $id)->where('status', 2)->get();

        $pdf = Pdf::loadView('invoices.invoice', [
            'payment' => $payment,
            'detail'  => $detail,
            'total'   => $payment->total,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Invoice-' . str_replace('/', '_', $payment->no_invoice) . '.pdf');
    }
}
