<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Enums\CourtStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourtRequest extends FormRequest
{
   public function authorize(): bool
{
    return $this->user()?->isAdmin() ?? false;
}

    public function rules(): array
    {
        return [
            'sport_id' => ['sometimes', 'required', 'uuid', 'exists:sports,id'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'court_number' => ['nullable', 'string', 'max:50'],
            'price_per_hour' => ['sometimes', 'required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['nullable', Rule::enum(CourtStatus::class)],
            'width' => ['nullable', 'numeric', 'min:0'],
            'length' => ['nullable', 'numeric', 'min:0'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'facility_ids' => ['nullable', 'array'],
            'facility_ids.*' => ['uuid', 'exists:facilities,id'],
             'images' => ['nullable', 'array'],
        'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'sport_id.required' => 'Jenis olahraga wajib dipilih.',
            'sport_id.exists' => 'Jenis olahraga tidak valid.',
            'name.required' => 'Nama lapangan wajib diisi.',
            'name.max' => 'Nama lapangan maksimal 255 karakter.',
            'price_per_hour.required' => 'Harga per jam wajib diisi.',
            'price_per_hour.numeric' => 'Harga per jam harus berupa angka.',
            'price_per_hour.min' => 'Harga per jam minimal 0.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
        ];
    }
}
