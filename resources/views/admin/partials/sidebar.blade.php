<aside
  id="sidebar"
  class="fixed lg:static top-0 left-0 w-64 h-full bg-gray-800 text-white z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300"
>
  <div class="p-4 text-lg sm:text-xl font-bold border-b border-gray-700">
    Admin Panel
  </div>

  <nav class="flex flex-col justify-between h-[calc(100%-64px)]">
    <div class="flex-1 overflow-y-auto">
      <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 text-sm sm:text-base hover:bg-gray-700">Dashboard</a>
      <a href="{{ route('admin.company-profile.edit') }}" class="block py-2 px-4 text-sm sm:text-base hover:bg-gray-700">Company Profile</a>
      <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 text-sm sm:text-base hover:bg-gray-700">Category</a>
      <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 text-sm sm:text-base hover:bg-gray-700">Product</a>
      <a href="{{ route('admin.orders') }}" class="block py-2 px-4 text-sm sm:text-base hover:bg-gray-700">Orders</a>
      <a href="{{ route('admin.sales-report') }}" class="block py-2 px-4 text-sm sm:text-base hover:bg-gray-700">Sales Report</a>
    </div>

    <form action="{{ route('admin.logout') }}" method="POST" onsubmit="setLoadingState('loading-popup-logout', true)">
      @csrf
      <button type="submit" class="block w-full text-left py-2 px-4 text-sm sm:text-base hover:bg-red-500 cursor-pointer">Logout</button>
    </form>
  </nav>
</aside>
