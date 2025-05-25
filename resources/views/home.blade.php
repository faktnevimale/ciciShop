@extends('layouts.app')
@php
    $slides = [
        [
            'title' => 'Vítej v říši Hello Kitty!',
            'description' => 'Roztomilost začíná právě tady.',
            'image' => asset('images/dm.png'),
            'alt' => 'engineLight',
            'link' => '/products',
        ],
        [
            'title' => 'Tady růžová nikdy nekončí!',
            'description' => 'Hello Kitty ví, co Vám rozzáří den.',
            'image' => asset('images/dmv2.png'),
            'alt' => 'headGasket',
            'link' => '/products',
        ],
        [
            'title' => 'Mašličky, třpytky, roztomilost. To je náš svět.',
            'description' => 'A teď už i Váš.',
            'image' => asset('images/dm4.png'),
            'alt' => 'catalyticConverter',
            'link' => '/products',
        ],
    ];
@endphp
@section('content')
<!-- Hero Section Fullscreen Split Left-Right -->
<div x-data="{ current: 0, slides: {{ json_encode($slides) }} }" x-init="setInterval(() => current = (current + 1) % slides.length, 5000)" class="relative min-h-screen bg-pink-100 text-pink-300 overflow-hidden">
    <template x-for="(item, index) in slides" :key="index">
        <div x-show="current === index" class="absolute inset-0 transition-opacity duration-1000 ease-in-out flex flex-col md:flex-row items-center justify-between z-10">
            <!-- Text vlevo -->
            <div class="w-full md:w-1/2 text-center md:text-left flex justify-center md:justify-start items-center p-8 md:p-16 z-20">
                <div>
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 font-['BebasNeue', sans-serif]" x-text="item.title"></h1>
                    <p class="text-lg md:text-xl mb-8 font-light" x-text="item.description"></p>
                    <a :href="item.link" class="inline-block bg-pink-400 text-white font-semibold py-3 px-6 rounded-lg hover:bg-pink-300 transition">
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
        class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-pink-100 text-white p-2 rounded-full hover:bg-pink-250 transition">
    <x-heroicon-o-chevron-left class="w-6 h-6" />
</button>
    </button>
    <button @click="current = (current + 1) % slides.length"
        class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-pink-100 text-white p-2 rounded-full hover:bg-pink-250 transition">
    <x-heroicon-o-chevron-right class="w-6 h-6" />
</button>

    <!-- Indikátory -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex space-x-2">
        <template x-for="(item, index) in slides" :key="index">
            <button @click="current = index"
                :class="{'bg-pink-400 w-6': current === index, 'bg-pink-300 w-3': current !== index}"
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
