@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    {{-- Judul --}}
    <h1 class="text-2xl font-semibold text-gray-800">Tambah Tanah Baru</h1>

    <form action="{{ route('lands.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6 space-y-6">
        @csrf

        {{-- Owner Name --}}
        <div>
            <label for="owner_name" class="block text-sm font-medium text-gray-700">Nama Pemilik</label>
            <input type="text" name="owner_name" id="owner_name" value="{{ old('owner_name') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('owner_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kode Bidang --}}
        <div>
            <label for="kode_bidang" class="block text-sm font-medium text-gray-700">Kode Bidang <span class="text-sm text-gray-500">(opsional)</span></label>
            <input type="text" name="kode_bidang" id="kode_bidang" value="{{ old('kode_bidang') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('kode_bidang')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Alamat Lengkap --}}
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap <span class="text-sm text-gray-500">(opsional)</span></label>
            <textarea name="alamat" id="alamat" rows="2"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Desa, Kecamatan, Kabupaten...">{{ old('alamat') }}</textarea>
            @error('alamat')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kecamatan --}}
        <div>
            <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan <span class="text-sm text-gray-500">(opsional)</span></label>
            <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('kecamatan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Luas --}}
        <div>
            <label for="luas_m2" class="block text-sm font-medium text-gray-700">Luas (m²) <span class="text-sm text-gray-500">(opsional)</span></label>
            <input type="number" name="luas_m2" id="luas_m2" value="{{ old('luas_m2') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   min="0">
            @error('luas_m2')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @foreach(['Milik','Sewa','Belum Sertifikat','Dalam Proses'] as $st)
                    <option value="{{ $st }}" @if(old('status') === $st) selected @endif>{{ $st }}</option>
                @endforeach
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Koordinat (Latitude & Longitude) --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Koordinat (klik di peta)</label>
            <div id="map-create" class="h-64 w-full rounded-md border border-gray-300"></div>
            <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           readonly>
                    @error('latitude')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           readonly>
                    @error('longitude')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Dokumen Sertifikat --}}
        <div>
            <label for="dokumen" class="block text-sm font-medium text-gray-700">Upload Dokumen (PDF/JPG)</label>
            <input type="file" name="dokumen" id="dokumen"
                   class="mt-1 block w-full text-gray-700 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   accept=".pdf,.jpg,.jpeg,.png">
            @error('dokumen')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal Expiry Dokumen --}}
        <div>
            <label for="dokumen_expiry" class="block text-sm font-medium text-gray-700">Tanggal Kadaluwarsa Dokumen <span class="text-sm text-gray-500">(opsional)</span></label>
            <input type="date" name="dokumen_expiry" id="dokumen_expiry" value="{{ old('dokumen_expiry') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('dokumen_expiry')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Foto Batas Lahan --}}
        <div>
            <label for="photo" class="block text-sm font-medium text-gray-700">Upload Foto Batas Lahan (opsional)</label>
            <input type="file" name="photo" id="photo"
                   class="mt-1 block w-full text-gray-700 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   accept="image/*">
            @error('photo')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Simpan / Batal --}}
        <div class="flex justify-end space-x-2">
            <a href="{{ route('lands.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">Simpan</button>
        </div>
    </form>
</div>
@endsection

@push('head')
    <!-- Leaflet CSS (CDN) -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      crossorigin=""
    />
@endpush

@push('scripts')
    <!-- Leaflet JS (CDN) -->
    <script
      src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
      crossorigin=""
    ></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi peta di koordinat default (bisa diubah sesuai kebutuhan)
        let defaultLat = {{ old('latitude', '-2.496456') }}; // contohnya Sulawesi Tengah
        let defaultLng = {{ old('longitude', '119.827186') }};
        let defaultZoom = 6;

        const map = L.map('map-create').setView([defaultLat, defaultLng], defaultZoom);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker;
        // Jika ada value lama (edit balik), letakkan marker
        if (defaultLat && defaultLng && defaultLat !== '0' && defaultLng !== '0') {
            marker = L.marker([defaultLat, defaultLng]).addTo(map);
        }

        // Event klik pada peta: letakkan marker baru dan isi input latitude/longitude
        map.on('click', function (e) {
            const { lat, lng } = e.latlng;
            // Hilangkan marker lama (jika ada)
            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng]).addTo(map);
            // Isi form
            document.getElementById('latitude').value = lat.toFixed(7);
            document.getElementById('longitude').value = lng.toFixed(7);
        });
    });
    </script>
@endpush
