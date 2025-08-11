<nav class="fixed top-0 left-0 right-0 bg-white border-b border-gray-200 shadow-sm z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      
      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
          <img src="{{ $company->logo ?? 'https://res.cloudinary.com/dypiyksms/image/upload/v1754490991/placeholder_dvwraw.png' }}" alt="Company Logo" class="w-8 h-8 rounded-full object-cover">
        </a>
      </div>

      <!-- Navigation Links -->
      <div class="hidden lg:flex lg:space-x-6 items-center">
        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
        <a href="{{ route('category.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Categories</a>
        <a href="{{ route('product.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Products</a>
        <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Cart</a>
      </div>

      <!-- Mobile Hamburger -->
      <div class="lg:hidden">
        <button id="mobileMenuButton" class="text-gray-600 focus:outline-none">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="hidden lg:hidden px-4 pb-4">
    <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-blue-600">Home</a>
    <a href="{{ route('category.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">Categories</a>
    <a href="{{ route('product.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">Products</a>
    <a href="{{ route('cart.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">Cart</a>
  </div>

  <script>
    const toggleButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    toggleButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</nav>
