<section
    class="flex items-center w-full h-screen mx-auto bg-wave-primary-bg lg:flex-row justify-evenly gap-x-32 sm:flex-col">
    <section id="left-side" class="w-1/2 lg:block sm:hidden">
        <img src="{{ asset('/assets/bg-ressource1.svg') }}" class="w-[600px] mx-auto my-auto"
            alt="resources for login page" />
    </section>

    <section id="right-side" class="flex flex-col items-start justify-start w-1/2 gap-4 px-32">
        {{-- title img --}}
        <div id="right-side-title" class="w-1/2 grayscale-[40%] my-5">
            <img src="{{ asset('assets/wave.svg') }}" alt="wave-title-img" class="w-full" />
        </div>
        {{-- !title img --}}
        {{-- title --}}
        <div id="right-side-title" class="w-1/2 my-5">
            <h3 class="text-3xl font-semibold leading-3">Login</h3>
        </div>
        @if ($errors->first('credentials'))
            <div class="w-full max-w-lg p-10 text-center border-red-600 rounded-md bg-red-400/20">
                {{ $errors->first('credentials') }}
            </div>
        @endif
        <div class="w-full">
            <form wire:submit.prevent='connect' id="login" class="space-y-5">
                @csrf
                <x-form-input id="email" name="email" title="Email" placeholder="mail@mail.com" inputType="email"
                    :isRequire="true" :label-on="true" :error-on="$errors->has('email') ? $errors->first('email') : null" :set-focus="true" :value="old('email')" />


                <x-form-input id="password" name="password" title="Password" placeholder="᛫᛫᛫᛫᛫᛫᛫᛫᛫᛫᛫"
                    inputType="password" :isRequire="true" :label-on="true" :error-on="$errors->has('password') ? $errors->first('password') : null" :set-focus="false"
                    :value="old('password')" />

                <div class="max-w-lg py-5 text-right">
                    <a href="/forgot-password"
                        class="underline transition-colors ease-in cursor-pointer text-black/80 underline-offset-2 hover:text-blue-700 ">
                        Forgot your password!!
                    </a>
                </div>
                <x-form-button type="submit" value="Connect" form="login" customClass="w-full max-w-lg"
                    wire:loading.class='pointer-events-none' />
                <div wire:loading class="hidden"></div>
            </form>


            {{-- Separator --}}
            <div id="separator" class="flex items-center justify-center w-full max-w-lg ">
                <hr class="w-full h-0.5 bg-black/30" />
                <span
                    class="flex items-center justify-center mx-2 font-semibold tracking-wider rounded-full min-w-10 min-h-10 text-black/30">or</span>
                <hr class="w-full h-0.5 bg-black/30" />
            </div>
            {{-- !Separator --}}

            <div class="flex items-center w-full max-w-lg gap-2 justify-evenly">

                <x-form-button button-type="icon" type="submit" customClass="text-center border-2 bg-blue-600">
                    <x-fab-github class="text-white w-7 h-7" />
                </x-form-button>
                <x-form-button button-type="icon" type="submit" customClass="text-center border-2 bg-blue-600">
                    <x-fab-slack class="text-white w-7 h-7" />
                </x-form-button>

                <x-form-button button-type="icon" type="submit" custom-class="text-center bg-blue-600 border-2">
                    <x-fab-google class="text-white w-7 h-7" />
                </x-form-button>
            </div>
            {{-- !title --}}

        </div>
    </section>

</section>
