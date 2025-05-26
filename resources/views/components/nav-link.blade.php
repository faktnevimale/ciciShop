@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-2 pt-2 border-b-2 border-pink-400 dark:border-pink-600 text-sm font-medium <leading-8></leading-8> text-pink-500 dark:text-pink-100 focus:outline-none focus:border-pink-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-2 pt-2 border-b-2 border-transparent text-sm font-medium leading-5 text-pink-300 dark:text-pink-400 hover:text-pink-700 dark:hover:text-pink-200 hover:border-pink-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
