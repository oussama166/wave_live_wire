<div class="content">
    <section class="w-full p-5 space-y-3 content">

        {{-- I will have the section of Auth --}}
        <form method="post"
              action="/user/two-factor-authentication"
        >
            @csrf
            {{--     TODO : I need to refactor this code to give to user the right to change stats of 2fact          --}}
            <div class="w-full p-5 space-y-2 border rounded-lg bg-white">

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
                    <div class="w-full inline-flex justify-start items-center gap-5">
                        <div class="border-2 border-black/40 rounded-lg p-5">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                        <div
                            class="space-y-3">
                            <h1> Recovery codes are used to access in the event you cannot access your two-factor
                                Authentication codes.</h1>
                            <div class="relative w-full bg-black/5 rounded-lg py-5 border-2 border-black/40 " x-data="{
    copyText: '',
    copyNotification: false,
    copyToClipboard() {
        // Get all li elements inside the specific ul
        let items = $el.querySelectorAll('ul li');
        // Concatenate the text content of all li elements
        let combinedText = '';
        items.forEach(item => {
            combinedText += item.textContent + ' ';
        });
        this.copyText = combinedText.trim(); // Trim any extra spaces at the end
        // Copy the concatenated text to the clipboard
        navigator.clipboard.writeText(this.copyText);
        this.copyNotification = true;
        let that = this;
        setTimeout(function(){
            that.copyNotification = false;
        }, 3000);
    }
}">
                                <button @click="copyToClipboard();"
                                        class="absolute top-0 right-0 items-center justify-center w-auto h-8 px-3 py-1 text-xs bg-white border rounded-md cursor-pointer border-neutral-200/60 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none text-neutral-500 hover:text-neutral-600 group">
                                    <svg x-show="!copyNotification" class="w-4 h-4 ml-1.5 stroke-current"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"/>
                                    </svg>
                                    <svg x-show="copyNotification" class="w-4 h-4 ml-1.5 text-green-500 stroke-current"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" x-cloak>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"/>
                                    </svg>
                                </button>

                                <ul class="grid grid-cols-2 grid-rows-4 gap-4 justify-items-center content-center ">
                                    @foreach(json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                        <li>{{$code}}</li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                        {{-- TODO: Adding beside the qr list of acces key that can be ued --}}
                    </div>
                @endif
            </div>
            {{--      !TODO : I need to refactor this code to give to user the right to change stats of 2fact          --}}
        </form>


        <form wire:submit.prevent="updatePassword">
            @csrf
            {{-- I will have the section of Reset password --}}
            <div class="w-full p-5 space-y-2 border rounded-lg bg-white">
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
