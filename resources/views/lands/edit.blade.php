@extends('layouts.app')

@section('content')
  <div class="mx-auto max-w-3xl space-y-6">
    {{-- Judul --}}
    <h1 class="text-2xl font-semibold text-gray-800">Edit Data Tanah</h1>

    <form
      action="{{ route('lands.update', $land) }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-6 rounded-lg bg-white p-6 shadow"
    >
      @csrf
      @method('PUT')

      {{-- Owner Name --}}
      <div>
        <label for="owner_name" class="block text-sm font-medium text-gray-700">Nama Pemilik</label>
        <input
          type="text"
          name="owner_name"
          id="owner_name"
          value="{{ old('owner_name', $land->owner_name) }}"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          required
        />
        @error('owner_name')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Kode Bidang --}}
      <div>
        <label for="kode_bidang" class="block text-sm font-medium text-gray-700">
          Kode Bidang
          <span class="text-sm text-gray-500">(opsional)</span>
        </label>
        <input
          type="text"
          name="kode_bidang"
          id="kode_bidang"
          value="{{ old('kode_bidang', $land->kode_bidang) }}"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
        />
        @error('kode_bidang')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Alamat Lengkap --}}
      <div>
        <label for="alamat" class="block text-sm font-medium text-gray-700">
          Alamat Lengkap
          <span class="text-sm text-gray-500">(opsional)</span>
        </label>
        <textarea
          name="alamat"
          id="alamat"
          rows="2"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          placeholder="Desa, Kecamatan, Kabupaten..."
        >
{{ old('alamat', $land->alamat) }}</textarea
        >
        @error('alamat')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Kecamatan --}}
      <div>
        <label for="kecamatan" class="block text-sm font-medium text-gray-700">
          Kecamatan
          <span class="text-sm text-gray-500">(opsional)</span>
        </label>
        <input
          type="text"
          name="kecamatan"
          id="kecamatan"
          value="{{ old('kecamatan', $land->kecamatan) }}"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
        />
        @error('kecamatan')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Luas --}}
      <div>
        <label for="luas_m2" class="block text-sm font-medium text-gray-700">
          Luas (m²)
          <span class="text-sm text-gray-500">(opsional)</span>
        </label>
        <input
          type="number"
          name="luas_m2"
          id="luas_m2"
          value="{{ old('luas_m2', $land->luas_m2) }}"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          min="0"
        />
        @error('luas_m2')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Status --}}
      <div>
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select
          name="status"
          id="status"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          required
        >
          @foreach (['Milik', 'Sewa', 'Belum Sertifikat', 'Dalam Proses'] as $st)
            <option value="{{ $st }}" @if(old('status', $land->status) === $st) selected @endif>{{ $st }}</option>
          @endforeach
        </select>
        @error('status')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Koordinat (Latitude & Longitude) --}}
      <div>
        <label class="block text-sm font-medium text-gray-700">Koordinat (klik di peta)</label>
        <div id="map-edit" class="h-64 w-full rounded-md border border-gray-300"></div>
        <div class="mt-2 grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div>
            <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
            <input
              type="text"
              name="latitude"
              id="latitude"
              value="{{ old('latitude', $land->latitude) }}"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
              readonly
            />
            @error('latitude')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
            <input
              type="text"
              name="longitude"
              id="longitude"
              value="{{ old('longitude', $land->longitude) }}"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
              readonly
            />
            @error('longitude')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      {{-- Dokumen Sertifikat (opsional ubah) --}}
      <div>
        <label for="dokumen" class="block text-sm font-medium text-gray-700">
          Upload Dokumen Baru
          <span class="text-sm text-gray-500">(opsional)</span>
        </label>
        <input
          type="file"
          name="dokumen"
          id="dokumen"
          class="mt-1 block w-full rounded-md border-gray-300 text-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          accept=".pdf,.jpg,.jpeg,.png"
        />
        @error('dokumen')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @if ($land->dokumen_path)
          <p class="mt-1 text-sm text-gray-600">
            Dokumen saat ini:
            <a
              href="{{ asset('storage/' . $land->dokumen_path) }}"
              target="_blank"
              class="text-blue-600 hover:underline"
            >
              {{ basename($land->dokumen_path) }}
            </a>
          </p>
        @endif
      </div>

      {{-- Tanggal Expiry Dokumen --}}
      <div>
        <label for="dokumen_expiry" class="block text-sm font-medium text-gray-700">
          Tanggal Kadaluwarsa Dokumen
          <span class="text-sm text-gray-500">(opsional)</span>
        </label>
        <input
          type="date"
          name="dokumen_expiry"
          id="dokumen_expiry"
          value="{{ old('dokumen_expiry', $land->dokumen_expiry?->format('Y-m-d')) }}"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
        />
        @error('dokumen_expiry')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Foto Batas Lahan (opsional ubah) --}}
      <div>
        <label for="photo" class="block text-sm font-medium text-gray-700">
          Upload Foto Batas Lahan Baru
          <span class="text-sm text-gray-500">(opsional)</span>
        </label>
        <input
          type="file"
          name="photo"
          id="photo"
          class="mt-1 block w-full rounded-md border-gray-300 text-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          accept="image/*"
        />
        @error('photo')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @if ($land->photo_path)
          <p class="mt-1 text-sm text-gray-600">Foto saat ini:</p>
          <img
            src="{{ asset('storage/' . $land->photo_path) }}"
            alt="Foto Lahan"
            class="mt-1 w-full max-w-xs rounded-md shadow-sm"
          />
        @endif
      </div>

      {{-- Tombol Perbarui / Batal --}}
      <div class="flex justify-end space-x-2">
        <a href="{{ route('lands.index') }}" class="rounded-md bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">
          Batal
        </a>
        <button type="submit" class="rounded-md bg-green-600 px-4 py-2 text-white hover:bg-green-700">Perbarui</button>
      </div>
    </form>
  </div>
@endsection

@push('head')
  <!-- Leaflet CSS (CDN) -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
@endpush

@push('scripts')
  <!-- Leaflet JS (CDN) -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Koordinat awal (dari database / old)
      let initLat = {{ old('latitude', $land->latitude ?? '0') }};
      let initLng = {{ old('longitude', $land->longitude ?? '0') }};
      let zoomLevel = initLat && initLng ? 15 : 6;

      const map = L.map('map-edit').setView(
        initLat && initLng ? [initLat, initLng] : [-2.496456, 119.827186],
        zoomLevel
      );

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
      }).addTo(map);

      let marker;
      if (initLat && initLng) {
        marker = L.marker([initLat, initLng]).addTo(map);
      }

      map.on('click', function (e) {
        const { lat, lng } = e.latlng;
        if (marker) map.removeLayer(marker);
        marker = L.marker([lat, lng]).addTo(map);
        document.getElementById('latitude').value = lat.toFixed(7);
        document.getElementById('longitude').value = lng.toFixed(7);
      });
    });
  </script>
@endpush
