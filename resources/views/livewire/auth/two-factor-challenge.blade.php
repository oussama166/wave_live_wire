<div class="max-w-md h-screen mx-auto  flex items-center justify-center">
    <form wire:submit.prevent="authenticate" class="space-y-6 max-w-2xl bg-white shadow-md rounded-lg p-6">
        <div class="space-y-3">
            <label for="code" class="block text-sm font-medium text-gray-700">
                Two-Factor Authentication Code
            </label>
            <span class="text-sm text-wave-disable">
                You can use the received code pin in one the app like Google Auth Or use one of the key that you had in the settings section
            </span>
            <input
                wire:model="code"
                id="code"
                type="text"
                required
                autofocus
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-700 focus:border-primary-700 sm:text-sm"
                placeholder="Enter your 2FA code or use access key"
            >
            @error('code')
            <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end">
            <x-form-button
                type="button"
                value="Authenticate"
                custom-class="mr-full max-w-lg w-full  px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
            />

        </div>
    </form>
</div>
