@php
    $modelLive =  match ($modelTypeLive) {
    "blur" => "wire:model.blur",
    "live" => "wire:model.live",
    default => "wire:model",
};

@endphp


<div class="w-full max-w-lg">
    <label class="block mb-2 text-base font-medium dark:text-white">{{ $label }}</label>
    <select
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        {{$modelLive}}="$parent.{{ $selectArea }}"
        >
        <option value="">
            {{ $label }}
        </option>

        @foreach ($data as $item => $value)
            <option wire:key="choice-{{ $selectArea }}-{{ $value['id'] }}" value="{{ $value['label'] }}"
                {{  $selectedItem == $value[$index]  ? 'selected' : '' }}>
                {{ $value['label'] }}
            </option>
        @endforeach
    </select>

</div>
