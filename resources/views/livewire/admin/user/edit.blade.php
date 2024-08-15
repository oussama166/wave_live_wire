<div class="w-full content">
    <div x-data="{
        tabSelected: 1,
        tabId: 'tabs',
        tabButtonClicked(tabButton) {
            this.tabSelected = parseInt(tabButton.dataset.tabId);
            this.tabRepositionMarker(tabButton);
        },
        tabRepositionMarker(tabButton) {
            this.$refs.tabMarker.style.width = tabButton.offsetWidth + 'px';
            this.$refs.tabMarker.style.height = tabButton.offsetHeight + 'px';
            this.$refs.tabMarker.style.left = tabButton.offsetLeft + 'px';
        },
        tabContentActive(tabContent) {
            return this.tabSelected == parseInt(tabContent.dataset.tabId);
        }
    }" x-init="tabRepositionMarker($refs.tabButtons.querySelector('[data-tab-id=\'1\']'));" class="relative w-full overflow-hidden">

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
            <button data-tab-id="2" @click="tabButtonClicked($el);" type="button"
                class="relative z-20 inline-flex items-center justify-center w-full h-10 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">
                Positions
            </button>
            <button data-tab-id="2" @click="tabButtonClicked($el);" type="button"
                class="relative z-20 inline-flex items-center justify-center w-full h-10 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">
                Contracts
            </button>
            <button data-tab-id="2" @click="tabButtonClicked($el);" type="button"
                class="relative z-20 inline-flex items-center justify-center w-full h-10 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">
                Attachments
            </button>
            <div x-ref="tabMarker"
                class="absolute top-0 left-0 z-10 h-full duration-300 ease-out bg-white rounded-md shadow-sm" x-cloak>
            </div>
        </div>

        <div class="relative w-full mt-2">
            <div data-tab-id="1" x-show="tabContentActive($el)" class="relative w-full">
                <!-- Tab Content 1 -->
                <div>

                    <form method="post"
                        class='flex-row flex-wrap w-full gap-5 bg-white border rounded-lg shadow-sm text-neutral-900'
                        wire:submit.prevent="changeBasicInformation">
                        @csrf
                        <section
                            class="flex flex-wrap items-start justify-between w-full gap-5 p-8 bg-white border border-gray-300 shadow-lg rounded-xl font-Inter">
                            <input type="hidden" id="id" name="id" value="{{ $user['id'] }}" />
                            <x-form-input name="form.name" id="form.name" title="Name"
                                placeholder="Insert the employee first name" input-type="text"
                                value="{{ $user['name'] }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full"
                                :set-disable="false" />
                            <x-form-input name="form.lastname" id="form.lastname" title="Last Name"
                                placeholder="Insert the last name of the employee " input-type="text"
                                value="{{ $user['lastname'] }}" :label-on="true"
                                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />

                            <livewire:utils.dropdown label="Role" :data="$this->form->getRole" selectedItem="{{ $user['role'] }}"
                                index="label" select-area="form.role" :wire:key="$this->form->selectArea" />

                            <x-form-input name="form.email" id="form.email" title="Email"
                                placeholder="Insert the email of the employee " input-type="email"
                                value="{{ $user['email'] }}" :label-on="true"
                                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />

                            <x-form-input name="form.cin" id="form.cin" title="CIN"
                                placeholder="Insert the CIN of the employee " input-type="text"
                                value="{{ $user['cin'] }}" :label-on="true"
                                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />
                            <x-form-input name="form.cnss" id="form.cnss" title="CNSS"
                                placeholder="Insert the CNSS of the employee " input-type="text"
                                value="{{ $user['cnss'] }}" :label-on="true"
                                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />

                            <livewire:utils.dropdown label="Sex" :data="$this->form->getSex"
                                selectedItem="{{ $user['sexe'] }}" select-area="form.sexe" :wire:key="$this->form->selectArea" />

                            <x-form-input name="form.birth_date" id="form.birth_date" title="Birth date"
                                placeholder="Insert the 5birth date of the employee " input-type="datePicker"
                                value="{{ $user['birth_date'] }}" :label-on="true"
                                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" :sub-max="10"
                                :sub-min="50" />

                            <x-form-input name="form.hiring_date" id="form.hiring_date" title="Hiring Date"
                                placeholder="Insert the hiring  date of the employee " input-type="datePicker"
                                value="{{ $user['hiring_date'] }}" :label-on="true"
                                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" :sub-max="0"
                                :sub-min="0" />
                            <x-form-input name="form.phone" id="form.phone" title="Phone number"
                                placeholder="Insert the mobile phone number  of the employee " input-type="text"
                                value="{{ $user['phone'] }}" :label-on="true"
                                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />
                            <x-form-input name="form.adresse" id="form.adresse" title="Address"
                                placeholder="Insert the home address the employee " input-type="text"
                                value="{{ $user['adresse'] }}" :label-on="true"
                                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />
                            <x-form-input
                                name="form.balance"
                                id="form.balance"
                                title="Balance"
                                placeholder="Insert the mobile phone number  of the employee "
                                input-type="text"
                                value="{{ $user['balance'] }}"
                                form-style="flex-shrink-0 max-w-lg w-full"
                                model-type-live="live"
                                :set-disable="false"
                                :label-on="true"
                            />

                            <livewire:utils.dropdown label="Experience Level" :data="$this->form->getExperienceLevels"
                                selectedItem="{{ $user['experienceLevel']->label }}" select-area="form.experience_level"
                                :wire:key="$this->form->selectArea" index="label" />
                            <livewire:utils.dropdown label="Family status" :data="$this->form->getFamilyStatus"
                                selectedItem="{{ $user['familyStatus']->label }}" select-area="form.family_status"
                                :wire:key="$this->form->selectArea"  index="label" />
                            <livewire:utils.dropdown label="Nationality" :data="$this->form->getNationality"
                                selectedItem="{{ $user['nationality']->label }}" select-area="form.nationality"
                                :wire:key="$this->form->selectArea" index="label" />



                            {{-- This should a ppear when the balance was been changed --}}
                            @if ($this->form->commentOn)
                                <x-form-input name="form.comment" id="form.comment" title="Comment"
                                    placeholder="Insert the raison why you chnaged the ammount of blance of employee "
                                    input-type="text" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                                    :set-disable="false" />
                            @endif



                            <div class="inline-flex items-end justify-end w-full flex-0">
                                <x-form-button value="Submit" type="submit" custom-class="w-full max-w-lg" />
                            </div>
                        </section>
                    </form>

                </div>
                <!-- End Tab Content 1 -->
            </div>

            <div data-tab-id="2" x-show="tabContentActive($el)" class="relative" x-cloak>
                <!-- Tab Content 2 -->
                <div class="border rounded-lg shadow-sm bg-card text-neutral-900">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="text-lg font-semibold leading-none tracking-tight">Password</h3>
                        <p class="text-sm text-neutral-500">Change your password here. After saving, you'll be logged
                            out.</p>
                    </div>
                    <div class="p-6 pt-0 space-y-2">
                        <div class="space-y-1">
                            <label class="text-sm font-medium leading-none" for="password">Current Password</label>
                            <input type="password" placeholder="Current Password" id="password"
                                class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400" />
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium leading-none" for="password_new">New Password</label>
                            <input type="password" placeholder="New Password" id="password_new"
                                class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400" />
                        </div>
                    </div>
                    <div class="flex items-center p-6 pt-0">
                        <button type="button"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900">
                            Save
                            password
                        </button>
                    </div>
                </div>
                <!-- End Tab Content 2 -->
            </div>

            <div data-tab-id="3" x-show="tabContentActive($el)" class="relative" x-cloak>
                <!-- Tab Content 3 -->
                <div class="border rounded-lg shadow-sm bg-card text-neutral-900">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="text-lg font-semibold leading-none tracking-tight">Password</h3>
                        <p class="text-sm text-neutral-500">Change your password here. After saving, you'll be logged
                            out.</p>
                    </div>
                    <div class="p-6 pt-0 space-y-2">
                        <div class="space-y-1">
                            <label class="text-sm font-medium leading-none" for="password">Current Password</label>
                            <input type="password" placeholder="Current Password" id="password"
                                class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400" />
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium leading-none" for="password_new">New Password</label>
                            <input type="password" placeholder="New Password" id="password_new"
                                class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400" />
                        </div>
                    </div>
                    <div class="flex items-center p-6 pt-0">
                        <button type="button"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900">
                            Save
                            password
                        </button>
                    </div>
                </div>
                <!-- End Tab Content 3 -->
            </div>
        </div>
    </div>
</div>
