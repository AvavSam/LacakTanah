@extends('layouts.app')

@section('content')
  <div class="space-y-6">
    {{-- Judul --}}
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold text-gray-800">Tanah: Dokumen Hampir Kadaluwarsa</h1>
      <a href="{{ route('lands.index') }}" class="rounded-md bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">
        Kembali
      </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto rounded-lg bg-white shadow">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Kode Bidang</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Pemilik</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
              Tanggal Expiry
            </th>
            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
          @forelse ($lands as $land)
            <tr class="hover:bg-gray-50">
              <td class="whitespace-nowrap px-6 py-4 text-gray-700">{{ $land->kode_bidang ?? '-' }}</td>
              <td class="whitespace-nowrap px-6 py-4 text-gray-700">{{ $land->owner_name }}</td>
              <td class="whitespace-nowrap px-6 py-4 text-gray-700">{{ $land->dokumen_expiry->format('d M Y') }}</td>
              <td class="whitespace-nowrap px-6 py-4 text-center">
                <a
                  href="{{ route('lands.show', $land) }}"
                  class="rounded bg-indigo-500 px-3 py-1 text-xs font-medium text-white hover:bg-indigo-600"
                >
                  Detail
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                Tidak ada dokumen yang mendekati kadaluwarsa.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
      {{ $lands->withQueryString()->links() }}
    </div>
  </div>
@endsection
