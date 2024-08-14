<section class="w-full">
    {{-- Start Search section  --}}
    <div class="flex items-center justify-between gap-5">
        <input type="text" wire:model.blur="search"
            class="w-3/4 px-5 py-3 text-sm bg-white rounded-md shadow-sm focus:outline-none"
            placeholder="Search by name, role, phone, or position" />


        <button wire:click="resetSearch"
            class="flex items-center justify-center px-5 py-3 text-xs text-gray-500 hover:text-gray-700">
            Clear Search
        </button>

    </div>
    {{-- End Search section --}}
    <table class="min-w-full divide-y divide-neutral-200">
        <thead>
            <tr class="text-neutral-500">
                @foreach ($headers as $header)
                    <th class="px-5 py-3 text-sm font-medium text-left uppercase">{{ $header }}</th>
                @endforeach
                @if ($actionOn)
                    <th class="px-5 py-3 text-sm font-medium text-left uppercase">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody class="divide-y divide-neutral-200" wire:loading.class="hidden">
            @foreach ($data as $value)
                <tr class="font-semibold text-primary-700 hover:bg-primary-300/10">
                    <td class="px-5 py-4 space-y-1 text-sm font-semibold whitespace-nowrap">
                        <span>{{ $value->name }} {{ $value->lastname }}</span>
                        <h1 class="text-xs text-wave-disable">{{ $value->role }}</h1>
                    </td>
                    <td class="px-5 py-4 space-y-1 text-sm font-semibold whitespace-nowrap">
                        <span>{{ $value->phone }}</span>
                    </td>
                    <td class="px-5 py-4 space-y-1 text-sm font-semibold whitespace-nowrap">
                        <span>{{ $value->position->label }}</span>
                        <h1 class="text-xs text-wave-disable">{{ $value->experienceLevel->label }}</h1>
                    </td>
                    <td class="px-5 py-4 space-y-1 text-sm font-semibold whitespace-nowrap">
                        <span>{{ $value->contracts->label }}</span>

                    </td>
                    <td class="px-5 py-4 space-y-1 text-sm font-semibold whitespace-nowrap">
                        <span>{{ $value->salary }} Dh</span>
                    </td>

                    @if ($actionOn)
                        <td class="px-5 py-4 text-sm font-semibold text-left whitespace-nowrap">
                            <livewire:utils.drop-down-menue title="Action"
                                custom-style-button="max-w-sm w-full bg-primary-400 text-center px-10 py-2 rounded-xl text-white hover:bg-primary-400/70 focus:bg-primary-400/70 active:bg-primary-400/80 focus:ring-primary-400/60  transition duration-150 ease-in-out"
                                :wire:key="$key"
                                :keyValue="$value->id"
                                />
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tfoot>
                <tr>
                    <td wire:loading colspan="6" wire:loading.class="text-center">Loading...</td>

                </tr>
            </tfoot>
        </tfoot>
    </table>
    <div class="inline-flex items-center w-full min-w-full gap-2 mx-2 my-4">
        <select wire:model.live="perPage" class="flex-grow-0">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
        </select>
        {{ $data->links() }}
    </div>
</section>
