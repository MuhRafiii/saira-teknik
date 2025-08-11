@extends('layouts.admin')

@section('title', 'Company Profile')
@section('header', 'Company Profile')

@section('content')
<div id="page-content" class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-xl lg:text-2xl font-semibold mb-4">Company Profile</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-sm sm:text-base">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.company-profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm" onsubmit="setLoadingState('loading-popup-profile', true)">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name', $profile->name) }}"
                    class="w-full border rounded px-3 py-2 text-sm sm:text-base">
            </div>

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $profile->email) }}"
                    class="w-full border rounded px-3 py-2 text-sm sm:text-base">
            </div>

            <div>
                <label class="block text-sm font-medium">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
                    class="w-full border rounded px-3 py-2 text-sm sm:text-base">
            </div>

            <div>
                <label class="block text-sm font-medium">Address</label>
                <input type="text" name="address" value="{{ old('address', $profile->address) }}"
                    class="w-full border rounded px-3 py-2 text-sm sm:text-base">
            </div>

            <div class="lg:col-span-2">
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border rounded px-3 py-2 text-sm sm:text-base">{{ old('description', $profile->description) }}</textarea>
            </div>

            <div class="lg:col-span-2">
                <label class="block text-sm font-medium">Logo</label>
                <input type="file" name="logo" class="block mt-1 border border-gray-300 rounded px-3 py-2 cursor-pointer hover:bg-gray-200">
                @if ($profile->logo)
                    <img src="{{ $profile->logo }}" alt="Logo" class="mt-2 w-24 h-24 object-contain">
                @endif
            </div>
        </div>

        <div class="mt-6 flex gap-4">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm sm:text-base cursor-pointer">Save Changes</button>
            <a href="{{ route('admin.dashboard') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm sm:text-base">Back</a>
        </div>
    </form>
</div>

<x-loading-popup id="loading-popup-profile">
    Saving changes...
</x-loading-popup>
@endsection

@push('scripts')
    <script>
        let isDirty = false;

        const form = document.getElementById('profileForm');
        const inputs = form.querySelectorAll('input, textarea');

        inputs.forEach(input => {
            input.addEventListener('input', () => {
                isDirty = true;
            });
        });

        document.querySelector('form').addEventListener('submit', () => {
            isDirty = false;
        });

        const links = document.querySelectorAll('a');

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                if (isDirty) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Unsaved changes',
                        text: 'You have unsaved changes. Are you sure you want to leave?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Leave',
                        cancelButtonText: 'Stay'
                    }).then(result => {
                        if (result.isConfirmed) {
                            window.location.href = e.target.href;
                            setLoadingState('loading-popup', true)
                        }
                    });
                }
            });
        });
    </script>
@endpush
