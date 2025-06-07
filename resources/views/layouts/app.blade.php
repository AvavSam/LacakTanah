<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'LacakTanah') }}</title>
    <link rel="icon" href="{{ asset('lacaktanah1.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
  </head>
  <body class="font-inter bg-gray-50 antialiased">
    <div class="flex min-h-screen flex-col">
      <!-- Navigation -->
      <nav x-data="{ open: false }" class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="flex h-16 justify-between">
            <!-- Logo -->
            <div class="flex items-center">
              <a href="{{ route('dashboard') }}" class="flex items-center">
                <img class="h-8 w-auto" src="{{ asset('lacaktanah1.png') }}" alt="Logo" />
                <span class="ml-2 text-xl font-semibold text-gray-800">{{ config('app.name', 'Lacak') }}</span>
              </a>
            </div>
            <!-- Desktop Menu -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
              <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
              </x-nav-link>
              <x-nav-link :href="route('lands.index')" :active="request()->routeIs('lands.*')">
                {{ __('Daftar Tanah') }}
              </x-nav-link>
              @if (Auth::user()->isAdmin())
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                  {{ __('Daftar User') }}
                </x-nav-link>
              @endif
            </div>
            <!-- Mobile Hamburger + User Dropdown -->
            <div class="flex items-center">
              <!-- User Dropdown -->
              <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                    <button
                      class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none"
                    >
                      <div>{{ Auth::user()->name }}</div>
                      <div class="ml-1">
                        <svg
                          class="h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                      </div>
                    </button>
                  </x-slot>
                  <x-slot name="content">
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <x-dropdown-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                      >
                        {{ __('Logout') }}
                      </x-dropdown-link>
                    </form>
                  </x-slot>
                </x-dropdown>
              </div>
              <!-- Mobile Menu Button -->
              <div class="flex items-center sm:hidden">
                <button
                  @click="open = !open"
                  class="inline-flex items-center justify-center rounded-md p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-none"
                >
                  <svg
                    :class="{'hidden': open, 'block': !open}"
                    class="h-6 w-6"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 24 24"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  </svg>
                  <svg
                    :class="{'hidden': !open, 'block': open}"
                    class="h-6 w-6"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 24 24"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Mobile Menu -->
        <div :class="{'block': open, 'hidden': !open}" class="sm:hidden">
          <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
              {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('lands.index')" :active="request()->routeIs('lands.*')">
              {{ __('Daftar Tanah') }}
            </x-responsive-nav-link>
            @if (Auth::user()->isAdmin())
              <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                {{ __('Daftar User') }}
              </x-responsive-nav-link>
            @endif
          </div>
          <div class="border-t border-gray-200 pb-1 pt-4">
            <div class="px-4">
              <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
              <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
              <!-- Logout -->
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link
                  :href="route('logout')"
                  onclick="event.preventDefault(); this.closest('form').submit();"
                >
                  {{ __('Logout') }}
                </x-responsive-nav-link>
              </form>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Content -->
      <main class="flex-1 py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          @yield('content')
        </div>
      </main>
    </div>
    @stack('scripts')
  </body>
</html>
