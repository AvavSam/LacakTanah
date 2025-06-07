@extends('layouts.app')

@section('content')
  <div class="space-y-6">
    {{-- Header + Pencarian/Filter --}}
    <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
      <h1 class="text-2xl font-semibold text-gray-800">Daftar Tanah</h1>
      <a
        href="{{ route('lands.create') }}"
        class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-blue-700"
      >
        + Tambah Tanah
      </a>
    </div>

    <form
      method="GET"
      action="{{ route('lands.index') }}"
      class="grid grid-cols-1 gap-4 rounded-lg bg-white p-4 shadow md:grid-cols-3"
    >
      {{-- Pencarian Kata Kunci --}}
      <div>
        <label for="search" class="block text-sm font-medium text-gray-700">Cari (kode/desa/pemilik)</label>
        <input
          type="text"
          name="search"
          id="search"
          value="{{ request('search') }}"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          placeholder="Masukkan kata kunci..."
        />
      </div>

      {{-- Filter Kecamatan --}}
      <div>
        <label for="kecamatan" class="block text-sm font-medium text-gray-700">Filter Kecamatan</label>
        <input
          type="text"
          name="kecamatan"
          id="kecamatan"
          value="{{ request('kecamatan') }}"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          placeholder="Misal: Palu"
        />
      </div>

      {{-- Filter Status --}}
      <div>
        <label for="status" class="block text-sm font-medium text-gray-700">Filter Status</label>
        <select
          name="status"
          id="status"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
        >
          <option value="">— Semua Status —</option>
          @foreach (['Milik', 'Sewa', 'Belum Sertifikat', 'Dalam Proses'] as $st)
            <option value="{{ $st }}" @if(request('status') === $st) selected @endif>{{ $st }}</option>
          @endforeach
        </select>
      </div>

      {{-- Tombol Submit --}}
      <div class="flex justify-end md:col-span-3">
        <button type="submit" class="rounded-md bg-green-600 px-4 py-2 text-white hover:bg-green-700">Terapkan</button>
      </div>
    </form>

    {{-- Tabel Daftar Tanah --}}
    <div class="overflow-x-auto rounded-lg bg-white shadow">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Kode Bidang</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Pemilik</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Kecamatan</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Luas (m²)</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
          @forelse ($lands as $land)
            <tr class="hover:bg-gray-50">
              <td class="whitespace-nowrap px-6 py-4 text-gray-700">{{ $land->kode_bidang ?? '-' }}</td>
              <td class="whitespace-nowrap px-6 py-4 text-gray-700">{{ $land->owner_name }}</td>
              <td class="whitespace-nowrap px-6 py-4 text-gray-700">{{ $land->kecamatan ?? '-' }}</td>
              <td class="whitespace-nowrap px-6 py-4 text-gray-700">{{ $land->luas_m2 ?? '-' }}</td>
              <td class="whitespace-nowrap px-6 py-4 text-gray-700">{{ $land->status }}</td>
              <td class="whitespace-nowrap px-6 py-4 text-center">
                <div class="inline-flex space-x-2">
                  <a
                    href="{{ route('lands.show', $land) }}"
                    class="rounded bg-indigo-500 px-3 py-1 text-xs font-medium text-white hover:bg-indigo-600"
                  >
                    Detail
                  </a>
                  <a
                    href="{{ route('lands.edit', $land) }}"
                    class="rounded bg-yellow-500 px-3 py-1 text-xs font-medium text-white hover:bg-yellow-600"
                  >
                    Edit
                  </a>
                  <form
                    action="{{ route('lands.destroy', $land) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus data ini?');"
                  >
                    @csrf
                    @method('DELETE')
                    <button
                      type="submit"
                      class="rounded bg-red-600 px-3 py-1 text-xs font-medium text-white hover:bg-red-700"
                    >
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data tanah.</td>
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
