<div class="content">
    <section class="w-full p-5 space-y-3 bg-white border rounded-lg content">
        <h1 class="text-xl font-semibold text-wave-primary">
            This section is for settings of your account you can manipulate all the feature that you want
        </h1>

        {{-- I will have the section of Auth --}}
        <form method="post"
              action="/user/two-factor-authentication"
        >
            @csrf
            <div class="w-full p-5 space-y-2 border rounded-lg">

                <div class="w-full inline-flex justify-between">
                    <h1 class="text-xl">Two Auth</h1>
                    <div class="pl-5">
                        @if($isTwoOtpSet)
                            <x-form-button value="Save changes" type="submit"/>
                        @endif
                    </div>

                </div>
                <p class="ps-5 text-black/50">You can activate this feature to upgrade the level of security of your
                    account</p>
                <div class="inline-flex items-center justify-center w-full">
                    <livewire:utils.toggle size="sm" name="TwoOtp"/>
                </div>


                @if(\auth()->user()->two_factor_secret)
                    <div>
                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                    </div>
                @endif
            </div>
        </form>


        <form wire:submit.prevent="updatePassword">
            @csrf
            {{-- I will have the section of Reset password --}}
            <div class="w-full p-5 space-y-2 border rounded-lg">
                <div class="inline-flex justify-between w-full">
                    <div>
                        <h1 class="text-xl">Change your password</h1>
                        <p class="ps-5 text-black/50">You can change your password in this section with adding the old
                            password</p>
                    </div>
                    <div class="pl-5">
                        @if($isValid)
                            <x-form-button value="Save changes" type="submit"/>
                        @endif
                    </div>


                </div>


                {{-- I will need to add the filed old password --}}
                <x-form-input id="oldPassword" name="oldPassword" value="" title="Old password"
                              placeholder="Insert your old password" input-type="password" :is-require="true"
                              :set-icon="false"
                              model-type-live="blur"/>

                {{-- I will nedd to add two other filed for new password and confirm password --}}

                {{-- !-- CHECK THE DOCS OF LIVE WIRE HOW TO TAKE THE SATATE OF VARIBLE --! --}}
                {{--
                CHECK THE STATE OF OLD PASSWORD IF IS VERIFIED AFTER THAT WE CAN FLIP THE STATE OF
                THE SET DISABLE TO FALS INTO THE COMP INPUT FORM
                --}}
                <x-form-input id="newPassword" name="newPassword" title="New password"
                              placeholder="Insert your new password" input-type="password"
                              :set-disable="!$isCurrentPasswordValid"
                              :is-require="true" :set-icon="false" model-type-live="blur"/>
                <x-form-input id="confirmPassword" name="confirmPassword" title="Confirm password"
                              placeholder="Type your new password" input-type="password"
                              :set-disable="!$isCurrentPasswordValid"
                              :is-require="true" :set-icon="false" model-type-live="blur"/>
            </div>
        </form>

    </section>
</div>
