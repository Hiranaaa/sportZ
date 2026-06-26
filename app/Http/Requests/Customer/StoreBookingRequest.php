<?php

declare(strict_types=1);

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $maxHours = config('sportz.max_booking_hours', 4);

        return [
            'court_id' => ['required', 'uuid', 'exists:courts,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'duration_hours' => ['required', 'integer', 'min:1', "max:{$maxHours}"],
            'notes' => ['nullable', 'string', 'max:500'],
            'voucher_code' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        $maxHours = config('sportz.max_booking_hours', 4);

        return [
            'court_id.required' => 'Lapangan wajib dipilih.',
            'court_id.exists' => 'Lapangan tidak ditemukan.',
            'booking_date.required' => 'Tanggal booking wajib diisi.',
            'booking_date.after_or_equal' => 'Tanggal booking harus hari ini atau setelahnya.',
            'start_time.required' => 'Jam mulai wajib diisi.',
            'start_time.date_format' => 'Format jam mulai tidak valid (HH:mm).',
            'end_time.required' => 'Jam selesai wajib diisi.',
            'end_time.after' => 'Jam selesai harus setelah jam mulai.',
            'duration_hours.required' => 'Durasi wajib diisi.',
            'duration_hours.min' => 'Durasi minimal 1 jam.',
            'duration_hours.max' => "Durasi maksimal {$maxHours} jam.",
            'notes.max' => 'Catatan maksimal 500 karakter.',
        ];
    }
}
