@extends('layouts.app')
@php
    $slides = [
        [
            'title' => 'Zase svítí kuře?',
            'description' => 'Nevadí, jsme tu pro tebe 24/7, ale nezaručujeme, že to stihneme doručit. Také jezdíme v BMW.',
            'image' => asset('images/engineLight.jpg'),
            'alt' => 'engineLight',
            'link' => '/products',
        ],
        [
            'title' => 'Fouklé těsnění?',
            'description' => 'Říkali: "Kup si Subaru, kup si BMW, užiješ si s tím spoustu zábavy!" Ale na těsnění nemyslel nikdo, co? Kryjeme ti záda!',
            'image' => asset('images/headGasket.jpeg'),
            'alt' => 'headGasket',
            'link' => '/products',
        ],
        [
            'title' => 'Odkup Katalyzátorů',
            'description' => 'Bez peněz? Flexu máš? Ať už katík uřežeš z auta táty nebo dědy, vždy ho odkoupíme za dobrou cenu!',
            'image' => asset('images/catalyticConverter.webp'),
            'alt' => 'catalyticConverter',
            'link' => '/products',
        ],
    ];
@endphp
@section('content')
<!-- Hero Section Fullscreen Split Left-Right -->
<div x-data="{ current: 0, slides: {{ json_encode($slides) }} }" x-init="setInterval(() => current = (current + 1) % slides.length, 5000)" class="relative min-h-screen bg-black text-white overflow-hidden">
    <template x-for="(item, index) in slides" :key="index">
        <div x-show="current === index" class="absolute inset-0 transition-opacity duration-1000 ease-in-out flex flex-col md:flex-row items-center justify-between z-10">
            <!-- Text vlevo -->
            <div class="w-full md:w-1/2 text-center md:text-left flex justify-center md:justify-start items-center p-8 md:p-16 z-20">
                <div>
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 font-['BebasNeue', sans-serif]" x-text="item.title"></h1>
                    <p class="text-lg md:text-xl mb-8 font-light" x-text="item.description"></p>
                    <a :href="item.link" class="inline-block bg-blue-400 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-300 transition">
                        Zjistit více
                    </a>
                </div>
            </div>

            <!-- Obrázek vpravo -->
            <div class="w-full md:w-1/2 h-full">
                <img :src="item.image" :alt="item.alt" class="object-cover w-full h-full max-h-screen" />
            </div>
        </div>
    </template>

    <!-- Šipky -->
    <button @click="current = (current - 1 + slides.length) % slides.length"
        class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition">
    <x-heroicon-o-chevron-left class="w-6 h-6" />
</button>
    </button>
    <button @click="current = (current + 1) % slides.length"
        class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition">
    <x-heroicon-o-chevron-right class="w-6 h-6" />
</button>

    <!-- Indikátory -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex space-x-2">
        <template x-for="(item, index) in slides" :key="index">
            <button @click="current = index"
                :class="{'bg-blue-400 w-6': current === index, 'bg-white/50 w-3': current !== index}"
                class="h-3 rounded-full transition-all"></button>
        </template>
    </div>
</div>

    @livewire('gallery')

<!-- Why Choose Us Section -->
@include('components.why-choose-us')
    <!-- Reviews Section (Now under the slider) -->

    @include('components.reviews')

@endsection

@push('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@latest/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.mySwiper', {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
            },
            loop: true,
        });
    </script>
@endpush
