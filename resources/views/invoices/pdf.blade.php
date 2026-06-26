<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Invoice {{ $invoice->invoice_number }}</title>
<style>body{font-family:'Helvetica',sans-serif;font-size:14px;color:#1f2937;margin:0;padding:40px}
.header{display:flex;justify-content:space-between;margin-bottom:40px;border-bottom:3px solid #06b6d4;padding-bottom:20px}
.logo{font-size:28px;font-weight:900;background:linear-gradient(135deg,#06b6d4,#3b82f6);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
.invoice-title{font-size:24px;font-weight:700;color:#374151}
.invoice-num{color:#6b7280;font-family:monospace;font-size:13px}
.info-box{background:#f9fafb;border-radius:12px;padding:16px;margin-bottom:24px}
.info-label{color:#9ca3af;font-size:12px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px}
table{width:100%;border-collapse:collapse;margin-bottom:24px}
th{background:#f3f4f6;text-align:left;padding:12px 16px;font-size:12px;text-transform:uppercase;color:#6b7280;border-bottom:2px solid #e5e7eb}
td{padding:12px 16px;border-bottom:1px solid #f3f4f6}
.total-row{font-weight:700;font-size:18px;color:#06b6d4}
.footer{text-align:center;margin-top:40px;padding-top:20px;border-top:1px solid #e5e7eb;color:#9ca3af;font-size:12px}</style>
</head><body>
<div class="header"><div><div class="logo">SportZ</div><div style="color:#6b7280;font-size:12px;margin-top:4px">Book Your Game, Anytime</div><div style="color:#6b7280;font-size:12px">Jl. Olahraga No. 123, Jakarta Selatan</div></div><div style="text-align:right"><div class="invoice-title">INVOICE</div><div class="invoice-num">{{ $invoice->invoice_number }}</div><div style="color:#6b7280;margin-top:8px">{{ $invoice->issued_at ? $invoice->issued_at->format('d F Y') : now()->format('d F Y') }}</div></div></div>
<div class="info-box"><div class="info-label">Diterbitkan untuk</div><div style="font-weight:600;font-size:16px">{{ $invoice->booking->user->name ?? '-' }}</div><div style="color:#6b7280">{{ $invoice->booking->user->email ?? '-' }}</div><div style="color:#6b7280">{{ $invoice->booking->user->phone ?? '-' }}</div></div>
<table><thead><tr><th>Deskripsi</th><th>Tanggal</th><th>Durasi</th><th style="text-align:right">Harga</th></tr></thead>
<tbody><tr><td><strong>{{ $invoice->booking->court->name ?? '-' }}</strong><br><span style="color:#6b7280;font-size:12px">{{ $invoice->booking->court->sport->name ?? '' }} • No. {{ $invoice->booking->court->court_number ?? '' }}</span></td><td>{{ \Carbon\Carbon::parse($invoice->booking->booking_date)->format('d M Y') }}<br><span style="color:#6b7280;font-size:12px">{{ substr($invoice->booking->start_time, 0, 5) }} - {{ substr($invoice->booking->end_time, 0, 5) }}</span></td><td>{{ $invoice->booking->duration_hours }} jam</td><td style="text-align:right">Rp {{ number_format($invoice->booking->subtotal, 0, ',', '.') }}</td></tr></tbody></table>
<div style="display:flex;justify-content:flex-end"><div style="width:280px"><div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6"><span style="color:#6b7280">Subtotal</span><span>Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span></div>@if(($invoice->booking->discount ?? 0) > 0)<div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6;color:#10b981"><span>Diskon</span><span>- Rp {{ number_format($invoice->booking->discount, 0, ',', '.') }}</span></div>@endif<div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6"><span style="color:#6b7280">Pajak</span><span>Rp {{ number_format($invoice->tax ?? 0, 0, ',', '.') }}</span></div><div style="display:flex;justify-content:space-between;padding:12px 0" class="total-row"><span>Total</span><span>Rp {{ number_format($invoice->total, 0, ',', '.') }}</span></div></div></div>
<div style="background:#ecfdf5;border-radius:8px;padding:12px 16px;text-align:center;margin-top:24px;color:#059669;font-weight:600">✅ LUNAS</div>
<div class="footer"><p>Terima kasih telah bermain di SportZ! 🏆</p><p>info@sportz.id | +62 812 3456 7890</p></div>
</body></html>
