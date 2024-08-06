<div class="w-full">
    <div id="date-range-picker" class="flex items-center justify-between gap-5">
        <div class="relative w-full max-w-lg">
            <div class="absolute inset-y-0 flex items-center pointer-events-none top-7 start-0 ps-3">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>
            <label for="input-label"
                class="block mb-2 text-base font-medium dark:text-white">{{ $firstTitle }}</label>
            <input id="datepicker-range-start" name="{{ $firstModel }}" type="text"
                class="peer py-3 px-4 ps-10 block w-full bg-gray-100 border border-black/30 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600  border-gray-300 text-gray-900  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date start"
                wire:model.live="startAt"
                />
        </div>

        <div class="relative w-full max-w-lg">
            <div class="absolute inset-y-0 flex items-center pointer-events-none top-7 start-0 ps-3">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>
            <label for="input-label"
                class="block mb-2 text-base font-medium dark:text-white">{{ $secondTitle }}</label>
            <input id="datepicker-range-end" type="text"
                class="peer py-3 px-4 ps-10 block w-full bg-gray-100 border border-black/30 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600  border-gray-300 text-gray-900  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date end"
                wire:model.live="endAt"
                />
        </div>
    </div>

</div>

<script>
    window.addEventListener("DOMContentLoaded", () => {
        InstanceDatePicker()
    })
</script>
