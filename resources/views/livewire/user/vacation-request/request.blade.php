<div class="content">
    <section class="w-full p-5 bg-white border rounded-lg content">
        {{-- Make the request to create a new vacation --}}
        <form class="flex flex-wrap flex-grow flex-shrink-0 w-full gap-5" wire:submit.prevent="createVacationRequest">
            @csrf
            {{-- Date picker for start and end date --}}
            <livewire:utils.form-date-picker />

            {{-- Vacation type dropdown and info section --}}
            <div class="flex flex-wrap items-center justify-between w-full gap-5">
                <livewire:utils.dropdown label="List of vacations" :data="$vacationTypes" :wire:key="$vacationType"/>

                {{-- Display vacation info if a vacation type is selected --}}
                @if ($vacationTypes)
                <div
                class="relative flex-shrink-0 order-last w-full max-w-lg p-3 border rounded-lg bg-gray-50"
            >
                <x-phosphor-x-circle-bold
                    class="absolute w-5 cursor-pointer top-4 right-4"
                    @click="selectedVacationType = null;isOpen=false;"/>

                <input type="hidden" name="vacation_type_id" :value="idVacation"/>
                <div>
                    <p><strong>Vacation type:</strong> <span x-text="selectedVacationType.label"></span></p>
                    <p><strong>Description:</strong> <span x-text="selectedVacationType.description"></span></p>
                    <p><strong>Duration:</strong> <span x-text="selectedVacationType.duration"></span> days</p>
                    <p><strong>Paid:</strong> <span x-text="selectedVacationType.isPaid ? 'Yes' : 'No'"></span></p>
                    <p><strong>Reduction:</strong> <span x-text="selectedVacationType.reduction"></span>%</p>
                </div>
            </div>
                @endif


                <x-form-input name="description" id="description" title="Description"
                    placeholder="Add the reason why you want this vacation" input-type="text-area" :is-require="true"
                    form-style="max-w-lg w-full" />
            </div>
            <x-form-button type="submit" value="Submit" customClass="my-5" />
        </form>
    </section>
</div>
