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
        <div id="right-side-title" class="w-full my-5">
            <h3 class="text-3xl font-semibold leading-3">Reset your password</h3>
        </div>
        <div class="w-full">
            <form wire:submit.prevent='resetPassword' id="reset" class="mb-5 space-y-5">
                @csrf
                <x-form-input id="email" name="email" title="Email" placeholder="mail@mail.com" inputType="email"
                    :isRequire="true" :label-on="true" :error-on="$errors->first('email')" :set-focus="true" :value="old('email')">
                    @error('email')
                        <span class="text-danger-500">{{ $message }}</span>
                    @enderror
                </x-form-input>


            </form>

            <x-form-button type="submit" value="Reset password" form="reset" customClass="w-full max-w-lg" />

        </div>
    </section>
</section>
