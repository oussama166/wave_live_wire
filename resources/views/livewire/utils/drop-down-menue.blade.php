<div x-data="{ dropdownOpen: false }" class="relative">
    <button
        @click="dropdownOpen = !dropdownOpen"
        class="{{$customStyleButton}} inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors  border rounded-md  focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        {{$title}}
    </button>

    <div x-show="dropdownOpen"
         @click.away="dropdownOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-56 bg-white border rounded-md shadow-lg z-[100]"
         x-cloak>
        <div class="p-1 text-sm bg-white border rounded-md shadow-md border-neutral-200/70 text-neutral-700">
            <a href="#"
               class="relative flex justify-between w-full cursor-pointer select-none items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none">
                <span>New Tab</span>
            </a>
            <a href="#"
               class="relative flex justify-between w-full cursor-pointer select-none items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none">
                <span>New Window</span>
            </a>
            <a href="#"
               class="relative flex justify-between w-full cursor-pointer select-none items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none">
                <span>New Window</span>
            </a>
        </div>
    </div>
</div>
