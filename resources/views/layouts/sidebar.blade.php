<aside class="w-64 bg-gray-900 text-white min-h-screen">

    <div class="p-5 text-2xl font-bold border-b border-gray-700">
        Admin Panel
    </div>

    <nav class="p-4 space-y-2">

        @canany(['dashboard.viewAny', 'dashboard.view'])
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            Dashboard
        </a>
        @endcanany

        @can('users.viewAny')
        <a href="{{ route('users.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            Users
        </a>
        @endcan

        @can('roles.viewAny')
        <a href="{{ route('roles.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            Roles
        </a>
        @endcan

        @can('products.viewAny')
        <a href="{{ route('products.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            Products
        </a>
        @endcan

    </nav>
</aside>
