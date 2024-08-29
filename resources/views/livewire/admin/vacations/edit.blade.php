<div class="flex flex-row flex-wrap gap-5 content">
    {{-- In this form we can change the status of the user vacation --}}
    {{-- Fileds nedded --}}
    {{-- User name and last name --}}
    {{-- Role --}}
    {{-- Start At --}}
    {{-- Leaves date --}}
    {{-- End At --}}
    {{-- Type of the Leaves --}}
    {{-- Experinece level --}}
    <form method="post" wire:submit.prevent='updateRequest'>
        @csrf
        <section
            class="flex flex-wrap items-center justify-start w-full gap-5 p-8 bg-white border border-gray-300 shadow-lg rounded-xl font-Inter">
            <input type="hidden" id="id" name="id" value="{{ $leaves->user->id }}" />

            <div class="min-w-full w-full">
                <x-form-button tag="link" value="Back to vacation list"
                    custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out"
                    href="/admin/vacationRequest/list" />

            </div>

            <x-form-input name="name" id="name" title="First name" placeholder="Insert the employer first name"
                input-type="text" value="{{ $leaves->user->name }}" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full" :set-disable="true" />
            <x-form-input name="lastname" id="lastname" title="Last name" placeholder="Insert the employer lastname"
                input-type="text" value="{{ $leaves->user->lastname }}" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="role" id="role" title="Role" placeholder="Insert the role" input-type="text"
                value="{{ $leaves->user->role }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                :set-disable="true" />
            <x-form-input name="start_at" id="start_at" title="Start At" placeholder="Insert the role" input-type="text"
                value="{{ $leaves->start_at }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                :set-disable="true" />
            <x-form-input name="end_at" id="end_at" title="End At" placeholder="Insert the role" input-type="text"
                value="{{ $leaves->end_at }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                :set-disable="true" />
            <x-form-input name="leaves_days" id="leaves_days" title="Leave days count" placeholder="Insert the role"
                input-type="text" value="{{ $leaves->leaves_days }} days" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="type_leaves" id="type_leaves" title="Type of vacation" placeholder="Insert the role"
                input-type="text" value="{{ $leaves->vacationType->label }}" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="experience_level" id="experience_level" title="Experience level"
                placeholder="Insert the role" input-type="text" value="{{ $user->experienceLevel->label }}"
                :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="true" />
            <x-form-input name="position" id="position" title="Position" placeholder="Insert the role" input-type="text"
                value="{{ $user->position->label }}" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                :set-disable="true" />
            <livewire:utils.dropdown label="Vacation status" :data="$this->getStatus"
                selectedItem="{{ $leaves->leaveStatus->label }}" select-area="status" index="label"
                model-type-live="live" :wire:key="$selectArea" />
            <x-form-input name="description" id="description" title="Description" placeholder="Insert the role"
                input-type="textArea" value="{{ $leaves->description }}" :label-on="true"
                form-style="flex-shrink-0 max-w-lg w-full" :set-disable="true" />
            {{-- This should a ppear when the balance was been changed --}}
            @if ($this->commentOn)
            <x-form-input name="comment" id="comment" title="Comment"
                placeholder="Insert the raison why you Rejected the request of vacation" input-type="textArea"
                :label-on="true" form-style="flex-shrink-0 max-w-lg w-full" :set-disable="false" />
            @endif

            <div class="inline-flex items-end justify-center w-full flex-0">
                <x-form-button value="Submit" type="submit" custom-class="w-full max-w-xs" />
            </div>
        </section>
    </form>
</div>
