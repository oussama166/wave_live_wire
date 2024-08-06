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


                <x-form-input name="description" id="description" title="Description"
                    placeholder="Add the reason why you want this vacation" input-type="text-area" :is-require="true"
                    form-style="max-w-lg w-full" />
            </div>
            <x-form-button type="submit" value="Submit" customClass="my-5" />
        </form>
    </section>
</div>
