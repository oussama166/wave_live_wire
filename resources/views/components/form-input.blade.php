@props([
    'name' => '',
    'id' => '',
    'title' => '',
    'placeholder' => '',
    'inputType' => '',
    'value' => '',
    'labelOn' => true,
    'isRequire' => false,
    'errorOn' => false,
    'setFocus' => false,
    'setIcon' => true,
    'setDisable' => false,
    'modelLive' => false,
    'formStyle' => '',
    'inputStyle' => '',
])

@php
    $classVariantInput = [
        'default' =>
            'peer py-3 px-4 ps-5 block w-full bg-gray-100 border border-black/30 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
        'errors' =>
            'peer py-3 px-4 ps-5 block w-full bg-red-100 border border-red-400/30 rounded-lg text-sm focus:border-red-500 focus:ring-red-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-red-700 dark:border-transparent dark:text-red-400 dark:placeholder-red-500 dark:focus:ring-red-600 ',
    ];

    $inputClass = $classVariantInput[$errorOn ? 'errors' : 'default'];
@endphp

<div class="{{ $formStyle }} space-y-3">
    <div class="w-full space-y-3">
        @if ($labelOn)
            <label for="{{ $id }}"
                class="block mb-2 text-sm font-medium dark:text-white">{{ $title }}</label>
        @endif

        <div class="relative">
            <input type="{{ $inputType }}" id="{{ $id }}" name="{{ $name }}"
                placeholder="{{ $placeholder }}" value="{{ $value }}"
                class="{{ $inputStyle }} {{ $inputClass }}" {{ $setDisable ? 'disabled' : '' }}
                {{ $setFocus ? 'autofocus' : '' }} {{ $isRequire ? 'required' : '' }}
                {{ $modelLive ? 'wire:model.live' : 'wire:model.live' }}="{{ $name }}" />
            <div
                class="absolute inset-y-0 flex items-center pointer-events-none end-0 pe-5 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                @if ($inputType == 'password' && $setIcon)
                    <x-heroicon-c-lock-closed class="flex-shrink-0 text-gray-500 size-4 dark:text-neutral-500" />
                @elseif($inputType == 'email' && $setIcon)
                    <x-heroicon-s-user class="flex-shrink-0 text-gray-500 size-4 dark:text-neutral-500" />
                @endif
            </div>
        </div>

    </div>
</div>
