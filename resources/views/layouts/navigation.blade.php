<nav x-data="{ open: false, profileOpen: false }"
     class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- LEFT -->
            <div class="flex items-center gap-10">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                        A
                    </div>

                    <div class="hidden sm:block">
                        <h1 class="text-lg font-bold text-gray-800">
                            Admin Panel
                        </h1>

                        <p class="text-xs text-gray-500">
                            Role & Permission System
                        </p>
                    </div>

                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-2">

                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition
                       {{ request()->routeIs('dashboard')
                            ? 'bg-blue-100 text-blue-700'
                            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                        Dashboard

                    </a>

                    @can('users.viewAny')
                    <a href="{{ route('users.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition
                       {{ request()->routeIs('users.*')
                            ? 'bg-blue-100 text-blue-700'
                            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                        Users

                    </a>
                    @endcan

                    @can('roles.viewAny')
                    <a href="{{ route('roles.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition
                       {{ request()->routeIs('roles.*')
                            ? 'bg-blue-100 text-blue-700'
                            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                        Roles

                    </a>
                    @endcan

                    @can('products.viewAny')
                    <a href="{{ route('products.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition
                       {{ request()->routeIs('products.*')
                            ? 'bg-blue-100 text-blue-700'
                            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                        Products

                    </a>
                    @endcan

                </div>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <!-- User Dropdown -->
                <div class="relative hidden md:block">

                    <button @click="profileOpen = !profileOpen"
                            class="flex items-center gap-3 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-xl px-3 py-2 transition">

                        <!-- Avatar -->
                        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold uppercase shadow">

                            {{ substr(Auth::user()->name, 0, 1) }}

                        </div>

                        <!-- User Info -->
                        <div class="text-left">

                            <p class="text-sm font-semibold text-gray-800 leading-tight">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ Auth::user()->email }}
                            </p>

                        </div>

                        <!-- Arrow -->
                        <svg class="w-4 h-4 text-gray-500 transition"
                             :class="{ 'rotate-180': profileOpen }"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7" />

                        </svg>

                    </button>

                    <!-- Dropdown -->
                    <div x-show="profileOpen"
                         @click.away="profileOpen = false"
                         x-transition
                         class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

                        <!-- Header -->
                        <div class="p-5 border-b border-gray-100">

                            <p class="font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ Auth::user()->email }}
                            </p>

                        </div>

                        <!-- Links -->
                        <div class="p-2">

                            {{-- <a href="{{ route('profile.edit') }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 transition text-gray-700">

                                <svg class="w-5 h-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />

                                </svg>

                                Profile

                            </a> --}}

                            <form method="POST"
                                  action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-50 text-red-600 transition">

                                    <svg class="w-5 h-5"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5m-6 16h12a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />

                                    </svg>

                                    Logout

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

                <!-- Mobile Button -->
                <button @click="open = !open"
                        class="md:hidden inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:bg-gray-100 transition">

                    <svg class="h-6 w-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path x-show="!open"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path x-show="open"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

    <!-- Mobile Menu -->
    <div x-show="open"
         x-transition
         class="md:hidden border-t border-gray-100 bg-white">

        <div class="px-4 py-4 space-y-2">

            <a href="{{ route('dashboard') }}"
               class="block px-4 py-3 rounded-xl hover:bg-gray-100">

                Dashboard

            </a>

            @can('users.viewAny')
            <a href="{{ route('users.index') }}"
               class="block px-4 py-3 rounded-xl hover:bg-gray-100">

                Users

            </a>
            @endcan

            @can('roles.viewAny')
            <a href="{{ route('roles.index') }}"
               class="block px-4 py-3 rounded-xl hover:bg-gray-100">

                Roles

            </a>
            @endcan

            @can('products.viewAny')
            <a href="{{ route('products.index') }}"
               class="block px-4 py-3 rounded-xl hover:bg-gray-100">

                Products

            </a>
            @endcan

        </div>

        <!-- Mobile User -->
        <div class="border-t border-gray-100 p-4">

            <div class="flex items-center gap-3 mb-4">

                <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold uppercase">

                    {{ substr(Auth::user()->name, 0, 1) }}

                </div>

                <div>

                    <p class="font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ Auth::user()->email }}
                    </p>

                </div>

            </div>

            {{-- <a href="{{ route('profile.edit') }}"
               class="block px-4 py-3 rounded-xl hover:bg-gray-100 mb-2">

                Profile

            </a> --}}

            <form method="POST"
                  action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl text-red-600 hover:bg-red-50">

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>