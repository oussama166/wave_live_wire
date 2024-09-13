<div class="flex items-center justify-center h-screen max-w-md mx-auto">
    <form wire:submit.prevent="authenticate" class="max-w-2xl p-6 space-y-6 bg-white rounded-lg shadow-md">
        <div class="space-y-3">
            <label for="code" class="block text-sm font-medium text-gray-700">
                Two-Factor Authentication Code
            </label>
            <span class="text-sm text-wave-disable">
                You can use the received code pin in one the app like Google Auth Or use one of the key that you had in
                the settings section
            </span>
            <input wire:model="code" id="code" type="text" required autofocus
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-700 focus:border-primary-700 sm:text-sm"
                placeholder="Enter your 2FA code or use access key">
            @error('code')
            <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end">
            <x-form-button type="button" value="Authenticate"
                custom-class="w-full max-w-lg px-4 py-2 font-semibold text-white border border-transparent rounded-md mr-full bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2" />

        </div>
    </form>
</div>
