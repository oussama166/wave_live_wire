<section class="w-full">
    <table class="min-w-full divide-y divide-neutral-200">
        <thead>
        <tr class="text-neutral-500">
            @foreach($headers as $header)
                <th class="px-5 py-3 text-sm font-medium text-left uppercase">{{$header}}</th>
            @endforeach
            @if($actionOn)
                <th class="px-5 py-3 text-sm font-medium text-left uppercase">Actions</th>
            @endif
        </tr>
        </thead>
        <tbody class="divide-y divide-neutral-200" wire:loading.class="hidden">
        @foreach($data as $value)
            <tr class="text-primary-700 font-semibold  hover:bg-primary-300/10">
                <td class="px-5 py-4 text-sm font-semibold whitespace-nowrap space-y-1">
                    <span>{{$value->name}} {{$value->lastname}}</span>
                    <h1 class="text-wave-disable text-xs">{{$value->role}}</h1>
                </td>
                <td class="px-5 py-4 text-sm font-semibold whitespace-nowrap space-y-1">
                    <span>{{$value->phone}}</span>
                </td>
                <td class="px-5 py-4 text-sm font-semibold whitespace-nowrap space-y-1">
                    <span>{{$value->position->label}}</span>
                    <h1 class="text-wave-disable text-xs">{{$value->experienceLevel->label}}</h1>
                </td>
                <td class="px-5 py-4 text-sm font-semibold whitespace-nowrap space-y-1">
                    <span>{{$value->contracts->label}}</span>

                </td>
                <td class="px-5 py-4 text-sm font-semibold whitespace-nowrap space-y-1">
                    <span>{{$value->salary}} Dh</span>
                </td>

                @if($actionOn)
                    <td class="px-5 py-4 text-sm font-semibold text-left whitespace-nowrap">
                        <livewire:utils.drop-down-menue
                            title="Action"
                            custom-style-button="max-w-sm w-full bg-primary-400 text-center px-10 py-2 rounded-xl text-white hover:bg-primary-400/70 focus:bg-primary-400/70 active:bg-primary-400/80 focus:ring-primary-400/60  transition duration-150 ease-in-out"
                            :wire:key="$key"
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
    <div class="min-w-full w-full my-4 mx-2 inline-flex items-center gap-2">
        <select wire:model.live="perPage" class="flex-grow-0">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
        </select>
        {{$data->links()}}
    </div>

</section>
