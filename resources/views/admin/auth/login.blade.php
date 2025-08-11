<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  @vite('resources/css/app.css')
  <title>Login Admin</title>
</head>
<body class="bg-gray-100 relative">

  {{-- CONTAINER UTAMA --}}
  <div id="page-content" class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 transition duration-300">
    <div class="w-full max-w-xs sm:max-w-md bg-white p-6 sm:p-8 rounded-lg shadow relative z-10">
      <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-center">Login Admin</h2>

      <form method="POST" action="{{ route('admin.login') }}" onsubmit="setLoadingState(true)">
        @csrf
        <input
          type="text"
          name="email"
          placeholder="Email"
          class="w-full mb-3 border rounded p-2 text-sm sm:text-base"
          required
        />

        <input
          type="password"
          name="password"
          placeholder="Password"
          class="w-full mb-3 border rounded p-2 text-sm sm:text-base"
          required
        />

        {{-- Error Message --}}
        <div class="h-6 mb-3">
          @if (session('error'))
            <p class="text-red-600 text-sm">{{ session('error') }}</p>
          @endif
        </div>

        <button
          type="submit"
          class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-sm sm:text-base transition-colors duration-200 cursor-pointer"
        >
          Login
        </button>
      </form>
    </div>
  </div>

  {{-- LOADING OVERLAY --}}
  <x-loading-popup id="loading-popup">
    Logging in, please wait...
  </x-loading-popup>

  {{-- SCRIPT LOADING STATE --}}
  <script>
    function setLoadingState(loading) {
      const popup = document.getElementById('loading-popup');
      const content = document.getElementById('page-content');
      const button = document.querySelector('button');

      if (loading) {
        popup.classList.remove('hidden');
    - popup.classList.add('flex');
        content.classList.add('pointer-events-none', 'opacity-30');
        button.disabled = true;
      } else {
        popup.classList.remove('flex');
        popup.classList.add('hidden');
        content.classList.remove('pointer-events-none', 'opacity-30');
        button.disabled = false;
      }
    }
  </script>
</body>
</html>
