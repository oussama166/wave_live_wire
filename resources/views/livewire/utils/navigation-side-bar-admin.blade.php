<section class="w-[20vw] h-screen bg-white border rounded-r-[50px] shadow-2xl fixed left-0 top-0 flex flex-col my-auto"
    id="sidebar">

    {{-- > header --}}
    <div id="logo" class="w-full max-h-[100px] h-full flex items-center justify-center">
        <img src="{{ url('/assets/wave.svg') }}" alt="logo of wave" class="w-1/2" />
    </div>
    {{-- header < --}}
    <div class="w-full h-full overflow-hidden">
        <ul class="flex flex-col w-full divide-y-2 divide-gray-100 overflow-hidden">
            <a wire:navigate href="/admin/dashboard">
                <li class="px-5 py-3 flex gap-2 items-center justify-start text-xl text-[#aab4d4] hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer aria-checked:bg-[#1c5daf] aria-checked:text-white"
                    aria-checked="{{ $active == '/admin/dashboard' ? 'true' : 'false' }}">
                    <x-ri-dashboard-line class="w-7" />
                    Dashboard
                </li>
            </a>
            <a wire:navigate href="/admin/profile">
                <li class="
                px-5 py-3 flex gap-2 items-center justify-start text-xl text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-[#1c5daf] aria-checked:text-white
                " aria-checked="{{ $active == '/admin/profile' ? 'true' : 'false' }}">
                    <x-heroicon-o-user class="w-7" />
                    Profile
                </li>
            </a>
            <a wire:navigate href="/admin/users">
                <li class="
                px-5 py-3 flex gap-2 items-center justify-start text-xl text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-[#1c5daf] aria-checked:text-white
                "
                    aria-checked="{{ ($active == '/admin/users' || Str::contains($active, '/admin/users')) ? 'true' : 'false' }}">
                    <x-heroicon-o-user-group class="w-7" />
                    Profiles
                </li>
            </a>

            <a wire:navigate href="/admin/vacationRequest/list" class="z-10">
                <div class="
                px-5 py-3 flex gap-2 items-center justify-start text-xl text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-[#1c5daf] aria-checked:text-white

                " aria-checked="{{ Str::contains($active,'/admin/vacationRequest') ? 'true' : 'false' }}">
                    <x-phosphor-calendar-blank-light class="w-7" />
                    Vacations

                </div>

            </a>




            <a wire:navigate href="/admin/settings/ContractType">
                <li class="
                px-5 py-3 flex gap-2 items-center justify-start text-xl text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-[#1c5daf] aria-checked:text-white
                " aria-checked="{{Str::contains($active,"/settings")  ? 'true' : 'false' }}">

                    <x-letsicon-setting-line class="w-7" />
                    Settings
                </li>
            </a>

            {{-- Sub menue --}}
            <a wire:navigate href="/admin/settings/ContractType" id="item" class="z-0 hidden">
                <li class="
                w-full  px-5 py-2 flex gap-2 items-center justify-start text-base text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-primary-300 aria-checked:text-white
                "
                    aria-checked="{{ $active === '/admin/settings/ContractType' ? 'true' : 'false' }}">
                    Contracts Types
                </li>
            </a>
            <a wire:navigate href="/admin/settings/holidays" id="item" class="z-0 hidden overflow-hidden">
                <li class="
                w-full px-5 py-2 flex gap-2 items-center justify-start text-base text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-primary-300 aria-checked:text-white
                "
                    aria-checked="{{ $active === '/admin/settings/holidays' ? 'true' : 'false' }}">
                    Holidays
                </li>
            </a>
            <a wire:navigate href="/vacationRequest/request" id="item" class="z-0 hidden">
                <li class="
                w-full px-5 py-2 flex gap-2 items-center justify-start text-base text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-primary-300 aria-checked:text-white
                "
                    aria-checked="{{ $active === '/vacationRequest/request' ? 'true' : 'false' }}">
                    Experience Levels
                </li>
            </a>
            <a wire:navigate href="/vacationRequest/request" id="item" class="z-0 hidden">
                <li class="
                w-full px-5 py-2 flex gap-2 items-center justify-start text-base text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-primary-300 aria-checked:text-white
                "
                    aria-checked="{{ $active === '/vacationRequest/request' ? 'true' : 'false' }}">
                    Family Status
                </li>
            </a>

            <a wire:navigate href="/vacationRequest/request" id="item" class="z-0 hidden">
                <li class="
                w-full px-5 py-2 flex gap-2 items-center justify-start text-base text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-primary-300 aria-checked:text-white
                "
                    aria-checked="{{ $active === '/vacationRequest/request' ? 'true' : 'false' }}">
                    Nationality
                </li>
            </a>
            <a wire:navigate href="/vacationRequest/request" id="item" class="z-0 hidden">
                <li class="
                w-full px-5 py-2 flex gap-2 items-center justify-start text-base text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-primary-300 aria-checked:text-white
                "
                    aria-checked="{{ $active === '/vacationRequest/request' ? 'true' : 'false' }}">
                    Position Type
                </li>
            </a>
            <a wire:navigate href="/vacationRequest/request" id="item" class="z-0 hidden overflow-hidden">
                <li class="
                w-full px-5 py-2 flex gap-2 items-center justify-start text-base text-[#aab4d4]
                hover:bg-[#1c5daf] hover:text-white transition-colors ease-in cursor-pointer
                aria-checked:bg-primary-300 aria-checked:text-white
                "
                    aria-checked="{{ $active === '/vacationRequest/request' ? 'true' : 'false' }}">
                    Vacation Type
                </li>
            </a>

            {{-- Sub menue --}}
        </ul>
        </div>


        <script>
            document.addEventListener("DOMContentLoaded", () => {
            const drop = {{ Str::contains($active, '/settings') ? 'true' : 'false' }};
            window.location.pathname.includes('/settings') ? dropGsap(drop, "#item") : null;
        });

        document.addEventListener("livewire:navigated", () => {
            const drop = {{ Str::contains($active, '/settings') ? 'true' : 'false' }};
            window.location.pathname.includes('/settings') ? dropGsap(drop, "#item") : null;
        });
        </script>


</section>
