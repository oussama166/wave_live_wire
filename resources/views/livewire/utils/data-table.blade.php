<section class="w-full overflow-x-hidden">
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
    <table class="min-w-full overflow-x-hidden divide-y divide-neutral-200">
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
        <tbody class="overflow-hidden divide-y divide-neutral-200" wire:loading.class="hidden">
            @forelse ($data as $value)
            @if($type == 'static')
            <tr class="font-semibold text-primary-700 hover:bg-primary-300/10 ">
                <td class="px-5 py-4 space-y-1 text-sm font-semibold cursor-pointer whitespace-nowrap">
                    <span>{{ $value->name }} {{ $value->lastname }}</span>
                    <h1 class="text-xs text-wave-disable">{{ $value->role }}</h1>
                </td>
                <td class="px-5 py-4 space-y-1 text-sm font-semibold cursor-pointer whitespace-nowrap">
                    <span>{{ $value->phone }}</span>
                </td>
                <td class="px-5 py-4 space-y-1 text-sm font-semibold cursor-pointer whitespace-nowrap">
                    <span>{{ $value->position->label ?? 'N/A' }}</span>
                    <h1 class="text-xs text-wave-disable">{{ $value->experienceLevel->label ?? 'N/A' }}</h1>
                </td>
                <td class="px-5 py-4 space-y-1 text-sm font-semibold cursor-pointer whitespace-nowrap">
                    <span>{{ $value->contracts->label ?? 'N/A' }}</span>
                </td>
                <td class="px-5 py-4 space-y-1 text-sm font-semibold cursor-pointer whitespace-nowrap">
                    <span>{{ $value->salary }} Dh</span>
                </td>

                @if ($actionOn)
                <td class="px-5 py-4 text-sm font-semibold text-left whitespace-nowrap text-ellipsis">
                    <livewire:utils.drop-down-menue title="Action"
                        custom-style-button="max-w-sm w-full bg-primary-400 text-center px-10 py-2 rounded-xl text-white hover:bg-primary-400/70 focus:bg-primary-400/70 active:bg-primary-400/80 focus:ring-primary-400/60 transition duration-150 ease-in-out"
                        :wire:key="$key" :keyValue="$value->id" />
                </td>
                @endif
            </tr>
            @elseif($type == 'dynamic')
            <tr @click="window.location.href='/admin/vacationRequest/edit/{{$value->id}}'"
                class="font-semibold cursor-pointer text-primary-700 hover:bg-primary-300/10">
                @foreach ($extractKey as $key)
                @if(is_array($key))
                @foreach ($key as $relation => $attributes)
                {{-- Handle case where we need to make this row contain multiple values --}}
                @if(is_array($attributes))
                {{-- Initialize an array to collect attribute values --}}
                @php
                $values = [];
                @endphp
                <td class="max-w-md px-5 py-4 text-sm font-semibold text-left whitespace-nowrap text-ellipsis">
                    @foreach ($attributes as $attribute)
                    @php
                    $valueAttribute = $value->$relation->$attribute ?? 'N/A';
                    $values[] = $valueAttribute;
                    @endphp
                    @endforeach
                    {{-- Concatenate values with a separator (e.g., ', ') --}}
                    {{ implode(' ', $values) }}
                </td>
                @else
                {{-- Handle special cases --}}
                @if($relation == "leaveStatus")
                @php
                $status = $value->leaveStatus->label ?? 'Unknown';

                $statusClass = match ($status) {
                'Rejected' => 'bg-red-500',
                'Approved' => 'bg-green-500',
                'Pending' => 'bg-yellow-400',
                default => '',
                };
                @endphp

                <td class="max-w-md px-5 py-4 text-sm font-semibold text-left whitespace-nowrap text-ellipsis">
                    <span class="text-white rounded-2xl px-2 py-1 font-semibold {{ $statusClass }}">
                        {{ $status }}
                    </span>
                </td>
                @else
                <td class="max-w-md px-5 py-4 text-sm font-semibold text-left whitespace-nowrap text-ellipsis">
                    {{ $value->$relation->$attributes ?? 'N/A' }}
                </td>
                @endif
                @endif
                @endforeach
                @else
                @if($key == "created_at")
                @php
                $formattedDate = \Illuminate\Support\Carbon::parse($value->{$key})->format('Y-m-d');
                @endphp
                <td class="max-w-md px-5 py-4 text-sm font-semibold text-left whitespace-nowrap text-ellipsis">
                    {{ $formattedDate }}
                </td>
                @elseif($key == "leaves_days")
                <td class="max-w-md px-5 py-4 text-sm font-semibold text-left whitespace-nowrap text-ellipsis">
                    {{ $value->{$key} }} days
                </td>
                @else
                <td class="max-w-md px-5 py-4 text-sm font-semibold text-left whitespace-nowrap text-ellipsis">
                    {{ $value->{$key} ?? 'N/A' }}
                </td>
                @endif
                @endif
                @endforeach
                @if($actionOn)
                <td class="max-w-md px-5 py-4 text-sm font-semibold text-left whitespace-nowrap text-ellipsis">
                    @php
                    $holidayCounter = detect_holiday(new DateTime($value->start_at), new DateTime($value->end_at));
                    @endphp
                    {{ $holidayCounter }} days
                </td>
                @endif
            </tr>
            @endif
            @empty
            <tr>
                <td colspan="{{ count($headers) }}" class="py-4 text-center text-gray-500">No data available</td>
            </tr>
            @endforelse

        </tbody>

        <tfoot>
            <tr class="text-center">
                <td wire:loading colspan="6" wire:loading.class="text-center">Loading...</td>

            </tr>
        </tfoot>
    </table>
    @if ($this->paginationArea != false)
    <div class="inline-flex items-center w-full min-w-full gap-2 my-5">
        <select wire:model.live="perPage"
            class="flex-grow-0 px-3 py-2 ml-3 border border-gray-300 rounded-md shadow-sm ">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
        </select>
        {{ $data->links() }}
    </div>
    @endif

</section>
