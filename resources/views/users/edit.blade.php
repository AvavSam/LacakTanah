@extends('layouts.app')

@section('content')
  <div class="mx-auto max-w-lg">
    {{-- Judul --}}
    <h1 class="mb-6 text-2xl font-semibold text-gray-800">Edit User</h1>

    {{-- Form Edit User --}}
    <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6 rounded-lg bg-white p-6 shadow">
      @csrf
      @method('PUT')

      {{-- Nama --}}
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input
          type="text"
          name="name"
          id="name"
          value="{{ old('name', $user->name) }}"
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
          value="{{ old('email', $user->email) }}"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          required
        />
        @error('email')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Password Baru (Opsional) --}}
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">
          Password Baru
          <span class="text-sm text-gray-500">(Isi jika ingin mengubah)</span>
        </label>
        <input
          type="password"
          name="password"
          id="password"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
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
        />
      </div>

      {{-- Button Submit --}}
      <div class="flex justify-end space-x-2">
        <a href="{{ route('users.index') }}" class="rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">
          Batal
        </a>
        <button type="submit" class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700">Perbarui</button>
      </div>
    </form>
  </div>
@endsection
