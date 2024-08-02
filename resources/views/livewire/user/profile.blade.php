<div class="flex flex-row flex-wrap gap-5 content">
    <form method="post" wire:submit='updateProfile'>
        @csrf
        <section
            class="flex flex-wrap items-center justify-center w-full gap-5 p-8 bg-white border border-gray-300 shadow-lg rounded-xl font-Inter">
            <input type="hidden" id="id" name="id" value="{{ auth()->user()->id }}" />
            <x-form-input name="cin" id="cin" title="CIN"
                placeholder="Insert your Corporate Identification Number" input-type="text"
                value="{{ auth()->user()->cin }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full"
                :set-disable="true" />
            <x-form-input name="cnss" id="cnss" title="CNSS"
                placeholder="Insert your Caisse Nationale de Sécurité Sociale" input-type="text"
                value="{{ auth()->user()->cnss }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                :set-disable="true" />
            <x-form-input name="name" id="name" title="Name" placeholder="Insert your first name"
                input-type="text" value="{{ auth()->user()->name }}" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full" />
            <x-form-input name="lastname" id="lastname" title="Last Name" placeholder="Insert your last name"
                input-type="text" value="{{ auth()->user()->lastname }}" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " />
            <x-form-input name="role" id="role" title="Role" placeholder="Select you role" input-type="text"
                value="{{ auth()->user()->role }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                :set-disable="true" />
            <x-form-input name="email" id="email" title="Email" placeholder="insert you email" input-type="text"
                value="{{ auth()->user()->email }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                :set-disable="true" />
            <x-form-input name="birth_date" id="birth_date" title="Birth date" placeholder="insert you birth date"
                input-type="text" value="{{ auth()->user()->birth_date }}" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="hiring_date" id="hiring_date" title="Hiring date" placeholder="insert you hiring date"
                input-type="text" value="{{ auth()->user()->hiring_date }}" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="sexe" id="sexe" title="Gender" placeholder="Choice your gender"
                input-type="text" value="{{ auth()->user()->sexe }}" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="phone" id="phone" title="Phone number" placeholder="insert your phone number"
                input-type="text" value="{{ auth()->user()->phone }}" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="adresse" id="adresse" title="Address" placeholder="insert your adress"
                input-type="text" value="{{ auth()->user()->adresse }}" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="salary" id="salary" title="Salary" placeholder="insert your salary"
                input-type="text" value="{{ auth()->user()->salary }} DH" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="experience_level_id" id="experience_level_id" title="Experience level"
                placeholder="Choice your experience level" input-type="text" value="{{ $getExperienceLevels }} "
                :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="position_id" id="position_id" title="Position"
                placeholder="Choice your experience level" input-type="text" value="{{ $getPosition }} "
                :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="nationality_id" id="nationality_id" title="Nationality"
                placeholder="Choice your experience level" input-type="text" value="{{ $getNationality }}"
                :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="family_status_id" id="family_status_id" title="Family status"
                placeholder="Choice your experience level" input-type="text" value="{{ $getFamilyStatus }}"
                :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="contract_id" id="contract_id" title="Contract"
                placeholder="Choice your experience level" input-type="text" value="{{ $getContracts }}"
                :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="balance" id="balance" title="Leave balance"
                placeholder="Choice your experience level" input-type="text" value="{{ auth()->user()->balance }}"
                :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <section class="flex items-center justify-center w-full">
                <x-form-button type="submit" value="Submit" custom-class="max-w-sm w-[300px]" />
            </section>
        </section>
    </form>

</div>
