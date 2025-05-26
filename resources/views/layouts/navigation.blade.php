<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 fixed w-full z-50 ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 " style="font-family: Nunito;">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
<!-- Logo + Název vlevo -->
<div class="shrink-0 flex items-center space-x-2 ms-[-12px]">
    <a href="{{ route('home') }}" class="flex items-center space-x-2">
        <img src="/images/logo.png" alt="čičiShop Logo" class="h-16 w-auto">
        <span class="text-xl font-bold text-gray-800 dark:text-white" style="font-family: Nunito;">čičiShop</span>
    </a>
</div>



                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex " style="font-family: Nunito;">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Domů') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                        {{ __('Produkty') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">
                        {{ __('Kontakt') }}
                    </x-nav-link>
                    <x-nav-link :href="route('questions.index')" :active="request()->routeIs('questions.index')">
                        {{ __('Otázky') }}
                    </x-nav-link>

                    <!-- Search Form -->
                <form action="{{ route('products.index') }}" method="GET" class="w-full md:w-1/3 mt-2">
                    <div class="relative">
                        <input type="text" name="query" placeholder="Hledat.."
                               class="w-full p-3 pl-10 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent"
                               value="{{ request('query') }}" style="font-family: NunitoLight;">
                        <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                            <x-heroicon-o-magnifying-glass class="h-5 w-5" />
                        </button>
                    </div>
                </form>
                </div>
            </div>

            <!-- User Dropdown -->
            <div x-data="{ open: false }" @click.away="open = false" class="relative ml-auto">
                <button @click="open = !open" class="inline-flex items-end px-3 pb-5 pt-6 border border-transparent text-sm leading-4 font-medium rounded-md text-pink-300 dark:text-pink-400 bg-white dark:bg-pink-800 hover:text-pink-700 dark:hover:text-pink-300 focus:outline-none transition ease-in-out duration-150">
                    @auth
                        <div>{{ Auth::user()->name }}</div>
                    @else
                        <div>{{ __('Host') }}</div>
                    @endauth
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>

                <div x-show="open" x-transition
                    class="absolute right-0 w-48 bg-white dark:bg-pink-500 rounded-md shadow-lg z-50 mt-2">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Odhlásit se') }}</x-dropdown-link>
                        </form>
                    @else
                        <x-dropdown-link :href="route('login')">{{ __('Přihlásit se') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('register')">{{ __('Registrovat se') }}</x-dropdown-link>
                    @endauth
                </div>
            </div>


            <!-- Cart Button (top-right) -->
            <a href="{{ route('cart.index') }}" class="relative inline-flex items-center justify-center p-2 rounded-md text-black dark:text-pink-400 hover:text-pink-700 dark:hover:text-pink-300 focus:outline-none transition ease-in-out duration-150">
            <x-heroicon-o-shopping-bag class="h-6 w-6 text-black dark:text-pink-400" />
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="cart-badge">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <form method="GET" action="{{ route('products.index') }}" class="flex items-center">
            <input type="text" name="query" placeholder="Hledat produkt..." class="px-4 py-2 border rounded" value="{{ request('query') }}">
            <button type="submit" class="ml-2 bg-pink-500 text-white px-4 py-2 rounded">Hledat</button>
        </form>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Domů') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('Produkty') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">
                {{ __('Kontakt') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('questions.index')" :active="request()->routeIs('questions.index')">
                {{ __('Otázky') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name ?? __('Guest') }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? '' }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Odhlásit se') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
.cart-badge {
    position: absolute;
    top: 0.5rem;
    right: -0.15rem;
    background-color: #ef4444;
    color: white;
    font-size: 0.75rem;
    font-weight: bold;
    border-radius: 9999px;
    height: 1.25rem;
    width: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;

    outline: 2px solid white;
    outline-offset: 0px;
}
</style>
