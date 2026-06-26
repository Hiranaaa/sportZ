@extends('layouts.admin')
@section('title', 'Tambah Lapangan - SportZ')
@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.courts.index') }}" class="p-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">{{ isset($court) ? 'Edit Lapangan' : 'Tambah Lapangan' }}</h1>
    </div>

    <form action="{{ isset($court) ? route('admin.courts.update', $court->id) : route('admin.courts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($court)) @method('PUT') @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Form --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 space-y-5">
                    <h3 class="font-heading font-bold text-gray-900 dark:text-white">Informasi Lapangan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Lapangan *</label>
                            <input type="text" name="name" value="{{ old('name', $court->name ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all">
                            @error('name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Olahraga *</label>
                            <select name="sport_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500">
                                <option value="">Pilih Olahraga</option>
                                @foreach($sports as $sport)<option value="{{ $sport->id }}" {{ old('sport_id', $court->sport_id ?? '') == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>@endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">No. Lapangan *</label>
                            <input type="text" name="court_number" value="{{ old('court_number', $court->court_number ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all" placeholder="FTS-A">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Harga/Jam (Rp) *</label>
                            <input type="number" name="price_per_hour" value="{{ old('price_per_hour', $court->price_per_hour ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                            <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500">
                                <option value="active" {{ old('status', $court->status ?? '') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="maintenance" {{ old('status', $court->status ?? '') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="inactive" {{ old('status', $court->status ?? '') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kapasitas</label>
                            <input type="number" name="capacity" value="{{ old('capacity', $court->capacity ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Lebar (m)</label><input type="number" step="0.01" name="width" value="{{ old('width', $court->width ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all"></div>
                        <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Panjang (m)</label><input type="number" step="0.01" name="length" value="{{ old('length', $court->length ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all resize-none">{{ old('description', $court->description ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                    <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Upload Foto</h3>
                    <div class="border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-xl p-6 text-center hover:border-cyan-500/50 transition-colors cursor-pointer" onclick="document.getElementById('images').click()">
                        <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-sm text-gray-500">Klik atau drag foto ke sini</p>
                        <p class="text-xs text-gray-400 mt-1">Max 2MB per gambar</p>
                    </div>
<input
    type="file"
    id="images"
    name="images[]"
    multiple
    accept="image/*"
    class="hidden"
    onchange="previewImages(event)">
<div id="preview" class="grid grid-cols-2 gap-2 mt-4"></div>                </div>

                <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                    <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Fasilitas</h3>
                    <div class="space-y-3">
                        @foreach($facilities as $facility)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="facility_ids[]" value="{{ $facility->id }}" {{ in_array($facility->id, old('facility_ids', isset($court) ? $court->facilities->pluck('id')->toArray() : [])) ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-cyan-500 focus:ring-cyan-500">
                            <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-cyan-500 transition-colors">{{ $facility->icon }} {{ $facility->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-cyan-500/25 transition-all duration-300">{{ isset($court) ? 'Simpan Perubahan' : 'Tambah Lapangan' }}</button>
            </div>
        </div>
    </form>
</div>
<script>
function previewImages(event) {

    const preview = document.getElementById('preview');

    preview.innerHTML = '';

    Array.from(event.target.files).forEach(file => {

        const reader = new FileReader();

        reader.onload = function(e){

            preview.innerHTML += `
                <div class="rounded-xl overflow-hidden border">
                    <img src="${e.target.result}"
                         class="w-full h-32 object-cover">
                </div>
            `;

        }

        reader.readAsDataURL(file);

    });

}
</script>
@endsection
