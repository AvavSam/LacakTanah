@extends('layouts.app')

@section('content')
  <div class="mx-auto max-w-lg">
    {{-- Judul --}}
    <h1 class="mb-6 text-2xl font-semibold text-gray-800">Tambah User Baru</h1>

    {{-- Form Tambah User --}}
    <form action="{{ route('users.store') }}" method="POST" class="space-y-6 rounded-lg bg-white p-6 shadow">
      @csrf

      {{-- Nama --}}
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input
          type="text"
          name="name"
          id="name"
          value="{{ old('name') }}"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          required
          autofocus
        />
        @error('name')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Email --}}
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input
          type="email"
          name="email"
          id="email"
          value="{{ old('email') }}"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          required
        />
        @error('email')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Password --}}
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input
          type="password"
          name="password"
          id="password"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          required
        />
        @error('password')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Konfirmasi Password --}}
      <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
        <input
          type="password"
          name="password_confirmation"
          id="password_confirmation"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          required
        />
      </div>

      {{-- Button Submit --}}
      <div class="flex justify-end">
        <a
          href="{{ route('users.index') }}"
          class="mr-2 rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300"
        >
          Batal
        </a>
        <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Simpan</button>
      </div>
    </form>
  </div>
@endsection
