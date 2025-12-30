@props([
    'imageClass' => ''
])

<div {{ $attributes->merge(['class' => 'flex justify-center items-center gap-0']) }}>
    <x-azstore class="{{ $imageClass }}" />
    <span class="ml-2 font-semibold text-gray-800 text-xl">Az Store</span>
</div>