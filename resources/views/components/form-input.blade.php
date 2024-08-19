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
'modelTypeLive'=>'model',
'formStyle' => '',
'labelStyle'=>'',
'inputStyle' => '',
'subMax' => 0,
'subMin' => 0

])

@php
    $classVariantInput = [
    'default' =>
    'peer py-3 px-4 block w-full bg-gray-100 border border-black/30 rounded-lg text-sm focus:border-blue-500
    focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent
    dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
    'errors' =>
    'peer py-3 px-4 block w-full bg-red-100 border border-red-400/30 rounded-lg text-sm focus:border-red-500
    focus:ring-red-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-red-700 dark:border-transparent
    dark:text-red-400 dark:placeholder-red-500 dark:focus:ring-red-600 ',
    ];

    $inputClass = $classVariantInput[$errors->has($name) ? 'errors' : 'default'];

    $type = match ($modelTypeLive) {
    "blur" => "wire:model.blur",
    "live" => "wire:model.live",
    "lazy" => "wire:model.lazy",
    "throttle"=>"wire:model.throttle",
    "defer"=>"wire:model.defer",
    default => "wire:model",
    };
@endphp

<div class="{{ $formStyle }} space-y-3">
    <div class="w-full space-y-3">
        @if ($labelOn)
            <label for="{{ $id }}"
                   class="{{$labelStyle}} block mb-2 text-sm font-medium dark:text-white">{{ $title }}</label>
        @endif

        <div x-data="{ showPassword: false }" class="relative">
            @if($setLeftIcon)
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    @if ($inputType == 'password')
                        <x-heroicon-c-lock-closed class="w-5 h-5 text-gray-500 dark:text-neutral-500"/>
                    @elseif($inputType == 'email')
                        <x-heroicon-s-user class="w-5 h-5 text-gray-500 dark:text-neutral-500"/>
                    @endif
                </div>
            @endif

            @if(@$inputType == "password")
                <input :type="showPassword ? 'text' : 'password'" id="{{ $id }}" name="{{ $name }}"
                       placeholder="{{ $placeholder }}" value="{{ $value }}"
                       class="{{ $inputStyle }} {{ $inputClass }} {{ $setLeftIcon ? 'pl-12' : '' }}" {{ $setDisable
                ? 'disabled' : '' }} {{ $setFocus ? 'autofocus' : '' }} {{ $isRequire ? 'required' : '' }}
                {{$type}}="{{$name}}" {{-- {{$modelLive ? 'wire:model.live' : 'wire:model.blur' }}="{{ $name }}" --}}
                wire:key="{{ $id }}" />
            @elseif($inputType == "datePicker")
                <input id="{{$name}}" name="{{ $name }}" type="text"
                       class="block w-full px-4 py-3 text-sm bg-gray-100 border rounded-lg peer border-black/30 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                       placeholder="{{$placeholder}}" wire:model="{{$name}}" value="{{ $value }}" wire:key="{{ $id }}"/>

                <script>
                    window.addEventListener("DOMContentLoaded", () => {
                        InstanceDate(
                            "{{$name}}",
                            {{$subMin}},
                            {{$subMax}}
                        );
                    })
                    window.addEventListener("livewire:init", () => {
                        Livewire.hook("morph.added", () => {
                            InstanceDate(
                                "{{$name}}",
                                {{$subMin}},
                                {{$subMax}}
                            );
                        })
                    })

                </script>

            @elseif($inputType == "textArea")
                <textarea
                    id="{{$id}}"
                    name="{{$name}}" rows="4"
                    placeholder="{{ $placeholder }}"
                {{ $setDisable? 'disabled' : '' }}
                {{ $setFocus ? 'autofocus' : '' }}
                {{ $isRequire ? 'required' : '' }}
                {{$type}}='{{$name}}'
                class="
                block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                "
                >
                {{$value}}
                </textarea>

            @else
                <input type="{{ $inputType }}" id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
                       value="{{$value}}"
                       class="{{ $inputStyle }} {{ $inputClass }} {{ $setLeftIcon ? 'pl-12' : '' }}" {{ $setDisable
                ? 'disabled' : '' }} {{ $setFocus ? 'autofocus' : '' }} {{ $isRequire ? 'required' : '' }}
                {{$type}}="{{ $name }}" {{-- {{$modelLive ? 'wire:model.live' : 'wire:model.blur' }}="{{ $name }}"
                --}} />
            @endif



            @if ($inputType == 'password')
                <button type="button"
                        class="absolute flex items-center justify-center w-8 h-8 p-1 transition-colors -translate-y-1/2 bg-transparent rounded-full inset-y-1/2 right-5 hover:bg-gray-300"
                        @click="showPassword = !showPassword">
                    <template x-if="showPassword">
                        <x-heroicon-s-eye class="w-6 h-6 text-gray-500 dark:text-neutral-500"/>
                    </template>
                    <template x-if="!showPassword">
                        <x-heroicon-o-eye-slash class="w-6 h-6 text-gray-500 dark:text-neutral-500"/>
                    </template>
                </button>
            @endif
        </div>
        @error($name) <span class="my-4 text-sm italic text-danger-700">{{ $message }}</span> @enderror
    </div>

</div>
