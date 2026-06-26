<?php
declare(strict_types=1);
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Booking;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class InvoiceController extends Controller
{
    public function __construct(protected InvoiceService $invoiceService) {}

    public function show(string $id): View
    {
        $invoice = Invoice::whereHas('booking', fn ($q) => $q->where('user_id', Auth::id()))->with('booking.user', 'booking.court.sport')->findOrFail($id);
        return view('customer.invoices.show', compact('invoice'));
    }

    public function download(string $id): BinaryFileResponse
    {
        $invoice = Invoice::whereHas('booking', fn ($q) => $q->where('user_id', Auth::id()))->findOrFail($id);
        $path = $this->invoiceService->generatePdf($invoice);
        return response()->download(storage_path('app/' . $path), 'Invoice-' . $invoice->invoice_number . '.pdf');
    }
}
