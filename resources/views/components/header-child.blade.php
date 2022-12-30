@props(['href'])

@php
    $isCurrent = '/' . Request::path() == $href;
    $style = $isCurrent ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium' : 'text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium';
@endphp
<a href={{ $href }} {{ $attributes->merge(['class' => $style]) }}>
    {{ $slot }}
</a>
