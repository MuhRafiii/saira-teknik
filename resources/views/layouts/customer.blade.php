<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @php
        $company = \App\Models\CompanyProfile::first();
    @endphp
    <link rel="icon" type="image/jpeg" href="{{ $company?->logo ?? asset('default-favicon.jpg') }}">

    @vite('resources/css/app.css')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="flex flex-col justify-between min-h-screen">
        <div class="">
            <x-navbar />
            
            <main class="pt-20 pb-10 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
        
        @if (!Request::is('checkout'))
        <x-footer />
        @endif
    </div>
    
    @stack('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
