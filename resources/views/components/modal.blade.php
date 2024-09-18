@props(['title'])

<div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" :class="{ 'z-40': modalOpen }"
    class="relative">
    {{-- <button @click="modalOpen = true"
        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-offset-2">
        Open
    </button> --}}
    {{ $trigger }}

    <template x-teleport="body">
        <div x-show="modalOpen" class="fixed inset-0 z-40 flex items-center justify-center w-full h-full" x-cloak>
            <!-- Backdrop with glass effect -->
            <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen = false"
                class="absolute inset-0 bg-white bg-opacity-20 backdrop-blur-lg"></div>

            <!-- Modal content -->
            <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                class="relative p-6 bg-white rounded-lg shadow-lg sm:max-w-lg">
                <div class="flex items-center justify-between pb-4 border-b">
                    <h3 class="text-lg font-semibold">{{ $title }}</h3>
                    <button @click="modalOpen = false"
                        class="flex items-center justify-center w-8 h-8 text-gray-500 rounded-full hover:bg-gray-100 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                {{ $body }}
                {{-- <div class="flex flex-col mt-6 space-y-2 sm:flex-row sm:justify-end sm:space-y-0 sm:space-x-3">
                    <button @click="modalOpen = false"
                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-gray-700 border rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-offset-2">
                        Cancel
                    </button>
                    <button @click="modalOpen = false"
                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2">
                        Continue
                    </button>
                </div> --}}
            </div>
        </div>
    </template>
</div>
