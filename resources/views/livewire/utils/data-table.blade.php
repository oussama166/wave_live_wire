<section class="w-full">
    {{-- Start Search section --}}
    @if ($this->searchOn != false)
    <div class="flex items-center justify-between gap-5 my-5">
        <input type="text" wire:model.blur="search"
            class="w-3/4 px-5 py-3 text-sm bg-white rounded-md shadow-sm focus:outline-none"
            placeholder="Search by name, role, phone, or position" />


        <button wire:click="resetSearch"
            class="flex items-center justify-center px-5 py-3 text-xs text-gray-500 hover:text-gray-700">
            Clear Search
        </button>
    </div>
    @endif
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
            @forelse ($data as $value)
            @if($type == 'staic')
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
                        :wire:key="$key" :keyValue="$value->id" />
                </td>
                @endif
            </tr>
            @endif

            @if($type == 'dynamic')
            <tr>
                @foreach ($extractKey as $key)
                @if(is_array($key))
                @foreach ($key as $relation => $attribute)
                <td class="px-5 py-4 space-y-1 text-sm font-semibold whitespace-nowrap">
                    {{ $value->{$relation}->{$attribute} }}
                </td>
                @endforeach
                @else
                @if($key == "created_at")
                @php
                $formattedDate = \Illuminate\Support\Carbon::parse($value->{$key})->format('Y-m-d');
                @endphp
                <td class="px-5 py-4 space-y-1 text-sm font-semibold whitespace-nowrap">
                    {{ $formattedDate }}
                </td>
                @else
                <td class="px-5 py-4 space-y-1 text-sm font-semibold whitespace-nowrap">
                    {{ $value->{$key} }}
                </td>
                @endif
                @endif
                @endforeach
            </tr>


            {{-- <td class="px-5 py-4 space-y-1 text-sm font-semibold whitespace-nowrap">
                {{ json_decode($value->new_values,true)["salary"] }}
            </td>
            <td class="px-5 py-4 space-y-1 text-sm font-semibold whitespace-nowrap">
                {{$value->Audit }}
            </td> --}}

            @endif
            @empty
            <tr>
                <td colspan="{{ count($headers) }}" class="py-4 text-center text-gray-500">No data available</td>
            </tr>
            @endforelse
        </tbody>

        <tfoot>
            <tfoot>
                <tr>
                    <td wire:loading colspan="6" wire:loading.class="text-center">Loading...</td>

                </tr>
            </tfoot>
        </tfoot>
    </table>
    @if ($this->paginationArea != false)
    <div class="inline-flex items-center w-full min-w-full gap-2 mx-2 my-5">
        <select wire:model.live="perPage" class="flex-grow-0">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
        </select>
        {{ $data->links() }}
    </div>
    @endif
</section>
