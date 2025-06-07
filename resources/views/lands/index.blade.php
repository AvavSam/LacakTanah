@extends('layouts.app')

@section('content')
<div class="space-y-6">
    {{-- Header + Pencarian/Filter --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Tanah</h1>
        <a href="{{ route('lands.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow">
            + Tambah Tanah
        </a>
    </div>

    <form method="GET" action="{{ route('lands.index') }}" class="bg-white shadow rounded-lg p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
        {{-- Pencarian Kata Kunci --}}
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700">Cari (kode/desa/pemilik)</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Masukkan kata kunci...">
        </div>

        {{-- Filter Kecamatan --}}
        <div>
            <label for="kecamatan" class="block text-sm font-medium text-gray-700">Filter Kecamatan</label>
            <input type="text" name="kecamatan" id="kecamatan" value="{{ request('kecamatan') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Misal: Palu">
        </div>

        {{-- Filter Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Filter Status</label>
            <select name="status" id="status"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">— Semua Status —</option>
                @foreach(['Milik','Sewa','Belum Sertifikat','Dalam Proses'] as $st)
                    <option value="{{ $st }}" @if(request('status') === $st) selected @endif>{{ $st }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Submit --}}
        <div class="md:col-span-3 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md">
                Terapkan
            </button>
        </div>
    </form>

    {{-- Tabel Daftar Tanah --}}
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Bidang</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecamatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Luas (m²)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($lands as $land)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $land->kode_bidang ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $land->owner_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $land->kecamatan ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $land->luas_m2 ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $land->status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="inline-flex space-x-2">
                                <a href="{{ route('lands.show', $land) }}" class="px-3 py-1 bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-medium rounded">
                                    Detail
                                </a>
                                <a href="{{ route('lands.edit', $land) }}" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium rounded">
                                    Edit
                                </a>
                                <form action="{{ route('lands.destroy', $land) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data tanah.
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
