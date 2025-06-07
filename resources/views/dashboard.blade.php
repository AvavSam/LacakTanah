@extends('layouts.app')

@section('content')
  {{-- Container Utama --}}
  <div class="space-y-6">
    {{-- Judul Halaman --}}
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
    </div>

    {{-- Ringkasan Statistika --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
      {{-- Kartu Total Tanah --}}
      <div class="flex flex-col justify-between rounded-2xl bg-white p-6 shadow transition hover:shadow-lg">
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-sm font-medium text-gray-500">Total Tanah</h2>
            <p class="mt-1 text-3xl font-bold text-gray-800">{{ $totalLands }}</p>
          </div>
          <div class="rounded-full bg-blue-100 p-3">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="lucide lucide-map-pin-icon lucide-map-pin text-blue-600"
            >
              <path
                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"
              />
              <circle cx="12" cy="10" r="3" />
            </svg>
          </div>
        </div>
      </div>

      {{-- Kartu Dokumen Hampir Kadaluwarsa --}}
      <div
        @if($expiringCount > 0) class="bg-white rounded-2xl shadow p-6 flex flex-col justify-between border-l-4 border-red-500 hover:shadow-lg transition" @else class="bg-white rounded-2xl shadow p-6 flex flex-col justify-between hover:shadow-lg transition" @endif
      >
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-sm font-medium text-gray-500">Dokumen Hampir Kadaluwarsa</h2>
            <p class="mt-1 text-3xl font-bold text-gray-800">
              {{ $expiringCount }}
              @if ($expiringCount > 0)
                <span class="text-sm text-red-600">(≤ 30 hari)</span>
              @endif
            </p>
          </div>
          <div class="rounded-full bg-red-100 p-3">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="lucide lucide-clock-alert-icon lucide-clock-alert text-red-600"
            >
              <path d="M12 6v6l4 2" />
              <path d="M16 21.16a10 10 0 1 1 5-13.516" />
              <path d="M20 11.5v6" />
              <path d="M20 21.5h.01" />
            </svg>
          </div>
        </div>
        @if ($expiringCount > 0)
          <div class="mt-4">
            <a
              href="{{ route('lands.expiring') }}"
              class="inline-block text-sm font-medium text-red-600 hover:underline"
            >
              Lihat Daftar
            </a>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
