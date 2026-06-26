<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    ) {}

    public function index(Request $request): View
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $bookingReport = $this->reportService->getBookingReport($startDate, $endDate);
        $revenueReport = $this->reportService->getRevenueReport($startDate, $endDate);
        $courtUtilization = $this->reportService->getCourtUtilization();

        return view('admin.reports.index', compact('bookingReport', 'revenueReport', 'courtUtilization', 'startDate', 'endDate'));
    }

    public function exportPdf(Request $request)
{
    $startDate = $request->input(
        'start_date',
        now()->startOfMonth()->toDateString()
    );

    $endDate = $request->input(
        'end_date',
        now()->toDateString()
    );

    $data = $this->reportService->getBookingReport(
        $startDate,
        $endDate
    );

    return $this->reportService
        ->exportToPdf($data, 'reports.pdf')
        ->download(
            'Laporan-Booking-' . now()->format('Y-m-d-His') . '.pdf'
        );
}

    public function exportExcel(Request $request)
{
    $startDate = $request->input(
        'start_date',
        now()->startOfMonth()->toDateString()
    );

    $endDate = $request->input(
        'end_date',
        now()->toDateString()
    );

    $data = $this->reportService->getBookingReport(
        $startDate,
        $endDate
    );

    return Excel::download(
        $this->reportService->exportToExcel($data),
        'booking-report-' . now()->format('Y-m-d-His') . '.xlsx'
    );
}
}
