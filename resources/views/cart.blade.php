@extends('layouts.customer')

@section('title', 'Shopping Cart')

@section('content')
  <section class="pt-10 md:pt-16 pb-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-gray-800">Shopping Cart</h1>

      @if ($cart)
        <div class="space-y-6">
          @foreach ($cart as $item)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col sm:flex-row gap-4 items-center sm:items-center">
              <img
                src="{{ $item['image'] ?? 'https://res.cloudinary.com/dypiyksms/image/upload/v1754490991/placeholder_dvwraw.png' }}"
                alt="{{ $item['name'] }}"
                class="h-24 object-cover rounded"
              />
              <div class="flex-1 w-full">
                <h2 class="w-full md:w-2/3 text-lg font-semibold text-gray-800 line-clamp-1">{{ $item['name'] }}</h2>
                <p class="mt-2 text-primary font-bold">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>

                <form
                  action="{{ route('cart.update', $item['id']) }}"
                  method="POST"
                  class="mt-3 flex items-center gap-2"
                >
                  @csrf
                  @method('PUT')
                  <input
                    type="number"
                    name="quantity"
                    min="1"
                    value="{{ $item['quantity'] }}"
                    class="w-20 text-center border border-gray-300 rounded px-2 py-1 text-sm"
                  />
                  <button
                    type="submit"
                    class="text-sm bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded cursor-pointer"
                  >
                    Update
                  </button>
                  @if ($item['quantity'] > $item['stock'])
                    <p class="warning text-sm text-red-400">Out of stock!</p>
                  @endif
                </form>
              </div>

              <div class="flex sm:flex-col items-end justify-between sm:justify-evenly text-sm sm:text-base font-semibold text-right w-full sm:w-auto">
                <p>Total: Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                <form
                  action="{{ route('cart.remove', $item['id']) }}"
                  method="POST"
                  class="remove mt-2"
                >
                  @csrf
                  @method('DELETE')
                  <button
                    type="submit"
                    class="text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded cursor-pointer"
                  >
                    Remove
                  </button>
                </form>
              </div>
            </div>
          @endforeach
        </div>

        {{-- Total keseluruhan dan tombol checkout --}}
        <div class="mt-10 bg-white p-6 rounded-lg shadow flex flex-col sm:flex-row justify-between items-center gap-4">
          <div class="text-lg font-bold text-gray-700">
            Total: Rp {{ number_format($total, 0, ',', '.') }}
          </div>
          <a
            href="{{ route('checkout.index') }}" 
            class="checkout-btn bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-md w-full sm:w-auto text-center"
          >
            Checkout Now
          </a>
        </div>
      @else
        <div class="text-center text-gray-600 py-16">
          <p class="text-lg">You have no items in your cart.</p>
          <a href="{{ route('product.index') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-full text-sm">
            Shop Now
          </a>
        </div>
      @endif
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const warnings = document.querySelectorAll('.warning');
      const checkout = document.querySelector('.checkout-btn');

      if (warnings.length > 0 && checkout) {
          checkout.classList.add('pointer-events-none', 'opacity-50');
          checkout.setAttribute('aria-disabled', 'true'); // aksesibilitas
      }
    });

    document.querySelectorAll('.remove').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Cegah submit langsung

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form jika dikonfirmasi
                }
            });
        });
    });
</script>
@endpush

@if (session('error'))
    @push('scripts')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Out of Stock!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endpush
@endif