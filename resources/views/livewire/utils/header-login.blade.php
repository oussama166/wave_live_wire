<section
    class="max-w-[77vw] w-full max-h-[80px] h-full flex justify-between mt-10 px-10  fixed top-10 z-10"
    id="header"
>
    {{--  THIS IS FOR THE   --}}
    <div id="header-info" class="flex flex-col gap-1 py-2">
        <div class="text-sm font-normal tracking-wide text-wave-disable">
            <h1>{{ parse_url($path)['path'] }}</h1>

        </div>
        <div class="text-4xl font-semibold tracking-wide text-wave-primary">
            <h1>{{ $title }}</h1>
        </div>
    </div>

    {{-- THIS IS FOR THE USER INFORMATION AS NOTIFICATION / BALANCE / USER NAME INFO / LOGOUT --}}
    <div id="header-user" class="flex items-center gap-5">
        {{-- > Notification --}}
        <div class="relative p-3 bg-white rounded-full cursor-pointer">
            <x-phosphor-bell-simple-fill class="w-5 text-[#aab4d4]"/>
            <span class="absolute w-2 h-2 bg-red-600 rounded-full top-2 right-2"></span>
        </div>
        {{-- Notification < --}}

        <div class="p-4 bg-white rounded-full">
            <span
                class="text-[#aab4d4]  inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:w-px before:h-6 before:bg-gray-300 before:rounded-sm dark:text-neutral-400 dark:before:bg-neutral-600">
                {{ $balance }} Balance
            </span>
            <span class="text-black/40">{{ $name }}</span>
        </div>

        <form method="POST" wire:submit='logout'>
            @csrf
            <button type="submit" class="flex items-center justify-center p-3 bg-white rounded-full cursor-pointer">
                <x-tabler-logout class="w-5 text-[#aab4d4] text-lg"/>
            </button>
        </form>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", () => {

            InitGsap();
        });
    </script>
</section>
