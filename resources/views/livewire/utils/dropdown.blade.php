<div class="w-full max-w-lg">
    <label class="block mb-2 text-base font-medium dark:text-white">{{ $label }}</label>
    <p>{{$selectedItem}}</p>
    <select
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        wire:model.live="$parent.vacationType"
    >
        <option value="">
            {{ $label  }}
        </option>
        @foreach ($data as $item)
            @if($item->$label === $selectedItem && $selectedItem != '')
                <option wire:key="choice-{{ $item->id }}" value="{{ $item->label }}"
                        selected>{{ $item->label }}</option>
            @else
                <option wire:key="choice-{{ $item->id }}" value="{{ $item->label }}"
                >{{ $item->label }}</option>
            @endif
        @endforeach
    </select>
</div>
