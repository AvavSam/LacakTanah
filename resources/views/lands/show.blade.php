@extends('layouts.app')

@section('content')
  <div class="mx-auto max-w-3xl space-y-6">
    {{-- Judul dan Tombol Aksi --}}
    <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
      <h1 class="text-2xl font-semibold text-gray-800">Detail Tanah</h1>
      <div class="inline-flex space-x-2">
        <a
          href="{{ route('lands.edit', $land) }}"
          class="rounded-md bg-yellow-500 px-4 py-2 text-sm font-medium text-white hover:bg-yellow-600"
        >
          Edit
        </a>
        <a
          href="{{ route('lands.index') }}"
          class="rounded-md bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300"
        >
          Kembali
        </a>
      </div>
    </div>

    {{-- Data Detail --}}
    <div class="space-y-6 rounded-lg bg-white p-6 shadow">
      {{-- Info Utama --}}
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div>
          <p class="text-sm font-medium text-gray-500">Nama Pemilik</p>
          <p class="mt-1 text-gray-700">{{ $land->owner_name }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">Kode Bidang</p>
          <p class="mt-1 text-gray-700">{{ $land->kode_bidang ?? '-' }}</p>
        </div>

        <div>
          <p class="text-sm font-medium text-gray-500">Alamat</p>
          <p class="mt-1 text-gray-700">{{ $land->alamat ?? '-' }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">Kecamatan / Kabupaten</p>
          <p class="mt-1 text-gray-700">{{ $land->kecamatan ?? '-' }} / {{ $land->kabupaten ?? '-' }}</p>
        </div>

        <div>
          <p class="text-sm font-medium text-gray-500">Luas (m²)</p>
          <p class="mt-1 text-gray-700">{{ $land->luas_m2 ?? '-' }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">Status</p>
          <p class="mt-1 text-gray-700">{{ $land->status }}</p>
        </div>
      </div>

      {{-- Tanggal Expiry Dokumen, jika ada --}}
      @if ($land->dokumen_expiry)
        <div>
          <p class="text-sm font-medium text-gray-500">Tanggal Kadaluwarsa Dokumen</p>
          <p class="mt-1 text-gray-700">{{ $land->dokumen_expiry->format('d M Y') }}</p>
        </div>
      @endif

      {{-- Dokumen (jika ada) --}}
      @if ($land->dokumen_path)
        <div>
          <p class="text-sm font-medium text-gray-500">Dokumen Sertifikat</p>
          <a
            href="{{ route('serve.file', $land->dokumen_path) }}"
            target="_blank"
            class="mt-1 inline-block text-blue-600 hover:underline"
          >
            Lihat Dokumen
          </a>
        </div>
      @endif

      {{-- Foto Batas Lahan --}}
      @if ($land->photo_path)
        <div>
          <p class="text-sm font-medium text-gray-500">Foto Batas Lahan</p>
          <img
            src="{{ route('serve.file', $land->photo_path) }}"
            alt="Foto Lahan"
            class="mt-1 w-full rounded-md shadow-sm"
          />
        </div>
      @endif

      {{-- Peta Lokasi --}}
      @if ($land->latitude && $land->longitude)
        <div>
          <p class="text-sm font-medium text-gray-500">Lokasi di Peta</p>
          <div id="map-show" class="mt-2 h-64 w-full rounded-md border border-gray-300"></div>
        </div>
      @else
        <div class="text-sm text-gray-500">Koordinat belum diatur.</div>
      @endif
    </div>
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
        @if($land->latitude && $land->longitude)
            const lat = {{ $land->latitude }};
            const lng = {{ $land->longitude }};
            const map = L.map('map-show').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([lat, lng]).addTo(map);
        @endif
    });
  </script>
@endpush
