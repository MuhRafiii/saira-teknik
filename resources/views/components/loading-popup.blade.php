<div id="{{ $id }}" class="hidden fixed inset-0 items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow flex flex-col items-center">
    <svg class="animate-spin h-8 w-8 text-blue-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10"
                stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
        </path>
    </svg>
    <p class="text-sm text-gray-700">{{ $slot }}</p>
    </div>
</div>