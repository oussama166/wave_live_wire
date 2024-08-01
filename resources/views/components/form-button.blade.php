@props([
    'buttonType' => 'default',
    'type' => 'button',
    'tag' => 'button',
    'isDisable' => false,
    'value' => '',
    'customClass' => '',
])


@php
    $classValueVariants = [
        'default' =>
            'w-full  py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none peer',
        'icon' =>
            'w-full  py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border disabled:opacity-50 disabled:pointer-events-none peer',
    ];
@endphp
@if ($tag == 'button')
    <button type="{{ $type }}" class="{{ $customClass }} {{ $classValueVariants[$buttonType] }}"
        {{ $attributes }}>
        {{ $value }}
        {{ $slot }}

    </button>
@endif
@if ($tag == 'link')
    <a class="{{ $classValueVariants[$buttonType] }} {{ $customClass }}" {{ $attributes }}>
        {{ $value }}
        {{ $slot }}
    </a>
@endif
