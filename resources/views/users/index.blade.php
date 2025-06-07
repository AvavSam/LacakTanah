@extends('layouts.app')

@section('content')
  <div class="space-y-6">
    {{-- Judul dan Tombol Tambah --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
      <h1 class="text-2xl font-semibold text-gray-800">Daftar User</h1>
      <a
        href="{{ route('users.create') }}"
        class="mt-4 inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-blue-700 sm:mt-0"
      >
        + Tambah User
      </a>
    </div>

    {{-- Tabel User --}}
    <div class="overflow-x-auto rounded-lg bg-white shadow">
      <table class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nama</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Role</th>
            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
          @forelse ($users as $user)
            <tr class="hover:bg-gray-50">
              <td class="whitespace-nowrap px-6 py-4 text-gray-700">{{ $user->name }}</td>
              <td class="whitespace-nowrap px-6 py-4 text-gray-700">{{ $user->email }}</td>
              <td class="whitespace-nowrap px-6 py-4 text-gray-700">{{ ucfirst($user->role) }}</td>
              <td class="whitespace-nowrap px-6 py-4 text-center">
                <div class="inline-flex space-x-2">
                  <a
                    href="{{ route('users.edit', $user) }}"
                    class="rounded bg-yellow-500 px-3 py-1 text-xs font-medium text-white hover:bg-yellow-600"
                  >
                    Edit
                  </a>
                  <form
                    action="{{ route('users.destroy', $user) }}"
                    method="POST"
                    onsubmit="return confirm('Anda yakin ingin menghapus user ini?');"
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
              <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada user.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
      {{ $users->links() }}
    </div>
  </div>
@endsection
