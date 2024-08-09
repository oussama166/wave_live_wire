@props([
    'name' => '',
    'id' => '',
    'title' => '',
    'placeholder' => '',
    'inputType' => 'text', // Default to text to handle password visibility
    'value' => '',
    'labelOn' => true,
    'isRequire' => false,
    'errorOn' => false,
    'setFocus' => false,
    'setIcon' => true,
    'setDisable' => false,
    'setLeftIcon' => false,
    'modelLive' => false,
    'formStyle' => '',
    'inputStyle' => '',
])

@php
    $classVariantInput = [
        'default' =>
            'peer py-3 px-4 block w-full bg-gray-100 border border-black/30 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
        'errors' =>
            'peer py-3 px-4 block w-full bg-red-100 border border-red-400/30 rounded-lg text-sm focus:border-red-500 focus:ring-red-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-red-700 dark:border-transparent dark:text-red-400 dark:placeholder-red-500 dark:focus:ring-red-600 ',
    ];

    $inputClass = $classVariantInput[$errors->has($name) ? 'errors' : 'default'];
@endphp

<div class="{{ $formStyle }} space-y-3">
    <div class="w-full space-y-3">
        @if ($labelOn)
            <label for="{{ $id }}"
                   class="block mb-2 text-sm font-medium dark:text-white">{{ $title }}</label>
        @endif

        <div x-data="{ showPassword: false }" class="relative">
            @if($setLeftIcon)
                <div
                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    @if ($inputType == 'password')
                        <x-heroicon-c-lock-closed class="h-5 w-5 text-gray-500 dark:text-neutral-500"/>
                    @elseif($inputType == 'email')
                        <x-heroicon-s-user class="h-5 w-5 text-gray-500 dark:text-neutral-500"/>
                    @endif
                </div>
            @endif

            @if(@$inputType == "password")
                <input
                    :type="showPassword ? 'text' : 'password'"
                    id="{{ $id }}"
                    name="{{ $name }}"
                    placeholder="{{ $placeholder }}" value="{{ $value }}"
                    class="{{ $inputStyle }} {{ $inputClass }} {{ $setLeftIcon ? 'pl-12' : '' }}"
                    {{ $setDisable ? 'disabled' : '' }}
                    {{ $setFocus ? 'autofocus' : '' }} {{ $isRequire ? 'required' : '' }}
                    {{$modelLive ? 'wire:model.live' : 'wire:model.blur'}}="{{ $name }}"
                    wire:key="{{ $id }}"
                />
            @else
                <input
                    type="{{ $inputType }}"
                    id="{{ $id }}"
                    name="{{ $name }}"
                    placeholder="{{ $placeholder }}" value="{{ $value }}"
                    class="{{ $inputStyle }} {{ $inputClass }} {{ $setLeftIcon ? 'pl-12' : '' }}"
                    {{ $setDisable ? 'disabled' : '' }}
                    {{ $setFocus ? 'autofocus' : '' }} {{ $isRequire ? 'required' : '' }}
                    {{$modelLive ? 'wire:model.live' : 'wire:model'}}="{{ $name }}"
                    wire:key="{{ $id }}"
                />
            @endif



            @if ($inputType == 'password')
                <button type="button"
                        class="absolute inset-y-1/2 -translate-y-1/2 right-5 flex items-center justify-center w-8 h-8 bg-transparent hover:bg-gray-300 rounded-full p-1 transition-colors"
                        @click="showPassword = !showPassword">
                    <template x-if="showPassword">
                        <x-heroicon-s-eye class="h-6 w-6 text-gray-500 dark:text-neutral-500"/>
                    </template>
                    <template x-if="!showPassword">
                        <x-heroicon-o-eye-slash class="h-6 w-6 text-gray-500 dark:text-neutral-500"/>
                    </template>
                </button>
            @endif
        </div>
        @error($name) <span class="text-sm italic text-danger-700 my-4">{{ $message }}</span> @enderror
    </div>
</div>
