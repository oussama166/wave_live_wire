<div class="w-full max-w-lg">
    <label for="countries" class="block mb-2 text-base font-medium dark:text-white">{{ $label }}</label>
    <select id="countries"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        wire:model.lazy="select"
        >
        @foreach ($data as $item)
            <option wire:key="choice-{{ $item->id }}" value="{{ $item->label }}">{{ $item->label }}</option>
        @endforeach
    </select>
    <div >Select : @json($select)</div>
</div>
