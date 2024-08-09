<div class="content">
    <section class="w-full p-5 bg-white border rounded-lg content space-y-3">
        <h1
            class="text-xl text-wave-primary font-semibold"
        >
            This section is for settings of your account you can manipulate all the feature that you want
        </h1>

        {{--    I will have the section of Auth    --}}
        <div class="w-full border rounded-lg space-y-2 p-5">
            <h1 class="text-xl">Two Auth</h1>
            <p class="ps-5 text-black/50">You can activate this feature to upgrade the level of security of your
                account</p>
            <div class="w-full inline-flex items-center justify-center">
                <livewire:utils.toggle size="sm"/>
            </div>
        </div>
        <form
            wire:submit.prevent="updatePassword"
        >
            @csrf
            {{--    I will have the section of Reset password    --}}
            <div class="w-full border rounded-lg space-y-2 p-5">
                <div class="w-full inline-flex justify-between">
                    <div>
                        <h1 class="text-xl">Change your password</h1>
                        <p class="ps-5 text-black/50">You can change your password in this section with adding the old
                            password</p>
                    </div>
                    <div class="pl-5">
                        @if($isValid)
                            <x-form-button
                                value="Save changes"
                                type="submit"
                            />
                        @endif
                    </div>


                </div>


                {{--  I will need to add the filed old password  --}}
                <x-form-input
                    id="oldPassword"
                    name="oldPassword"
                    value=""
                    title="Old password"
                    placeholder="Insert your old password"
                    input-type="password"
                    :is-require="true"
                    :set-icon="false"
                />

                {{--  I will nedd to add two other filed for new password and confirm password --}}

                {{-- !-- CHECK THE DOCS OF LIVE WIRE HOW TO TAKE THE SATATE OF VARIBLE --! --}}
                {{--
                    CHECK THE STATE OF OLD PASSWORD IF IS VERIFIED AFTER THAT WE CAN FLIP THE STATE OF
                                THE SET DISABLE TO FALS INTO THE COMP INPUT FORM
                --}}
                <x-form-input
                    id="newPassword"
                    name="newPassword"
                    title="New password"
                    placeholder="Insert your new password"
                    input-type="password"
                    :set-disable="!$isCurrentPasswordValid"
                    :is-require="true"
                    :set-icon="false"
                />
                <x-form-input
                    id="confirmPassword"
                    name="confirmPassword"
                    title="Confirm password"
                    placeholder="Type your new password"
                    input-type="password"
                    :set-disable="!$isCurrentPasswordValid"
                    :is-require="true"
                    :set-icon="false"
                />
            </div>
        </form>

    </section>
</div>
