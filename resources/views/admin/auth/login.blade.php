<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  @vite('resources/css/app.css')
  <title>Admin Login</title>
  <link rel="icon" href="{{ $logo ?? asset('default-favicon.jpg') }}">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center relative overflow-hidden">

  {{-- LOGIN CARD --}}
  <div id="page-content" class="relative z-10 w-full max-w-sm sm:max-w-md bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-xl border border-gray-100">
    <div class="text-center mb-10">
      <h2 class="text-2xl font-bold text-gray-800">Admin Login</h2>
      <p class="text-sm text-gray-500 mt-1">Welcome back! Please sign in to continue</p>
    </div>

    {{-- FORM --}}
    <form method="POST" action="{{ route('admin.login') }}" onsubmit="setLoadingState(true)" class="space-y-4">
      @csrf
      <div>
        <input
          type="text"
          name="email"
          placeholder="Email address"
          class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 rounded-lg p-2.5 text-sm sm:text-base transition outline-none"
          required
        />
      </div>

      <div>
        <input
          type="password"
          name="password"
          placeholder="Password"
          class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 rounded-lg p-2.5 text-sm sm:text-base transition outline-none"
          required
        />
      </div>

      {{-- ERROR MESSAGE --}}
      @if (session('error'))
        <p class="text-red-600 text-sm text-center font-medium">{{ session('error') }}</p>
      @endif

      <button
        type="submit"
        class="w-full bg-blue-500 hover:bg-blue-600 active:scale-[0.98] text-white font-medium py-2.5 rounded-lg text-sm sm:text-base transition-all shadow-md"
      >
        Login
      </button>
    </form>

    {{-- FOOTER --}}
    <p class="text-xs text-gray-500 text-center mt-6">
      © {{ date('Y') }} {{$company}}. All rights reserved.
    </p>
  </div>

  {{-- LOADING POPUP --}}
  <x-loading-popup id="loading-popup">
    Logging in, please wait...
  </x-loading-popup>

  {{-- SCRIPT --}}
  <script>
    function setLoadingState(loading) {
      const popup = document.getElementById('loading-popup');
      const content = document.getElementById('page-content');
      const button = document.querySelector('button');

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
  </script>
</body>
</html>
