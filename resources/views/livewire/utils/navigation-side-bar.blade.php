<section class="w-[20vw] h-screen bg-white border rounded-r-[50px] shadow-2xl fixed left-0 top-0 flex flex-col my-auto"
    id="sidebar">

    {{-- > header --}}
    <div id="logo" class="w-full max-h-[150px] h-full flex items-center justify-center">
        <img src="{{ url('/assets/wave.svg') }}" alt="logo of wave" class="w-1/2" />
    </div>
    {{-- header < --}}
    <div class="w-full h-full">
        <ul class="flex flex-col w-full divide-y-2 divide-gray-100 ">
            <a wire:navigate. href="/user-dashboard">
                <li class="px-5 py-3 flex gap-2 items-center justify-start text-xl text-[#aab4d4] hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer aria-checked:bg-[#1c5daf] aria-checked:text-white"
                    aria-checked="{{ $active == '/user-dashboard' ? 'true' : 'false' }}">
                    <x-ri-dashboard-line class="w-7" />
                    Dashboard
                </li>
            </a>
            <a wire:navigate href="/profile">
                <li class="
                px-5 py-3 flex gap-2 items-center justify-start text-xl text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-[#1c5daf] aria-checked:text-white
                "
                    aria-checked="{{ $active == '/profile' ? 'true' : 'false' }}">
                    <x-heroicon-o-user class="w-7" />
                    Profile
                </li>
            </a>

            <a wire:navigate href="/vacationRequest/list" class="z-10">
                <div class="
                px-5 py-3 flex gap-2 items-center justify-start text-xl text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-[#1c5daf] aria-checked:text-white

                "
                    aria-checked="{{ Str::contains($active, '/vacationRequest') ? 'true' : 'false' }}">
                    <x-phosphor-calendar-blank-light class="w-7" />
                    Vacancy requests

                </div>

            </a>

            {{--    Sub menue   --}}
            <a wire:navigate href="/vacationRequest/list" id="item" class="z-0 hidden">
                <li class="
                w-full  px-5 py-3 flex gap-2 items-center justify-start text-xl text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-primary-300 aria-checked:text-white
                "
                    aria-checked="{{ $active === '/vacationRequest/list' ? 'true' : 'false' }}">
                    <x-phosphor-calendar-check-light class="w-7" />
                    My Vacations List
                </li>
            </a>
            <a wire:navigate href="/user-dashboard/vacationRequest/request" id="item" class="z-0 hidden">
                <li class="
                w-full px-5 py-3 flex gap-2 items-center justify-start text-xl text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-primary-300 aria-checked:text-white
                "
                    aria-checked="{{ $active === '/vacationRequest/request' ? 'true' : 'false' }}">
                    <x-phosphor-calendar-minus-light class="w-7" />
                    Request Vacation
                </li>
            </a>

            <a wire:navigate href="/user-dashboard/home">
                <li class="
                px-5 py-3 flex gap-2 items-center justify-start text-xl text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-[#1c5daf] aria-checked:text-white
                "
                    aria-checked="{{ $active == '/user-dashboard/settings' ? 'true' : 'false' }}">

                    <x-letsicon-setting-line class="w-7" />
                    Settings
                </li>
            </a>
        </ul>
    </div>

    <script>
        const drop = {{ Str::contains($active, '/vacationRequest') ? 'true' : 'false' }};
        document.addEventListener("DOMContentLoaded", () => {
            dropGsap(drop, "#item");
        });
    </script>

</section>
