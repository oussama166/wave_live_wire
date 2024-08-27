<div class="flex flex-row flex-wrap gap-5 content">
    <form method="post" wire:submit.prevent='addEmployer'>
        @csrf
        <section
            class="flex flex-wrap items-center justify-center w-full gap-5 p-8 bg-white border border-gray-300 shadow-lg rounded-xl font-Inter">
            <div class="w-full min-w-full">
                <x-form-button tag="link" value="Back to employers list"
                    custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out"
                    href="/admin/users" />

            </div>
            <input type="hidden" id="id" name="id" value="{{ auth()->user()->id }}" />
            <x-form-input name="addForm.cin" id="addForm.cin" title="CIN"
                placeholder="Insert your Corporate Identification Number" input-type="text" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full" :set-disable="false" />
            <x-form-input name="addForm.cnss" id="addForm.cnss" title="CNSS"
                placeholder="Insert your Caisse Nationale de Sécurité Sociale" input-type="text" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />
            <x-form-input name="addForm.name" id="addForm.name" title="Name" placeholder="Insert your first name"
                input-type="text" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full" />
            <x-form-input name="addForm.lastname" id="addForm.lastname" title="Last Name"
                placeholder="Insert your last name" input-type="text" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " />


            <x-form-input name="addForm.birth_date" id="addForm.birth_date" title="Birth date"
                placeholder="insert you birth date" input-type="datePicker" form-style="flex-shrink-0 max-w-lg w-full "
                :sub-min="60" :sub-max="21" :label-on="true" :set-disable="false" />


            <x-form-input name="addForm.hiring_date" id="addForm.hiring_date" title="Hiring date"
                placeholder="insert you hiring date" input-type="datePicker" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full" :set-disable="false" />
            <livewire:utils.dropdown label="Role" :data="$this->getRole" index="label" select-area="addForm.role"
                :wire:key="$selectArea" />
            <x-form-input name="addForm.email" id="addForm.email" title="Email" placeholder="insert you email"
                input-type="text" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />

            <livewire:utils.dropdown label="Gender" :data="$this->getSex" index="label" select-area="addForm.sexe"
                :wire:key="$this->selectArea" />

            <x-form-input name="addForm.phone" id="addForm.phone" title="Phone number"
                placeholder="insert your phone number" input-type="text" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />
            <x-form-input name="addForm.adresse" id="addForm.adresse" title="Address" placeholder="insert your adress"
                input-type="text" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />
            <x-form-input name="addForm.salary" id="addForm.salary" title="Salary" placeholder="insert your salary"
                input-type="text" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />
            <livewire:utils.dropdown label="Experience level" :data="$this->getExperienceLevels" index="label"
                select-area="addForm.experience_level" :wire:key="$this->selectArea" />
            <livewire:utils.dropdown label="Position" :data="$this->getPositions" index="label"
                select-area="addForm.position" :wire:key="$this->selectArea" />
            <livewire:utils.dropdown label="Nationality" :data="$this->getNationality" index="label"
                select-area="addForm.nationality" :wire:key="$this->selectArea" />
            <livewire:utils.dropdown label="Family status" :data="$this->getFamilyStatus" index="label"
                select-area="addForm.family_status" :wire:key="$this->selectArea" />
            <livewire:utils.dropdown label="Contracts" :data="$this->getContracts" index="label"
                select-area="addForm.contract" :wire:key="$this->selectArea" />
            <x-form-input name="addForm.balance" id="addForm.balance" title="Leave balance"
                placeholder="Choice your experience level" input-type="text" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />
            <section class="flex items-center justify-center w-full">
                <x-form-button type="submit" value="Create account" custom-class="max-w-sm w-[300px]" />
            </section>
        </section>
    </form>

</div>
