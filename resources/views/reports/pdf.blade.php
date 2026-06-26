<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Booking SportZ</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
            color:#333;
        }

        h1{
            text-align:center;
            margin-bottom:5px;
        }

        .subtitle{
            text-align:center;
            margin-bottom:25px;
            color:#666;
        }

        .summary{
            margin-bottom:20px;
        }

        .summary table{
            width:100%;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#2563eb;
            color:white;
            border:1px solid #ccc;
            padding:8px;
            font-size:11px;
        }

        td{
            border:1px solid #ccc;
            padding:8px;
            font-size:11px;
        }

        .right{
            text-align:right;
        }

        .center{
            text-align:center;
        }

        .footer{
            margin-top:30px;
            text-align:center;
            font-size:11px;
            color:#777;
        }
    </style>

</head>

<body>

<h1>Laporan Booking SportZ</h1>

<div class="subtitle">
    Periode
    <strong>{{ $period['start'] }}</strong>
    s/d
    <strong>{{ $period['end'] }}</strong>
</div>

<div class="summary">

<table>

<tr>
    <td>Total Booking</td>
    <td>{{ $total_bookings }}</td>
</tr>

<tr>
    <td>Pending</td>
    <td>{{ $by_status['pending'] }}</td>
</tr>

<tr>
    <td>Confirmed</td>
    <td>{{ $by_status['confirmed'] }}</td>
</tr>

<tr>
    <td>Completed</td>
    <td>{{ $by_status['completed'] }}</td>
</tr>

<tr>
    <td>Cancelled</td>
    <td>{{ $by_status['cancelled'] }}</td>
</tr>

<tr>
    <td>No Show</td>
    <td>{{ $by_status['no_show'] }}</td>
</tr>

</table>

</div>

<table>

<thead>

<tr>

<th>No</th>
<th>Kode Booking</th>
<th>Pelanggan</th>
<th>Lapangan</th>
<th>Olahraga</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Total</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@forelse($bookings as $booking)

<tr>

<td class="center">
{{ $loop->iteration }}
</td>

<td>
{{ $booking->booking_code ?? '-' }}
</td>

<td>
{{ $booking->user->name ?? '-' }}
</td>

<td>
{{ $booking->court->name ?? '-' }}
</td>

<td>
{{ $booking->court->sport->name ?? '-' }}
</td>

<td>
{{ $booking->booking_date }}
</td>

<td>
{{ substr($booking->start_time,0,5) }}
-
{{ substr($booking->end_time,0,5) }}
</td>

<td class="right">
Rp {{ number_format($booking->total_price ?? 0,0,',','.') }}
</td>

<td class="center">
{{ ucfirst($booking->status) }}
</td>

</tr>

@empty

<tr>

<td colspan="9" class="center">

Tidak ada data booking

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="footer">

Dicetak pada {{ now()->format('d-m-Y H:i') }}

<br>

SportZ © {{ now()->year }}

</div>

</body>

</html>