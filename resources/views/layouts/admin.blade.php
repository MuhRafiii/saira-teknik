<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel - @yield('title')</title>

  @php
      $company = \App\Models\CompanyProfile::first();
  @endphp
  <link rel="icon" href="{{ $company?->logo ?? asset('default-favicon.jpg') }}">

  @vite('resources/css/app.css')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen overflow-hidden">

  {{-- Wrapper for sidebar + content --}}
  <div id="full-page" class="flex h-screen">
    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Overlay --}}
    <div 
      id="overlay"
      class="fixed inset-0 bg-opacity-50 z-30 hidden lg:hidden"
      onclick="closeSidebar()"
    ></div>

    {{-- Main content --}}
    <div id="mainContent" class="flex-1 flex flex-col overflow-y-auto">
      @include('admin.partials.navbar')
      <main class="p-4 sm:p-6 lg:p-8">
        @yield('content')
      </main>
    </div>

    <x-loading-popup id="loading-popup">
      Wait a moment...
    </x-loading-popup>

    <x-loading-popup id="loading-popup-logout">
      Logging out...
    </x-loading-popup>
  </div>

  <script>
    function setLoadingState(popupId, loading) {
      const popup = document.getElementById(popupId);
      const button = document.querySelector('button');
      let content;
      
      if (popupId === 'loading-popup-logout') {
        content = document.getElementById('full-page');
      } else {
        content = document.getElementById('page-content');
      }

      if (!popup) return;

      if (loading) {
          popup.classList.remove('hidden');
          popup.classList.add('flex');
          content.classList.add('pointer-events-none', 'opacity-30');
          button.disabled = true;
      } else {
          popup.classList.remove('flex');
          popup.classList.add('hidden');
          content.classList.remove('pointer-events-none', 'opacity-30');
          button.disabled = false;
      }
    }

    function openSidebar() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('overlay');
      sidebar.classList.remove('-translate-x-full');
      overlay.classList.remove('hidden');
    }

    function closeSidebar() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('overlay');
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
    }

    // close sidebar if ESC key is pressed
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeSidebar();
    });
  </script>

  @stack('scripts')
</body>
</html>
