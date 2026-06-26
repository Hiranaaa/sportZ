<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Booking;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class InvoiceService
{
    public function generateInvoice(Booking $booking): Invoice
    {
        $booking->load(['user', 'court.sport', 'payment']);

        $existingInvoice = Invoice::where('booking_id', $booking->id)->first();

        if ($existingInvoice) {
            return $existingInvoice;
        }

        /** @var Invoice */
        return Invoice::create([
            'booking_id' => $booking->id,
            'invoice_number' => $this->generateInvoiceNumber(),
            'user_id' => $booking->user_id,
            'amount' => $booking->total_price,
            'discount_amount' => $booking->discount_amount ?? 0,
            'tax_amount' => 0,
            'total_amount' => $booking->total_price,
            'issued_at' => now(),
            'due_at' => now()->addDays(1),
        ]);
    }

    public function generatePdf(Invoice $invoice): string
    {
        $invoice->load(['booking.user', 'booking.court.sport', 'booking.payment']);

        $pdf = Pdf::loadView('invoices.template', [
            'invoice' => $invoice,
        ]);

        $filename = "invoices/{$invoice->invoice_number}.pdf";
        $storagePath = storage_path("app/public/{$filename}");

        $directory = dirname($storagePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $pdf->save($storagePath);

        $invoice->update(['pdf_path' => $filename]);

        return $storagePath;
    }

    public function generateInvoiceNumber(): string
    {
        $prefix = config('sportz.invoice_prefix', 'INV');
        $year = now()->format('Y');
        $month = now()->format('m');
        $random = str_pad((string) random_int(1, 99999), 5, '0', STR_PAD_LEFT);

        return "{$prefix}/{$year}/{$month}/{$random}";
    }
}
