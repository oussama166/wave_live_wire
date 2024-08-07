<div class="content">
    <section class="w-full p-5 bg-white border rounded-lg content">
        {{-- Make the request to create a new vacation --}}
        <form class="flex flex-wrap flex-grow flex-shrink-0 w-full gap-5" wire:submit.prevent="createVacationRequest">
            @csrf
            {{-- Date picker for start and end date --}}
            <livewire:utils.form-date-picker/>

            {{-- Vacation type dropdown and info section --}}
            <div
                    class="flex flex-wrap items-center justify-between w-full gap-5"
            >
                <livewire:utils.dropdown label="List of vacations" :data="$vacationTypes" :wire:key="$vacationType"/>

                <div class="relative flex-shrink-0 order-last w-full max-w-lg p-3 border rounded-lg bg-gray-50 px-5"
                     x-data="{ selectedVacationType: @entangle('vacationInfo') }"
                     x-show="selectedVacationType != null"
                >

                    <x-phosphor-x-circle-bold
                            class="absolute w-5 cursor-pointer top-4 right-4"
                            @click="selectedVacationType = null;"
                    />

                    <input type="hidden" name="vacation_type_id" :value="idVacation"/>
                    <div class="space-y-3">
                        <p class="text-center" x-text="selectedVacationType.label"></p>
                        <p class="text-center" x-text="selectedVacationType.description"></p>


                        <div class="w-full flex flex-row gap-5 flex-nowrap justify-end px-5">
                            {{-- left side--}}
                            <div class="w-1/2 flex items-center">

                                <div class="inline-flex  gap-1 items-center">
                                <span x-show="selectedVacationType.isPaid"><x-tabler-currency-dollar
                                            class="text-green-600"/></span>
                                    <span x-show="!selectedVacationType.isPaid"><x-tabler-currency-dollar-off
                                                class="text-danger-600"/></span>
                                </div>

                                <div class="inline-flex  gap-1 items-center" x-show="selectedVacationType.isPaid">
                                    <span x-text="selectedVacationType.reduction"></span>%
                                </div>

                            </div>

                            {{-- Right side--}}
                            <div class="inline-flex gap-1 items-end w-1/2">
                                <x-tabler-calendar-share/> {{" "}}<span x-text="selectedVacationType.duration"></span>
                                max-days
                            </div>
                        </div>
                    </div>
                </div>


                <x-form-input
                        name="description"
                        id="description"
                        title="Description"
                        placeholder="Add the reason why you want this vacation"
                        input-type="text-area"
                        form-style="max-w-lg w-full"
                        :is-require="true"

                />
            </div>
            <x-form-button type="submit" value="Submit" customClass="my-5"/>
        </form>
    </section>
</div>
