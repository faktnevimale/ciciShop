@extends('layouts.app')

@section('content')
<div class="bg-pink-50 min-h-screen">
    <!-- Hero Banner -->
   <div class="bg-pink text-pink py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-center mb-4 mt-20" style="font-family: BebasNeue;">NAŠE PRODUKTY</h1>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <!-- Filter and Sort Section -->
        <div class="mb-8">
            <form method="GET" action="{{ route('products.index') }}" x-data="{
                filterOpen: false,
                priceFrom: {{ request('price_from', 0) }},
                priceTo: {{ request('price_to', 1000000) }}
            }">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <!-- Filter Button and Panel -->
                    <div class="relative">
                        <button type="button" @click="filterOpen = !filterOpen"
                            class="flex items-center gap-2 px-5 py-3 text-white bg-pink-400 rounded-lg hover:bg-pink-500 transition-colors shadow-md">
                            <x-heroicon-o-funnel class="h-5 w-5" />
                            <span style="font-family: Nunito;" class="font-semibold">Filtrovat produkty</span>
                        </button>

                        <!-- Filter Panel -->
                        <div x-show="filterOpen" @click.away="filterOpen = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute left-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50 overflow-hidden">

                            <div class="p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-lg font-bold" style="font-family: Nunito;">Filtr produktů</h3>
                                    <button type="button" @click="filterOpen = false" class="text-gray-500 hover:text-black">
                                        <x-heroicon-o-x-mark class="h-5 w-5" />
                                    </button>
                                </div>

                                <!-- Price Range -->
                                <div class="mb-6">
                                    <h4 class="font-semibold mb-3" style="font-family: Nunito;">Cenové rozmezí</h4>

                                    <div class="mb-4">
                                        <label for="price_from" class="block text-sm mb-1" style="font-family: NunitoLight;">
                                            Cena od: <span x-text="priceFrom + ' Kč'" class="font-semibold"></span>
                                        </label>
                                        <input type="range" id="price_from" name="price_from" min="0" max="100000000" step="1"
                                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-pink-400"
                                            x-model="priceFrom">
                                    </div>

                                    <div class="mb-4">
                                        <label for="price_to" class="block text-sm mb-1" style="font-family: NunitoLight;">
                                            Cena do: <span x-text="priceTo + ' Kč'" class="font-semibold"></span>
                                        </label>
                                        <input type="range" id="price_to" name="price_to" min="0" max="100000000" step="1"
                                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-pink-400"
                                            x-model="priceTo">
                                    </div>

                                    <!-- Price inputs -->
                                    <div class="flex gap-4 mt-4">
                                        <div class="w-1/2">
                                            <label for="price_from_input" class="sr-only">Cena od</label>
                                            <div class="relative">
                                                <input type="number" id="price_from_input"
                                                    class="w-full p-2 border border-gray-300 rounded-lg pl-8"
                                                    x-model="priceFrom" min="0">
                                                <span class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500">Kč</span>
                                            </div>
                                        </div>
                                        <div class="w-1/2">
                                            <label for="price_to_input" class="sr-only">Cena do</label>
                                            <div class="relative">
                                                <input type="number" id="price_to_input"
                                                    class="w-full p-2 border border-gray-300 rounded-lg pl-8"
                                                    x-model="priceTo" min="0">
                                                <span class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500">Kč</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Categories -->
                                <div class="mb-6">
                                    <h4 class="font-semibold mb-3" style="font-family: Nunito;">Kategorie</h4>
                                    <div class="space-y-2">
                                        @foreach($categories as $category)
                                            <label class="flex items-center">
                                                <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                                    {{ in_array($category->id, (array)request('category', [])) ? 'checked' : '' }}
                                                    class="rounded text-pink-500 focus:ring-pink-500">
                                                <span class="ml-2" style="font-family: NunitoLight;">{{ $category->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full py-3 bg-black text-white font-semibold rounded-lg hover:bg-pink-400 transition-colors">
                                    Použít filtr
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sort Options -->
                    <div class="flex items-center">
                        <label for="sort_by" class="mr-2 font-medium" style="font-family: Nunito;">Řadit podle:</label>
                        <select name="sort_by" id="sort_by"
                            class="p-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-pink-400 focus:border-pink-400"
                            onchange="this.form.submit()" style="font-family: NunitoLight;">
                            <option value="">Vyberte </option>
                            <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Cena (nejnižší)</option>
                            <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Cena (nejvyšší)</option>
                            <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Název (A-Z)</option>
                            <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Název (Z-A)</option>
                            <option value="rating_desc" {{ request('sort_by') == 'rating_desc' ? 'selected' : '' }}>Nejlépe hodnocené</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <!-- Search Results Heading (if searching) -->
        @if(request('query'))
            <div class="mb-6">
                <h2 class="text-2xl font-bold" style="font-family: Nunito;">
                    Výsledky vyhledávání pro: "{{ request('query') }}"
                </h2>
                <p class="text-gray-600" style="font-family: NunitoLight;">
                    Nalezeno {{ $products->total() }} {{ $products->total() == 1 ? 'produkt' : ($products->total() >= 2 && $products->total() <= 4 ? 'produkty' : 'produktů') }}
                </p>
            </div>
        @endif
        <!-- Active Filters (optional) -->
        @if(request('price_from') > 0 || request('price_to') < 1000000 || request('category'))
        <div class="mb-6 flex flex-wrap gap-2">
            <span class="text-sm text-gray-600" style="font-family: Nunito;">Aktivní filtry:</span>

            @if(request('price_from') > 0)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-pink-100 text-pink-800">
                Cena od: {{ request('price_from') }} Kč
                <a href="{{ request()->fullUrlWithQuery(['price_from' => 0]) }}" class="ml-1 text-pink-800 hover:text-pink-900">
                    <x-heroicon-o-x-mark class="h-4 w-4" />
                </a>
            </span>
            @endif

            @if(request('price_to') < 100000000)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-pink-100 text-pink-800">
                Cena do: {{ request('price_to') }} Kč
                <a href="{{ request()->fullUrlWithQuery(['price_to' => 100000000]) }}" class="ml-1 text-pink-800 hover:text-pink-900">
                    <x-heroicon-o-x-mark class="h-4 w-4" />
                </a>
            </span>
            @endif

            @if(request('category'))
                @foreach((array)request('category') as $categoryId)
                    @php
                        $categoryName = $categories->where('id', $categoryId)->first()->name ?? '';
                    @endphp
                    @if($categoryName)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-pink-100 text-pink-800">
                        Kategorie: {{ $categoryName }}
                        <a href="{{ request()->fullUrlWithQuery(['category' => array_diff((array)request('category'), [$categoryId])]) }}" class="ml-1 text-pink-800 hover:text-pink-900">
                            <x-heroicon-o-x-mark class="h-4 w-4" />
                        </a>
                    </span>
                    @endif
                @endforeach
            @endif

            <a href="{{ route('products.index') }}" class="text-sm text-black hover:text-pink-600 underline ml-2" style="font-family: NunitoLight;">
                Zrušit všechny filtry
            </a>
        </div>
        @endif

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="group relative bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1">
                <!-- Badge (optional) -->
                @if(isset($product->is_new) && $product->is_new)
                <div class="absolute top-3 left-3 z-10">
                    <span class="inline-block bg-pink-400 text-black px-3 py-1 rounded-full text-xs font-bold" style="font-family: Nunito;">NOVINKA</span>
                </div>
                @endif

                <!-- Product Image with Hover Effect -->
                <div class="relative overflow-hidden h-64">
                    <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                        <img src="{{ asset('storage/' . ($product->images[0] ?? 'products/default.jpg')) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </a>

                    <!-- Quick View Button (optional) -->
                    <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <a href="{{ route('products.show', $product->id) }}"
                            class="bg-black text-white px-4 py-2 rounded-lg transform translate-y-4 hover:bg-pink-400 transition-color group-hover:translate-y-0 transition-transform duration-300"
                            style="font-family: Nunito;">
                            Přejít na produkt
                        </a>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-5 flex flex-col flex-grow">
                    <div class="mb-2 flex items-center">
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($product->averageRating()))
                                    <x-heroicon-s-star class="h-4 w-4 star-pink" />
                                @else
                                    <x-heroicon-s-star class="h-4 w-4 star-gray" />
                                @endif
                            @endfor
                        </div>
                        <style>
                            .star-pink {
                                color: #FBBF24; /* Žlutá barva (Tailwind text-pink-400) */
                            }
                            .star-gray {
                                color: #D1D5DB; /* Šedá barva (Tailwind text-gray-300) */
                            }
                        </style>
                        <span class="text-xs text-gray-500 ml-1" style="font-family: NunitoLight;">
                            ({{ $product->reviews->count() }})
                        </span>
                    </div>

                    <h2 class="text-lg font-bold mb-2" style="font-family: Nunito;">{{ $product->name }}</h2>

                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-grow" style="font-family: NunitoLight;">
                        {{ $product->description }}
                    </p>

                    <div class="mt-auto">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xl font-bold text-black" style="font-family: Nunito;">{{ $product->price }} Kč</span>

                            @if(isset($product->old_price) && $product->old_price > $product->price)
                            <span class="text-sm line-through text-gray-500" style="font-family: NunitoLight;">
                                {{ $product->old_price }} Kč
                            </span>
                            @endif
                        </div>

                        <div class="flex space-x-2">
                            <a href="{{ route('products.show', $product->id) }}"
                                class="flex-1 bg-black text-white text-center py-2 rounded-lg hover:bg-pink-400 transition-colors"
                                style="font-family: Nunito;">
                                Detail
                            </a>
                            <!-- Add to Cart Button -->
                            <button type="button"
                                    class="bg-pink-400 text-white px-3 py-2 rounded-lg hover:bg-pink-500 transition-colors"
                                    onclick="addToCart({{ $product->id }})"
                                    title="Přidat do košíku">
                                <x-heroicon-o-shopping-cart class="h-5 w-5" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if(count($products) === 0)
        <div class="text-center py-16">
            <x-heroicon-o-face-frown class="h-16 w-16 text-gray-400 mx-auto mb-4" />
            <h3 class="text-xl font-bold mb-2" style="font-family: Nunito;">Žádné produkty nenalezeny</h3>
            <p class="text-gray-600 mb-6" style="font-family: NunitoLight;">Zkuste změnit filtry nebo vyhledat jiné produkty.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-pink-400 text-black px-6 py-3 rounded-lg font-semibold hover:bg-pink-500 transition-colors" style="font-family: Nunito;">
                Zobrazit všechny produkty
            </a>
        </div>
        @endif

        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</div>

<!-- Add to Cart Confirmation -->
<div id="cart-confirmation" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4 shadow-2xl transform transition-all">
        <div class="text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-heroicon-o-check class="h-8 w-8 text-green-500" />
            </div>
            <h3 class="text-xl font-bold mb-2" style="font-family: Nunito;">Produkt přidán do košíku</h3>
            <p class="text-gray-600 mb-6" style="font-family: NunitoLight;">Produkt byl úspěšně přidán do vašeho košíku.</p>
            <div class="flex flex-col sm:flex-row gap-3">
                <button type="button" onclick="closeCartConfirmation()"
                    class="flex-1 bg-gray-200 text-black py-2 rounded-lg hover:bg-gray-300 transition-colors"
                    style="font-family: Nunito;">
                    Pokračovat v nákupu
                </button>
                <a href="{{ route('cart.index') }}"
                    class="flex-1 bg-pink-400 text-white py-2 rounded-lg hover:bg-pink-500 transition-colors text-center"
                    style="font-family: Nunito;">
                    Přejít do košíku
                </a>
            </div>
        </div>
    </div>
</div>


<script>
// Function to add product to the cart
    function addToCart(productId) {
        // Show the confirmation modal
        document.getElementById('cart-confirmation').classList.remove('hidden');

        // Send AJAX request to add the product to the cart
        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Ensure CSRF token is present
            },
            body: JSON.stringify({
                stay: 'false'  // Change to 'true' if you want to stay on the page after adding to the cart
            })
        })
        .then(response => response.json()) // Parse the JSON response
        .then(data => {
            if (data.success) {
                // Successfully added to cart (you can handle more here)
                console.log('Product added to cart!');
            } else {
                console.error('Failed to add to cart:', data.message || 'Unknown error');
            }
        })
        .catch(error => {
            console.error('Error adding to cart:', error);
        });
    }

    // Close the confirmation modal
    function closeCartConfirmation() {
        document.getElementById('cart-confirmation').classList.add('hidden');
    }
</script>

<style>
    /* Custom styles for range inputs */
    input[type="range"] {
        -webkit-appearance: none;
        height: 6px;
        background: #e5e7eb;
        border-radius: 5px;
        background-image: linear-gradient(#60a5fa, #60a5fa);
        background-repeat: no-repeat;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 18px;
        width: 18px;
        border-radius: 50%;
        background: #60a5fa;
        cursor: pointer;
        box-shadow: 0 0 2px 0 #555;
    }

    input[type="range"]::-moz-range-thumb {
        height: 18px;
        width: 18px;
        border-radius: 50%;
        background: #fbbf24;
        cursor: pointer;
        box-shadow: 0 0 2px 0 #555;
        border: none;
    }

    /* Line clamp for product descriptions */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Custom pagination styling */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination > * {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        height: 2.5rem;
        padding: 0 0.75rem;
        border-radius: 0.375rem;
        font-weight: 500;
        background-color: white;
        color: #374151;
        border: 1px solid #e5e7eb;
    }

    .pagination > .active {
        background-color: #fbbf24;
        color: black;
        border-color: #fbbf24;
    }

    .pagination > *:hover:not(.active) {
        background-color: #f9fafb;
    }
</style>
@endsection
