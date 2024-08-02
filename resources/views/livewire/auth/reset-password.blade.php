<div>
    <section
        class="flex items-center w-full h-screen mx-auto bg-wave-primary-bg lg:flex-col justify-evenly gap-x-32 sm:flex-col">
        <div id="right-side-title" class="w-[250px] grayscale-[40%] my-5">
            <img src="{{ asset('assets/wave.svg') }}" alt="wave-title-img" class="w-full" />
        </div>
        <div
            class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
            <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                Change Password
            </h2>
            <div class="text-black bg-red-400">
                @if (session('status'))
                    {{ session('status') }}
                @endif
            </div>
            <form wire:submit.prevent="resetPassword" class="mt-4 space-y-4 lg:mt-5 md:space-y-5" id="restPassword">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <x-form-input name="email" id="email" title="Confirm your email"
                    placeholder="name.lastname@mail.com" inputType="email" :isRequire="true" :label-on="true"
                    :error-on="$errors->has('email')" :set-focus="true" :set-icon="false" :setDisable="true" />

                <x-form-input name="password" id="password" title="Password" placeholder="********"
                    inputType="password" :isRequire="true" :label-on="true" :error-on="$errors->has('password')" :set-focus="true"
                    :set-icon="false" />

                @error('password')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror

                <x-form-input name="password_confirmation" id="password_confirmation" title="Password confirmation"
                    placeholder="********" inputType="password" :isRequire="true" :label-on="true" :error-on="$errors->has('password_confirmation')"
                    :set-focus="true" :set-icon="false" />

                @error('password_confirmation')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror

                <x-form-button type="submit" custom-class="my-5 text-center bg-blue-600 border-2" form="restPassword"
                    value="Reset password" />
            </form>

        </div>
    </section>
</div>
