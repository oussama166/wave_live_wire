<div class="content">
    <section class="w-full p-5 bg-white border rounded-lg content">
        {{-- Make the request to create a new vacation --}}
        <form class="flex flex-wrap flex-grow flex-shrink-0 w-full gap-5" wire:submit.prevent="createVacationRequest">

            @csrf
            {{-- Date picker for start and end date --}}
            <livewire:utils.form-date-picker />

            {{-- Vacation type dropdown and info section --}}
            <div class="flex flex-wrap items-center justify-between w-full gap-5">

                <livewire:utils.dropdown label="List of vacations" :data="$vacationTypes" :wire:key="$selectArea" />

                @if($vacationInfo!= null)
                <div class="relative flex-shrink-0 order-last w-full max-w-lg p-3 px-5 border rounded-lg bg-gray-50">
                    <x-phosphor-x-circle-bold class="absolute w-5 cursor-pointer top-4 right-4"
                        @click="selectedVacationType = null;" />

                    <input type="hidden" name="vacation_type_id" :value="idVacation" />
                    <div class="space-y-3">
                        <p class="text-center">{{$vacationInfo["label"]}}</p>
                        <p class="text-center">{{$vacationInfo["description"]}}</p>


                        <div class="flex flex-row justify-end w-full gap-5 px-5 flex-nowrap">
                            {{-- left side--}}
                            <div class="flex items-center w-1/2">

                                <div class="inline-flex items-center gap-1">
                                    @if($vacationInfo["isPaid"])
                                    <span>
                                        <x-tabler-currency-dollar class="text-green-600" />
                                    </span>
                                    <div class="inline-flex items-center gap-1">
                                        <span>{{$vacationInfo["reduction"]}}</span>%
                                    </div>
                                    @else
                                    <span>
                                        <x-tabler-currency-dollar-off class="text-danger-600" />
                                    </span>

                                    @endif
                                </div>

                            </div>

                            {{-- Right side--}}
                            <div class="inline-flex items-end w-1/2 gap-1">
                                <x-tabler-calendar-share /> {{" "}}<span>{{$vacationInfo["duration"]}}</span>
                                max-days
                            </div>
                        </div>
                    </div>
                </div>
                @endif


                <x-form-input name="description" id="description" title="Description"
                    placeholder="Add the reason why you want this vacation" input-type="text-area"
                    form-style="max-w-lg w-full" :is-require="true" />
            </div>
            <x-form-button type="submit" value="Submit" customClass="my-5" />
        </form>
    </section>
</div>
