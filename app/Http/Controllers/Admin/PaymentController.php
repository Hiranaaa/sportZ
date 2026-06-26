<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Payment::with(['booking.user', 'booking.court']);
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $payments = $query->latest()->paginate(15);
        return view('admin.payments.index', compact('payments'));
    }

    public function show(string $id): View
    {
        $payment = Payment::with(['booking.user', 'booking.court', 'logs'])->findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }
}
