<div x-data="{
    tabSelected: 1,
    tabId: 'tabs',
    tabButtonClicked(tabButton) {
        console.log('Button clicked:', tabButton.dataset.tabId);
        this.tabSelected = parseInt(tabButton.dataset.tabId);
        this.tabRepositionMarker(tabButton);
    },
    tabRepositionMarker(tabButton) {
        const marker = this.$refs.tabMarker;
        marker.style.width = tabButton.offsetWidth + 'px';
        marker.style.height = tabButton.offsetHeight + 'px';
        marker.style.left = tabButton.offsetLeft + 'px';
    },
    tabContentActive(tabContent) {
        console.warn($refs.tabButtons);
        console.log('Checking content:', tabContent.dataset.tabId, 'Selected:', this.tabSelected);
        return this.tabSelected == parseInt(tabContent.dataset.tabId);
    }
}" x-init="tabRepositionMarker($refs.tabButtons.querySelector('[data-tab-id=\'1\']'));"
    class="relative w-full overflow-hidden content">

    <div x-ref="tabButtons"
        class="relative flex items-center justify-between w-full h-10 p-2 text-gray-500 bg-gray-100 rounded-lg select-none">
        <button data-tab-id="1" @click="tabButtonClicked($el);" type="button"
            class="relative z-20 inline-flex items-center justify-center w-full h-10 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">
            Information's
        </button>
        <button data-tab-id="2" @click="tabButtonClicked($el);" type="button"
            class="relative z-20 inline-flex items-center justify-center w-full h-10 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">
            Salary
        </button>
        <div x-ref="tabMarker"
            class="absolute top-0 left-0 z-10 h-full duration-500 ease-out bg-white rounded-md shadow-sm" x-cloak>
        </div>
    </div>

    <div class="relative w-full mt-2">
        <div data-tab-id="1" x-show="tabContentActive($el)" class="relative w-full">
            <!-- Tab Content 1 -->
            <div class="overflow-hidden border shadow-sm rounded-xl bg-card text-neutral-900">

                <div class="w-full min-w-full">
                    <x-form-button tag="link" value="Back to employers list"
                        custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out"
                        href="/admin/vacationRequest/list" />

                </div>
                <form method="post" class='flex-row flex-wrap w-full gap-5 bg-white'
                    wire:submit.prevent="changeBasicInformation">
                    @csrf
                    <section class="flex flex-wrap items-start justify-between w-full gap-5 p-8 bg-white font-Inter">
                        <input type="hidden" id="id" name="id" value="{{ $user['id'] }}" />
                        <x-form-input name="form.name" id="form.name" title="Name"
                            placeholder="Insert the employee first name" input-type="text" value="{{ $user['name'] }}"
                            :label-on="true" form-style="flex-shrink-0 max-w-lg w-full" :set-disable="false" />
                        <x-form-input name="form.lastname" id="form.lastname" title="Last Name"
                            placeholder="Insert the last name of the employee " input-type="text"
                            value="{{ $user['lastname'] }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                            :set-disable="false" />

                        <livewire:utils.dropdown label="Role" :data="$this->getRole" selectedItem="{{ $user['role'] }}"
                            index="label" select-area="form.role" :wire:key="$this->form->selectArea" />

                        <x-form-input name="form.email" id="form.email" title="Email"
                            placeholder="Insert the email of the employee " input-type="email"
                            value="{{ $user['email'] }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                            :set-disable="false" />

                        <x-form-input name="form.cin" id="form.cin" title="CIN"
                            placeholder="Insert the CIN of the employee " input-type="text" value="{{ $user['cin'] }}"
                            :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />
                        <x-form-input name="form.cnss" id="form.cnss" title="CNSS"
                            placeholder="Insert the CNSS of the employee " input-type="text" value="{{ $user['cnss'] }}"
                            :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />

                        <livewire:utils.dropdown label="Sex" :data="$this->getSex" selectedItem="{{ $user['sexe'] }}"
                            select-area="form.sexe" :wire:key="$this->form->selectArea" />

                        <x-form-input name="form.birth_date" id="form.birth_date" title="Birth date"
                            placeholder="Insert the 5birth date of the employee " input-type="datePicker"
                            value="{{ $user['birth_date'] }}" :label-on="true"
                            form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" :sub-max="20"
                            :sub-min="50" />

                        <x-form-input name="form.hiring_date" id="form.hiring_date" title="Hiring Date"
                            placeholder="Insert the hiring  date of the employee " input-type="datePicker"
                            value="{{ $user['hiring_date'] }}" :label-on="true"
                            form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" :sub-max="0"
                            :sub-min="0" />
                        <x-form-input name="form.phone" id="form.phone" title="Phone number"
                            placeholder="Insert the mobile phone number  of the employee " input-type="text"
                            value="{{ $user['phone'] }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                            :set-disable="false" />
                        <x-form-input name="form.adresse" id="form.adresse" title="Address"
                            placeholder="Insert the home address the employee " input-type="text"
                            value="{{ $user['adresse'] }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                            :set-disable="false" />
                        <x-form-input name="form.balance" id="form.balance" title="Balance"
                            placeholder="Insert the mobile phone number  of the employee " input-type="text"
                            value="{{ $user['balance'] }}" form-style="flex-shrink-0 max-w-lg w-full"
                            model-type-live="blur" :set-disable="false" :label-on="true" />

                        <livewire:utils.dropdown label="Experience Level" :data="$this->getExperienceLevels"
                            selectedItem="{{ $user['experienceLevel']->label }}" select-area="form.experience_level"
                            :wire:key="$this->form->selectArea" index="label" />
                        <livewire:utils.dropdown label="Family status" :data="$this->getFamilyStatus"
                            selectedItem="{{ $user['familyStatus']->label }}" select-area="form.family_status"
                            :wire:key="$this->form->selectArea" index="label" />
                        <livewire:utils.dropdown label="Nationality" :data="$this->getNationality"
                            selectedItem="{{ $user['nationality']->label }}" select-area="form.nationality"
                            :wire:key="$this->form->selectArea" index="label" />


                        {{-- This should a ppear when the balance was been changed --}}
                        @if ($this->form->commentOn)
                        <x-form-input name="form.comment" id="form.comment" title="Comment"
                            placeholder="Insert the raison why you changed the amount of balance of employee"
                            input-type="text" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                            :set-disable="false" />
                        @endif


                        <div class="inline-flex items-end justify-center w-full flex-0">
                            <x-form-button value="Submit" type="submit" custom-class="w-full max-w-xs" />
                        </div>
                    </section>
                </form>

            </div>
            <!-- End Tab Content 1 -->
        </div>

        <div data-tab-id="2" x-show="tabContentActive($el)" class="relative w-full" x-cloak>
            <!-- Tab Content 2 -->
            <div class="overflow-hidden border shadow-sm rounded-xl bg-card text-neutral-900">
                <form method="post" class='flex-row flex-wrap w-full gap-5 bg-white' wire:ignore
                    wire:submit.prevent="changeSalaryInformation">
                    @csrf
                    <section class="flex flex-wrap items-start justify-between w-full gap-5 p-8 bg-white font-Inter">
                        <input type="hidden" id="id" name="id" value="{{ $user['id'] }}" />
                        <x-form-input name="formSalary.newSalary" id="formSalary.newSalary" title="New Salary"
                            placeholder="Insert the amount for the new salary" input-type="text"
                            value="{{$this->formSalary->newSalary}}" :label-on="true"
                            form-style="flex-shrink-0 max-w-lg w-full" :set-disable="false" />

                        <x-form-input name="formSalary.startDate" id="formSalary.startDate" title="Start date"
                            placeholder="Insert date that the new salary should be change" input-type="datePicker"
                            :label-on="true" form-style="flex-shrink-0 max-w-lg w-full" :set-disable="false"
                            :sub-max="-10" :sub-min="0" value="{{$this->formSalary->startDate}}" />
                        <x-form-input name="formSalary.description" id="formSalary.description" title="Description"
                            placeholder="Insert description for the new salary" input-type="text" :label-on="true"
                            form-style="flex-shrink-0 max-w-lg w-full" :set-disable="false"
                            value="{{$this->formSalary->description}}" />

                        <div class="inline-flex items-end justify-center w-full flex-0">
                            <x-form-button value="Submit" type="submit" custom-class="w-full max-w-xs" />
                        </div>

                    </section>


                </form>
                <livewire:utils.data-table type="dynamic" :modelClass="App\Models\AuditAdmin::class"
                    :relations="['Admin','Audit']" :conditions="[]" :whereHasConditions="[
                            'audit' => [['audit_event', 'like', 'Update']]
                        ]" :orderBy="'created_at'" :sortDirection="'desc'"
                    :headers="['Start at', 'Salary', 'Description']" :actionOn="false" :extract_key="[
                            'created_at',
                            'new_values_salary',
                            ['audit' => 'audit_details']
                        ]" :per-page="3"
                    :withJson=" ['column' => 'new_values', 'keys' => ['salary', 'role', 'name', 'lastname']]" />
            </div>

            <!-- End Tab Content 2 -->

        </div>
    </div>
</div>
