<div class="w-full p-5 space-y-4 bg-white rounded-lg content font-Mulish">

    {{-- This form is to create a vacation for user --}}
    {{-- We need to select name of user --}}
    {{-- Proposition : type the name and the lastname of user after that we see all the info --}}
    <div class="w-full">
        <livewire:utils.drop-down-search label="Search user" :labelOn="true" />
    </div>
    <form class="flex flex-wrap justify-between flex-grow flex-shrink-0 w-full gap-5"
        wire:submit.prevent="createVacation" wire:loading.class="bg-gray-200">
        @if($selectedValue)
        <x-form-input name="name" id="name" title="Name" placeholder="Insert your first name" input-type="text"
            value="{{ $selectedValue->name }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full"
            :set-disable="true" />
        <x-form-input name="lastname" id="lastname" title="Last Name" placeholder="Insert your last name"
            input-type="text" value="{{ $selectedValue->lastname }}" :label-on="true"
            form-style="flex-shrink-0 max-w-lg w-full" :set-disable="true" />
        <x-form-input name="role" id="role" title="Role" placeholder="Select you role" input-type="text"
            value="{{ $selectedValue->role }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
            :set-disable="true" />
        <x-form-input name="email" id="email" title="Email" placeholder="insert you email" input-type="text"
            value="{{ $selectedValue->email }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
            :set-disable="true" />
        @endif
        <livewire:utils.form-date-picker />
        <livewire:utils.dropdown label="List of vacations" :data="$vacationTypes" :wire:key="$selectArea" />
        <x-form-input name="description" id="description" title="Description"
            placeholder="Add the reason why you want this vacation" input-type="text-area" form-style="max-w-lg w-full"
            :is-require="true" />
        <section class="flex items-center justify-center w-full">
            <x-form-button type="submit" value="Create Vaction" custom-class="max-w-sm w-[300px]" />
        </section>
    </form>

</div>
