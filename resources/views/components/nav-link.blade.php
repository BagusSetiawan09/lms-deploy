@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center border-b-2 border-indigo-400 text-sm font-medium text-gray-900 leading-tight pb-0.5'
    : 'inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 leading-tight';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

